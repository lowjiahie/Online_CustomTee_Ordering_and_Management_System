@extends('layouts.master')

@section('content')
    <div>
        <div style="width:80%; margin: 0 auto;">
            <h1>Dashboard</h1>
            <div class="shadow p-3 mb-5 bg-white rounded" style="width: 20%; height:20%; float:left; margin: 1% 1% 1% 1%;">
                <h4 style="float: left;"><b>
                    @foreach ($currentBannedDesign as $count)
                    {{ $count->bannedDesignCount }}
                    @endforeach
                </b></h4>
                <i class="fas fa-clipboard-list"
                    style="float: right; padding: 2px 2px 2px 2px; margin: 2px 5px 2px 2px; font-size:32px;"></i>
                <br><br>
                <label style="font-size: 1em;">Current Banned Design</label>
            </div>
            <div class="shadow p-3 mb-5 bg-white rounded" style="width: 20%; height:20%; float:left; margin: 1% 1% 1% 1%;">
                <h4 style="float: left;"><b>
                    @foreach ($currentCompetition as $count)
                    {{ $count->competitionCount }}
                    @endforeach
                </b></h4>
                <i class="fas fa-clipboard-list"
                    style="float: right; padding: 2px 2px 2px 2px; margin: 2px 5px 2px 2px; font-size:32px;"></i>
                <br><br>
                <label style="font-size: 1em;">Current Competition</label>
            </div>
            <div class="shadow p-3 mb-5 bg-white rounded" style="width: 20%; height:20%; float:left; margin: 1% 1% 1% 1%;">
                <h4 style="float: left;"><b>
                    @foreach ($currentOrder as $count)
                    {{ $count->orderCount }}
                    @endforeach
                </b></h4>
                <i class="fas fa-clipboard-list"
                    style="float: right; padding: 2px 2px 2px 2px; margin: 2px 5px 2px 2px; font-size:32px;"></i>
                <br><br>
                <label style="font-size: 1em;">Order status pending to update</label>
            </div>
            <div class="shadow p-3 mb-5 bg-white rounded" style="width: 20%; height:20%; float:left; margin: 1% 1% 1% 1%;">
                <h4 style="float: left;"><b>
                    @foreach ($currentDelivery as $count)
                    {{ $count->deliveryCount }}
                    @endforeach
                </b></h4>
                <i class="fas fa-clipboard-list"
                    style="float: right; padding: 2px 2px 2px 2px; margin: 2px 5px 2px 2px; font-size:32px;"></i>
                <br><br>
                <label style="font-size: 1em;">Delivery status pending to update</label>
            </div>
        </div>

        <br/><br/><br/><br/><br/><br/><br/>
        <!-- Recent Added Order -->
        <div class="shadow p-3 mb-5 bg-white rounded" style="width:80%; margin: 0 auto;">
            <h1>Recent Added Order</h1>
            <div class='container'>
                <div class='row' style='background-color: rgb(200, 197, 197); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                    <div class='col'>
                        <a href='' style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>Order ID</a>
                    </div>
                    <div class='col'>
                        <a href='' style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>Customer Name</a>
                    </div>
                    <div class='col'>
                        <a href='' style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>Total Price(RM)</a>
                    </div>
                    <div class='col'>
                        <a href='' style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>Order Date</a>
                    </div>
                    <div class='col'>
                        <a href='' style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>Status</a>
                    </div>
                    <div class='col'>

                    </div>
                </div>
                <?php $rowColor = 1; ?>
                @foreach ($orderList as $order)
                    @if ($rowColor == 1)
                        <div class='row'
                            style='background-color: white; margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                {{ $order->order_id }}
                            </div>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                {{ $order->name }}
                            </div>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                {{ $order->totalPrice }}
                            </div>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                {{ $order->order_date }}
                            </div>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                {{ $order->status }}
                            </div>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                <a href="{{ '/admin/orderDetailInfo/' . $order->order_id }}"
                                    style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>View
                                    Detail</a>
                            </div>
                        </div>
                        <?php $rowColor = 0; ?>
                    @else
                        <div class='row'
                            style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                {{ $order->order_id }}
                            </div>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                {{ $order->name }}
                            </div>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                {{ $order->totalPrice }}
                            </div>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                {{ $order->order_date }}
                            </div>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                {{ $order->status }}
                            </div>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                <a href="{{ '/admin/orderDetailInfo/' . $order->order_id }}"
                                    style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>View
                                    Detail</a>
                            </div>
                        </div>
                        <?php $rowColor = 1; ?>
                    @endif
                @endforeach
            </div>
        </div>

    </div>
@endsection
