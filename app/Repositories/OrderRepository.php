<?php
namespace App\Repositories;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderRepositoryInterface {

    public function getAllOrder(){
        return DB::select("SELECT O.order_id, C.name, O.totalPrice, O.order_date, O.status
        FROM orders AS O, customers AS C WHERE O.cus_id=C.cus_id");
    }

    public function getSpecificOrder($order_id){
        return DB::table('orders')
        ->select('orders.*')
        ->where('orders.order_id', $order_id)
        ->first();
    }

    public function getCusName($cus_id){
        return DB::table('customers')
        ->select('customers.*')
        ->where('customers.cus_id', $cus_id)
        ->first();
    }

    public function getDeliveryDetail($delivery_detail_id){
        return DB::table('delivery_details')
        ->select('delivery_details.*')
        ->where('delivery_details.delivery_detail_id', $delivery_detail_id)
        ->first();
    }

    public function getOrderItems($order_id){
        return DB::select("SELECT * FROM order_items WHERE order_id='$order_id'");
    }

    public function getOrderItemsPublishedDesigns($order_id){
        return DB::select("SELECT OI.order_item_id, OI.total_qty, OI.status AS item_status, OI.orderItemable_type,
        PD.name AS published_design_name, PD.price AS published_design_price, PD.type AS published_design_type,
        PD.front_design_img, PD.back_design_img
        FROM orders AS O, order_items AS OI, published_designs AS PD
        WHERE O.order_id=OI.order_id AND OI.orderItemable_id=PD.p_design_id AND OI.order_id='$order_id'");
    }

    public function getOrderItemsOrderedCustomTees($order_id){
        return DB::select("SELECT OI.order_item_id, OI.total_qty, OI.status AS item_status, OI.orderItemable_type, S.size_name,
        T.name AS type_name, C.color_name, PM.name AS printing_method_name, OD.front_design_img, OD.back_design_img FROM orders AS O, order_items AS OI,
        ordered_custom_tees AS OCT, plain_tee_sizes AS S, plain_tee_type_colors AS TC, colors AS C, types AS T,
        printing_methods AS PM, ordered_designs AS OD WHERE O.order_id=OI.order_id
        AND OI.orderItemable_id=OCT.o_custom_tee_id
        AND OCT.plain_tee_size_id=S.plain_tee_size_id
        AND S.pt_type_color_id=TC.pt_type_color_id
        AND TC.color_id = C.color_id
        AND TC.type_id = T.type_id
        AND OCT.o_design_id=OD.o_design_id
        AND OCT.p_method_id=PM.p_method_id
        AND OI.order_id='$order_id'");
    }

    public function searchPriceBetween($min, $max){
        return DB::select("SELECT O.order_id, C.name, O.totalPrice, O.order_date, O.status
        FROM orders AS O, customers AS C WHERE O.cus_id=C.cus_id AND totalPrice BETWEEN $min AND $max");
    }

    public function updateOrderStatus($id, $status){
        return DB::update("UPDATE orders SET status='$status' WHERE order_id='$id'");
    }

    public function updateOrderItemStatus($id, $status){
        return DB::update("UPDATE order_items SET status='$status' WHERE order_item_id='$id'");
    }

    public function deleteOrder($id){
        return DB::delete("DELETE FROM orders WHERE order_id='$id'");
    }

    public function deleteAllOrderItem($id){
        return DB::delete("DELETE FROM order_items WHERE order_id='$id'");
    }

    public function deleteSpecificOrderItem($id){
        return DB::delete("DELETE FROM order_items WHERE order_item_id='$id'");
    }
}

?>
