@extends('layouts.master')

@section('content')
<div>

    <div class="shadow p-3 mb-5 bg-white rounded" style="width:80%; margin: 0 auto;">
        <form action="{{ route('admin.dashboardBack') }}" method="POST">
            @csrf
            <h1>Personal Profile</h1>
            <div class='row' style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                <div class='col' style='color:rgb(0, 0, 0);'>
                    Staff ID:
                </div>
                <div class='col' style='color:rgb(0, 0, 0);'>
                    {{ $staffInfo->staff_id }}
                </div>
            </div>
            <div class='row' style='background-color: white; color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                <div class='col' style='color:rgb(0, 0, 0);'>
                    Name:
                </div>
                <div class='col' style='color:rgb(0, 0, 0);'>
                    {{ $staffInfo->name }}
                </div>
            </div>
            <div class='row' style='background-color: rgb(200, 197, 197);; color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                <div class='col' style='color:rgb(0, 0, 0);'>
                    Email:
                </div>
                <div class='col' style='color:rgb(0, 0, 0);'>
                    {{ $staffInfo->email }}
                </div>
            </div>
            <div class='row' style='background-color: white; color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                <div class='col' style='color:rgb(0, 0, 0);'>
                    Gender:
                </div>
                <div class='col' style='color:rgb(0, 0, 0);'>
                    {{ $staffInfo->gender }}
                </div>
            </div>
            <div class='row' style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                <div class='col' style='color:rgb(0, 0, 0);'>
                    Date of birth:
                </div>
                <div class='col' style='color:rgb(0, 0, 0);'>
                    {{ $staffInfo->date_of_birth }}
                </div>
            </div>
            <div class='row' style='background-color: white; color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                <div class='col' style='color:rgb(0, 0, 0);'>
                    Phone Number:
                </div>
                <div class='col' style='color:rgb(0, 0, 0);'>
                    {{ $staffInfo->phone_no }}
                </div>
            </div>
            <div class='row' style='background-color: rgb(200, 197, 197);; color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                <div class='col' style='color:rgb(0, 0, 0);'>
                    Role
                </div>
                <div class='col' style='color:rgb(0, 0, 0);'>
                    {{ $staffInfo->role }}
                </div>
            </div>
            <div class='row' style='background-color: white; margin: 0 auto; padding: 10px 10px 10px 10px;'>
                <div class='col' style='color:rgb(0, 0, 0);'>
                    <input type="submit" name="back" value="Back"
                    style="border-style:none; border-radius:5px; color:white; background-color:black; padding:8px 50px;
                    font-family:'system-ui'; text-transform:uppercase; letter-spacing:.8px; display:block;
                    margin: 0 auto; box-shadow:2px 2px 5px rgb(0, 0, 0, 0.2); cursor:pointer;" />
                </div>
            </div>
        </form>
    </div>

</div>
@endsection
