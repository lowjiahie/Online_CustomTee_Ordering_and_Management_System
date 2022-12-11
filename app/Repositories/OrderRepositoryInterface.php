<?php
namespace App\Repositories;

interface OrderRepositoryInterface {

    public function getAllOrder();

    public function getSpecificOrder($order_id);

    public function getCusName($cus_id);

    public function getDeliveryDetail($delivery_detail_id);

    public function getOrderItems($order_id);

    public function getOrderItemsPublishedDesigns($order_id);

    public function getOrderItemsOrderedCustomTees($order_id);

    public function searchPriceBetween($min, $max);

    public function updateOrderStatus($id, $status);

    public function updateOrderItemStatus($id, $status);

    public function updateDeliveryStatus($id, $status);

    public function deleteOrder($id);

    public function deleteAllOrderItem($id);

    public function deleteSpecificOrderItem($id);

}

?>
