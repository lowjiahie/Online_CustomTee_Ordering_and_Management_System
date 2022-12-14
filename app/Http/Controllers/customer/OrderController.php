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
use App\Http\Controllers\Controller;

class OrderController extends Controller
{

    public function checkOut(Request $request)
    {
        $orderCustomTee = $request->cartData;
        $request->validate([
            'cartData.address' => 'required',
            'cartData.deliveryMethod' => 'required',
        ]);
        //find printing method
        //create order design for each order custom tee
        //create ordered custom tee based on the printing method and orderdesign
        //create each order item based on the ordered custom tee
        //create delivery detail
        //create order

        // $customTeeName = $customTee['cusID'] . '-' . $customTee['name'];
        // $pathPrefix = public_path('customTee/');
        // $front_jpg_name = $customTeeName . "-" . $customTee['ptTypeColorID'] . "-" . "front-" . "preset" . ".jpg";
        // $frontPath = $pathPrefix . '/' . $front_jpg_name;
        // $back_jpg_name = $customTeeName . "-" . $customTee['ptTypeColorID'] . "-" . "back-" . "preset" . ".jpg";
        // $backPath = $pathPrefix . '/' . $back_jpg_name;

        // if (!File::exists($pathPrefix)) {
        //     File::makeDirectory($pathPrefix, 0777, true, true);
        // }

        // Image::make(file_get_contents($customTee['frontDesignImg']))->save($frontPath);
        // Image::make(file_get_contents($customTee['backDesignImg']))->save($backPath);
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
            'cus_id'=>$orderCustomTee['cusID'],
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

        // dd($orderCustomTee['cusTeeCart'][$i]['customtee']['pt_type_color_id']);
        // dd($orderCustomTee['cusTeeCart']);

        // dd($orderCustomTee["orderSummary"]);
        // dd($orderCustomTee["cusID"]);
        // dd($orderCustomTee["address"]);
        // dd($orderCustomTee["deliveryMethod"]);



    }


    public function getOrderWithStatus(Request $request){
        $status = strtolower($request->status);
        $cusID = $request->cusID;

        $response = Order::all()->where('status', $status)->where('cus_id', $cusID);

        return response($response, 201);
        
    }

    public function cancelOrder(Request $request){
        $orderID = $request->orderID;
        $order = Order::find($orderID);
        $order->status = 'cancelled';
        $response = $order->save();

        return response($response,201);
        
    }

    public function searchOrderByID(Request $request){
        $orderID = $request->orderID;
        $order = Order::all()->where("order_id",$orderID);

        return response($order,201);
    }

    public function getOrderDetails($id){
        $response = OrderItem::join('ordered_custom_tees', 'order_items.orderItemable_id', '=', 'ordered_custom_tees.o_custom_tee_id')
        ->where('order_items.order_id','=',$id)
        ->join('printing_methods', 'orders.order_id', '=', 'order_items.order_id')
        ->join('ordered_designs', 'orders.order_id', '=', 'order_items.order_id')
        ->join('plain_tee_sizes', 'orders.order_id', '=', 'order_items.order_id')
        ->join('plain_tee_type_colors', 'orders.order_id', '=', 'order_items.order_id')
        ->join('types', 'orders.order_id', '=', 'order_items.order_id')
        ->join('colors', 'orders.order_id', '=', 'order_items.order_id')
        ->select(
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
            'colors.color_code'
        )->get();
    }
}
