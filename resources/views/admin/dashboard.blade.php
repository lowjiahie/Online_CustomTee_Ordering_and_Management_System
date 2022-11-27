@extends('layouts.master')

@section('content')
<div>
    <h1>Dashboard</h1>

    <div>
        <div class="shadow p-3 mb-5 bg-white rounded" style="width: 17%; height:20%; float:left; margin: 1% 1% 1% 1%;">
            <h4 style="float: left;"><b>4</b></h4>
            <i class="fas fa-clipboard-list" style="float: right; padding: 2px 2px 2px 2px; margin: 2px 5px 2px 2px; font-size:32px;"></i>
            <br><br>
            <label style="font-size: 0.7em;">Current Banned Design</label>
        </div>
        <div class="shadow p-3 mb-5 bg-white rounded" style="width: 17%; height:20%; float:left; margin: 1% 1% 1% 1%;">
            <h4 style="float: left;"><b>1</b></h4>
            <i class="fas fa-clipboard-list" style="float: right; padding: 2px 2px 2px 2px; margin: 2px 5px 2px 2px; font-size:32px;"></i>
            <br><br>
            <label style="font-size: 0.7em;">Current Competition</label>
        </div>
        <div class="shadow p-3 mb-5 bg-white rounded" style="width: 17%; height:20%; float:left; margin: 1% 1% 1% 1%;">
            <h4 style="float: left;"><b>9</b></h4>
            <i class="fas fa-clipboard-list" style="float: right; padding: 2px 2px 2px 2px; margin: 2px 5px 2px 2px; font-size:32px;"></i>
            <br><br>
            <label style="font-size: 0.7em;">Printing status pending to update</label>
        </div>
        <div class="shadow p-3 mb-5 bg-white rounded" style="width: 17%; height:20%; float:left; margin: 1% 1% 1% 1%;">
            <h4 style="float: left;"><b>5</b></h4>
            <i class="fas fa-clipboard-list" style="float: right; padding: 2px 2px 2px 2px; margin: 2px 5px 2px 2px; font-size:32px;"></i>
            <br><br>
            <label style="font-size: 0.7em;">Delivery status pending to update</label>
        </div>
    </div>

    <!-- Recent Added Order -->
    <div style="width: 100%; height: 40%; margin-left: auto; margin-right: auto; padding: 10px 10px 10px 10px;">
        <br><br><br><br><br><br><br>
        <legend>Recent Added Order</legend>
        <table style="border: 3px solid grey; width:100%;">
            <tr>
                <th>ID</th>
                <th>Customer Name</th>
                <th>Order Date</th>
                <th>Printing Status</th>
                <th>Delivery Status</th>
                <th>Total Price(RM)</th>
                <th></th>
            </tr>
            <tr>
                <td>OR00002</td>
                <td>Sam</td>
                <td>20 August 2022</td>
                <td>Pending</td>
                <td>Pending</td>
                <td>27.00</td>
                <td><a href="#">View Detail</a></td>
            </tr>
            <tr>
                <td>OR00001</td>
                <td>Jack</td>
                <td>19 August 2022</td>
                <td>Printing</td>
                <td>Pending</td>
                <td>30.00</td>
                <td><a href="#">View Detail</a></td>
            </tr>
        </table>
    </div>

</div>
@endsection
