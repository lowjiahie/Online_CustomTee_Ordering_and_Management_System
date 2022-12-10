<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Repositories\OrderRepositoryInterface;
use App\Repositories\StaffRepositoryInterface;

class OrderController extends Controller
{
    // Make Repository Easy for CRUD of Staff
    private $orderRepository;
    private $staffRepository;

    public function __construct(OrderRepositoryInterface $orderRepository, StaffRepositoryInterface $staffRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->staffRepository = $staffRepository;
    }

    public function orderList(Request $request){
        // Display all order to the list
        $orderList = $this->orderRepository->getAllOrder();
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->staffRepository->getById($staffID);
        return view('admin.orderList', ['orderList'=>$orderList], ['staffInfo'=>$staffInfo]);
    }

    public function orderSearch(Request $request){
        $search = $request->input('search');
        $minPrice = $request->input('minPrice');
        $maxPrice = $request->input('maxPrice');
        if (!strcmp($search, "Search") && $minPrice != null && $maxPrice != null){
            $request->validate([
                "minPrice" => "required",
                "maxPrice" => "required"
            ]);
            $orderList = $this->orderRepository->searchPriceBetween($minPrice, $maxPrice);
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.orderList', ['orderList'=>$orderList], ['staffInfo'=>$staffInfo]);
        }else if(!strcmp($search, "Search") && $minPrice != null && $maxPrice == null){
            echo "<script>alert('Both minimum price and maximum price must be filled in for searching!')</script>";
            $orderList = $this->orderRepository->getAllOrder();
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.orderList', ['orderList'=>$orderList], ['staffInfo'=>$staffInfo]);
        }else if(!strcmp($search, "Search") && $minPrice == null && $maxPrice != null){
            echo "<script>alert('Both minimum price and maximum price must be filled in for searching!')</script>";
            $orderList = $this->orderRepository->getAllOrder();
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.orderList', ['orderList'=>$orderList], ['staffInfo'=>$staffInfo]);
        }
        else{
            $orderList = $this->orderRepository->getAllOrder();
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.orderList', ['orderList'=>$orderList], ['staffInfo'=>$staffInfo]);
        }
    }

    public function orderDetail(Request $request, $order_id){
        // Pass order ID and get all information about specific order
        $orderDetail = $this->orderRepository->getSpecificOrder($order_id);
        $cusName = $this->orderRepository->getCusName($orderDetail->cus_id);
        $deliveryDetail = $this->orderRepository->getDeliveryDetail($orderDetail->delivery_detail_id);

        $orderItem = $this->orderRepository->getOrderItems($order_id);
        $publishedOrder = $this->orderRepository->getOrderItemsPublishedDesigns($order_id);
        $customTeeOrder = $this->orderRepository->getOrderItemsOrderedCustomTees($order_id);

        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->staffRepository->getById($staffID);
        return view('admin.orderDetail', ['orderDetail'=>$orderDetail, 'cusName'=>$cusName, 'deliveryDetail'=>$deliveryDetail,
        'orderItem'=>$orderItem, 'publishedOrder'=>$publishedOrder, 'customTeeOrder'=>$customTeeOrder, 'customTeeSize'], ['staffInfo'=>$staffInfo]);
    }

    public function orderFunction(Request $request){
        // Check user want view participant, announce winner, update, delete or cancel
        $orderFunction = $request->input('orderFunction');
        $order_id = $request->input('order_id');
        $status = "pending";

        if (!strcmp($orderFunction, "Update Order Status")){
            // Get current status or order or order item
            $getSpecificOrder = $this->orderRepository->getSpecificOrder($order_id);
            $currentOrderStatus = $getSpecificOrder->status;

            if ($currentOrderStatus == "pending" || $currentOrderStatus == "Pending"){
                $status = "processing";
            }else if($currentOrderStatus == "processing" || $currentOrderStatus == "Processing"){
                $status = "completed";
            }else{
                $status = "pending";
            }

            // Update the order status
            $this->orderRepository->updateOrderStatus($order_id, $status);

            echo "<script>alert('Order status update successfully!')</script>";
            $orderDetail = $this->orderRepository->getSpecificOrder($order_id);
            $cusName = $this->orderRepository->getCusName($orderDetail->cus_id);
            $deliveryDetail = $this->orderRepository->getDeliveryDetail($orderDetail->delivery_detail_id);

            $orderItem = $this->orderRepository->getOrderItems($order_id);
            $publishedOrder = $this->orderRepository->getOrderItemsPublishedDesigns($order_id);
            $customTeeOrder = $this->orderRepository->getOrderItemsOrderedCustomTees($order_id);

            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.orderDetail', ['orderDetail'=>$orderDetail, 'cusName'=>$cusName, 'deliveryDetail'=>$deliveryDetail,
            'orderItem'=>$orderItem, 'publishedOrder'=>$publishedOrder, 'customTeeOrder'=>$customTeeOrder, 'customTeeSize'], ['staffInfo'=>$staffInfo]);
        }else if(!strcmp($orderFunction, "Delete")){
            // Delete - delete the data
            // Delete from database
            $this->orderRepository->deleteAllOrderItem($order_id);
            $this->orderRepository->deleteOrder($order_id);

            // Redrect back to order list
            echo "<script>alert('Delete successfully!')</script>";
            $orderList = $this->orderRepository->getAllOrder();
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.orderList', ['orderList'=>$orderList], ['staffInfo'=>$staffInfo]);
        }else{
            // Cancel - redirect to order list
            $orderList = $this->orderRepository->getAllOrder();
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.orderList', ['orderList'=>$orderList], ['staffInfo'=>$staffInfo]);
        }
    }
}
