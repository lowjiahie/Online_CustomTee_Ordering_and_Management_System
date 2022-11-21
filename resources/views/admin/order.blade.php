@extends('layouts.master')

@section('content')
    <div style="width: 100%; height: 40%; margin-left: auto; margin-right: auto; padding: 10px 10px 10px 10px;">
        <legend>Order List</legend>
        <table style="border: 3px solid grey; width:90%;">
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
                <td>OR00001</td>
                <td>Jack</td>
                <td>19 August 2022</td>
                <td>Printing</td>
                <td>Pending</td>
                <td>30.00</td>
                <td><a href="#">View Detail</a></td>
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
        </table>
    </div>
@endsection
