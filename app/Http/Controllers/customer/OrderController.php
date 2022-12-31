<?php

namespace App\Http\Controllers\customer;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\OrderedDesign;
use App\Models\DeliveryDetail;
use App\Models\OrderedCustomTee;
use Srmklive\PayPal\Facades\PayPal;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{

    public function create(Request $request)
    {
        $orderCustomTee = $request->cartData;

        $deliveryDetail = DeliveryDetail::create([
            'delivery_service' => $orderCustomTee["deliveryMethod"],
            'status' => 'pending',
        ]);
        $order = Order::create([
            'shipping_address' => $orderCustomTee["address"],
            'order_date' => Carbon::now(),
            'payment_method' => 'paypal',
            'status' => 'pending',
            'totalPrice' => $orderCustomTee["orderSummary"]['total'],
            'delivery_detail_id' => $deliveryDetail->delivery_detail_id,
            'payment_rf_num' => $orderCustomTee["paypalOrderID"],
            'cus_id' => $orderCustomTee['cusID'],
        ]);

        for ($i = 0; $i < count($orderCustomTee['cusTeeCart']); $i++) {

            if ($orderCustomTee['cusTeeCart'][$i]['cusID'] == $orderCustomTee['cusID']) {
                $randomString = Str::random(30);
                $orderedDesign = OrderedDesign::create([
                    'name' => $randomString,
                    'front_design_img' => $orderCustomTee['cusTeeCart'][$i]['customtee']['front_design_img'],
                    'back_design_img' => $orderCustomTee['cusTeeCart'][$i]['customtee']['back_design_img'],
                ]);

                $orderedCustomTee = OrderedCustomTee::create([
                    'plain_tee_size_id' => $orderCustomTee['cusTeeCart'][$i]['sizeID'],
                    'p_method_id' => $orderCustomTee['cusTeeCart'][$i]['printingMethodID'],
                    'o_design_id' => $orderedDesign->o_design_id,
                    'cus_id' => $orderCustomTee['cusID'],
                    'printing_method_price' => $orderCustomTee['cusTeeCart'][$i]['printingPrice'],
                    'plain_tee_price' => $orderCustomTee['cusTeeCart'][$i]['customtee']['price'],
                ]);


                $orderItem = OrderItem::create([
                    'total_qty' => $orderCustomTee['cusTeeCart'][$i]['qty'],
                    'orderItemable_id' => $orderedCustomTee->o_custom_tee_id,
                    'orderItemable_type' => 'App\Models\OrderedCustomTee',
                    'sub_total' => $orderCustomTee['cusTeeCart'][$i]['subtotal'],
                    'order_id' => $order->order_id,
                ]);
            }
        }

        return response($order, 201);
    }


    public function getOrderWithStatus(Request $request)
    {
        $status = strtolower($request->status);
        $cusID = $request->cusID;

        $response = Order::all()->where('status', $status)->where('cus_id', $cusID);

        return response($response, 201);
    }

    public function cancelOrder(Request $request)
    {
        $orderID = $request->orderID;
        $order = Order::find($orderID);
        $order->status = 'cancelled';
        $response = $order->save();

        return response($response, 201);
    }

    public function searchOrderByID(Request $request)
    {
        $orderID = $request->orderID;
        $cusID=$request->cusID;
        $order = Order::all()->where("order_id", $orderID)->where("cus_id",$cusID);

        return response($order, 201);
    }

    public function getOrderDetails($id)
    {

        $response = Order::join('delivery_details', 'orders.delivery_detail_id', '=', 'delivery_details.delivery_detail_id')
            ->join('order_items', 'order_items.order_id', '=', 'orders.order_id')
            ->where('order_items.order_id', '=', $id)
        ->join('ordered_custom_tees', 'order_items.orderItemable_id', '=', 'ordered_custom_tees.o_custom_tee_id')
        ->join('printing_methods', 'ordered_custom_tees.p_method_id', '=', 'printing_methods.p_method_id')
        ->join('ordered_designs', 'ordered_custom_tees.o_design_id', '=', 'ordered_designs.o_design_id')
        ->join('plain_tee_sizes', 'ordered_custom_tees.plain_tee_size_id', '=', 'plain_tee_sizes.plain_tee_size_id')
        ->join('plain_tee_type_colors', 'plain_tee_sizes.pt_type_color_id', '=', 'plain_tee_type_colors.pt_type_color_id')
        ->join('types', 'plain_tee_type_colors.type_id', '=', 'types.type_id')
        ->join('colors', 'plain_tee_type_colors.color_id', '=', 'colors.color_id')
        ->select(
            'orders.shipping_address',
            'orders.order_date',
            'orders.payment_method',
            'orders.status as order_status',
            'orders.totalPrice',
            'orders.payment_rf_num',
            'delivery_details.delivery_tracking_num',
            'delivery_details.delivery_service',
            'delivery_details.status as delivery_status',
            'order_items.order_item_id',
            'order_items.total_qty',
            'order_items.orderItemable_id',
            'order_items.sub_total',
            'order_items.order_id',
            'ordered_custom_tees.printing_method_price',
            'ordered_custom_tees.plain_tee_price',
            'ordered_designs.front_design_img',
            'ordered_designs.back_design_img',
            'printing_methods.name as printing_name',
            'printing_methods.price',
            'plain_tee_sizes.size_name',
            'plain_tee_type_colors.pt_type_color_id',
            'plain_tee_type_colors.plain_tee_img',
            'plain_tee_type_colors.color_id',
            'plain_tee_type_colors.type_id',
            'types.name as type_name',
            'types.material',
            'types.description',
            'types.detail',
            'types.price',
            'colors.color_name',
        )->get();


        return response($response, 201);
    }
}
