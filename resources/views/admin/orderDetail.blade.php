@extends('layouts.master')

@section('content')
    <div>
        <div>
            <form action="{{ route('admin.orderDetailFunction') }}" method="POST">
                @csrf
                <div class="shadow p-3 mb-5 bg-white rounded" style="width:80%; margin: 0 auto;">
                    <h1>Order Detail</h1>
                    <div class='row'
                        style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Order ID:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $orderDetail->order_id }}
                            <input type="hidden" name="order_id" value="{{ $orderDetail->order_id }}" />
                        </div>
                    </div>
                    <div class='row'
                        style='background-color: white; color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Customer Name:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $cusName->name }}
                        </div>
                    </div>
                    <div class='row'
                        style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Shipping Address:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $orderDetail->shipping_address }}
                        </div>
                    </div>
                    <div class='row'
                        style='background-color: white; color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Order Date:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $orderDetail->order_date }}
                        </div>
                    </div>
                    <div class='row'
                        style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Total Price(RM):
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $orderDetail->totalPrice }}
                        </div>
                    </div>
                    <div class='row'
                        style='background-color: white; color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Payment Method:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $orderDetail->payment_method }}
                        </div>
                    </div>
                    <div class='row'
                        style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Payment Reference Number:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $orderDetail->payment_rf_num }}
                        </div>
                    </div>
                    <div class='row'
                        style='background-color: white; color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Order Status:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $orderDetail->status }}
                            @if ($orderDetail->status != 'completed')
                                <input type="submit" name="orderFunction" value="Update Order Status" onclick="return confirm('Are you sure you want to update this order status?')"
                                    style="float: right; border-style:none; border-radius:5px; color:white; background-color:black; padding:8px 50px;
                            font-family:'system-ui'; text-transform:uppercase; letter-spacing:.8px; display:block;
                            margin-right:10%; box-shadow:2px 2px 5px rgb(0, 0, 0, 0.2); cursor:pointer;" />
                            @endif
                        </div>
                    </div>
                    <div class='row'
                        style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Delivery Service:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $deliveryDetail->delivery_service }}
                        </div>
                    </div>
                    <div class='row'
                        style='background-color: white; color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Delivery Status:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $deliveryDetail->status }}
                            @if ($deliveryDetail->status != 'completed')
                                <input type="submit" name="orderFunction" value="Update Delivery Status" onclick="return confirm('Are you sure you want to update this delivery status?')"
                                    style="float: right; border-style:none; border-radius:5px; color:white; background-color:black; padding:8px 50px;
                            font-family:'system-ui'; text-transform:uppercase; letter-spacing:.8px; display:block;
                            margin-right:10%; box-shadow:2px 2px 5px rgb(0, 0, 0, 0.2); cursor:pointer;" />
                            @endif
                        </div>
                    </div>
                    <div class='row'
                        style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Delivery Reference Number:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $deliveryDetail->delivery_tracking_num }}
                        </div>
                    </div>
                </div>


                <h3 style="width:80%; margin: 0 auto;">Order Item</h3>
                <br />

                @foreach ($publishedOrder as $published)
                    @if ($published->orderItemable_type == 'App\Models\PublishedDesign')
                        <div class="shadow p-3 mb-5 bg-white rounded" style="width:80%; margin: 0 auto;">
                            <div class='row'
                                style='background-color: white; color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    <img src="{{ asset('publishedDesign/' . $published->front_design_img) }}"
                                        alt="Front Design" width="200" height="200"
                                        style="display: block; margin-left: 25%; float: left;" />
                                    <img src="{{ asset('publishedDesign/' . $published->back_design_img) }}"
                                        alt="Back Design" width="200" height="200"
                                        style="display: block; margin-right: 25%; float: right;" />
                                </div>
                            </div>
                            <div class='row'
                                style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    Order Item ID:
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $published->order_item_id }}
                                </div>
                            </div>
                            <div class='row'
                                style='background-color: white; margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    Total Quantity:
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $published->total_qty }}
                                </div>
                            </div>
                            <div class='row'
                                style='background-color: rgb(200, 197, 197); margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    Published Design Name:
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $published->published_design_name }}
                                </div>
                            </div>
                            <div class='row'
                                style='background-color: white; color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    Published Design Price:
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $published->published_design_price }}
                                </div>
                            </div>
                            <div class='row'
                                style='background-color: rgb(200, 197, 197); margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    Published Design Type:
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $published->published_design_type }}
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

                @foreach ($customTeeOrder as $customTee)
                    @if ($customTee->orderItemable_type == 'App\Models\OrderedCustomTee')
                        <div class="shadow p-3 mb-5 bg-white rounded" style="width:80%; margin: 0 auto;">
                            <div class='row'
                                style='background-color: white; color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    <img src="{{ asset('orderDesign/' . $customTee->front_design_img) }}"
                                        alt="Front Design" width="200" height="200"
                                        style="display: block; margin-left: 25%; float: left;" />
                                    <img src="{{ asset('orderDesign/' . $customTee->back_design_img) }}"
                                        alt="Back Design" width="200" height="200"
                                        style="display: block; margin-right: 25%; float: right;" />
                                </div>
                            </div>
                            <div class='row'
                                style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    Order Item ID:
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $customTee->order_item_id }}
                                </div>
                            </div>
                            <div class='row'
                                style='background-color: white; margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    Total Quantity:
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $customTee->total_qty }}
                                </div>
                            </div>
                            <div class='row'
                                style='background-color: rgb(200, 197, 197); margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    Size:
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $customTee->size_name }}
                                </div>
                            </div>
                            <div class='row'
                                style='background-color: white; color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    Type Color:
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $customTee->type_name }} {{ $customTee->color_name }}
                                </div>
                            </div>
                            <div class='row'
                                style='background-color: rgb(200, 197, 197); margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    Printing Method:
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $customTee->printing_method_name }}
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach


                <div class='row' style='background-color: white; margin: 0 auto; padding: 10px 10px 10px 10px;'>
                    <div class='col' style='color:rgb(0, 0, 0);'>
                        <input type="submit" name="orderFunction" value="Delete"
                            onclick="return confirm('Are you sure you want to delete this order?')"
                            style="border-style:none; border-radius:5px; color:white; background-color:black; padding:8px 50px;
                font-family:'system-ui'; text-transform:uppercase; letter-spacing:.8px; display:block;
                margin: 0 auto; box-shadow:2px 2px 5px rgb(0, 0, 0, 0.2); cursor:pointer;" />
                    </div>
                    <div class='col' style='color:rgb(0, 0, 0);'>
                        <input type="submit" name="orderFunction" value="Back"
                            style="border-style:none; border-radius:5px; color:white; background-color:black; padding:8px 50px;
                font-family:'system-ui'; text-transform:uppercase; letter-spacing:.8px; display:block;
                margin: 0 auto; box-shadow:2px 2px 5px rgb(0, 0, 0, 0.2); cursor:pointer;" />
                    </div>
                </div>
            </form>
        </div>
    @endsection
