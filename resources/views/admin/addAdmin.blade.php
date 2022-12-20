@extends('layouts.master')

@section('content')
<div>

    <div class="shadow p-3 mb-5 bg-white rounded" style="width:80%; margin: 0 auto;">
        <form action="{{ route('admin.addAdminSubmit') }}" method="POST">
            @csrf
            <h1>Add Admin Form</h1>
            <div class='row' style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                <div class='col' style='color:rgb(0, 0, 0);'>
                    Name:
                </div>
                <div class='col' style='color:rgb(0, 0, 0);'>
                    <input type="text" name="name" value="{{ $name }}" />
                </div>
            </div>
            <div class='row' style='background-color: white; color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                <div class='col' style='color:rgb(0, 0, 0);'>
                    Email:
                </div>
                <div class='col' style='color:rgb(0, 0, 0);'>
                    <input type="text" name="email" value="{{ $email }}" />
                </div>
            </div>
            <div class='row' style='background-color: rgb(200, 197, 197);; color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                <div class='col' style='color:rgb(0, 0, 0);'>
                    Password:
                </div>
                <div class='col' style='color:rgb(0, 0, 0);'>
                    <input type="password" name="password" value="{{ $password }}" />
                </div>
            </div>
            <div class='row' style='background-color: white; color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                <div class='col' style='color:rgb(0, 0, 0);'>
                    Gender:
                </div>
                <div class='col' style='color:rgb(0, 0, 0);'>
                    @if($gender == "Male")
                    <select name="gender">
                        <option value="Male" selected="selected">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    @elseif ($gender == "Female")
                    <select name="gender">
                        <option value="Male">Male</option>
                        <option value="Female" selected="selected">Female</option>
                    </select>
                    @else
                    <select name="gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    @endif
                </div>
            </div>
            <div class='row' style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                <div class='col' style='color:rgb(0, 0, 0);'>
                    Date of birth:
                </div>
                <div class='col' style='color:rgb(0, 0, 0);'>
                    <?php
                        $year=(int)date("Y");
                        $year-=18;
                        $year=(String)$year;
                        $year=$year.'-'.date("m").'-'.date("d");
                    ?>
                    <input type="date" name="date_of_birth" max="<?php echo $year ?>" value="{{ $date_of_birth }}" />
                </div>
            </div>
            <div class='row' style='background-color: white; color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                <div class='col' style='color:rgb(0, 0, 0);'>
                    Phone Number:
                </div>
                <div class='col' style='color:rgb(0, 0, 0);'>
                    <input type="text" name="phone_no" value="{{ $phone_no }}" />
                </div>
            </div>
            <div class='row' style='background-color: rgb(200, 197, 197);; color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                <div class='col' style='color:rgb(0, 0, 0);'>
                    Role
                </div>
                <div class='col' style='color:rgb(0, 0, 0);'>
                    @if($role == "Normal Admin")
                    <select name="role">
                        <option value="Normal Admin" selected="selected">Normal Admin</option>
                        <option value="Super Admin">Super Admin</option>
                    </select>
                    @elseif ($role == "Super Admin")
                    <select name="role">
                        <option value="Normal Admin">Normal Admin</option>
                        <option value="Super Admin" selected="selected">Super Admin</option>
                    </select>
                    @else
                    <select name="role">
                        <option value="Normal Admin">Normal Admin</option>
                        <option value="Super Admin">Super Admin</option>
                    </select>
                    @endif
                </div>
            </div>
            <div class='row' style='background-color: white; margin: 0 auto; padding: 10px 10px 10px 10px;'>
                <div class='col' style='color:rgb(0, 0, 0);'>
                    <input type="submit" name="AddCancel" value="Add" onclick="return confirm('Are you sure you want to add new admin?')"
                    style="border-style:none; border-radius:5px; color:white; background-color:black; padding:8px 50px;
                    font-family:'system-ui'; text-transform:uppercase; letter-spacing:.8px; display:block;
                    margin: 0 auto; box-shadow:2px 2px 5px rgb(0, 0, 0, 0.2); cursor:pointer;" />
                </div>
                <div class='col' style='color:rgb(0, 0, 0);'>
                    <input type="submit" name="AddCancel" value="Cancel"
                    style="border-style:none; border-radius:5px; color:white; background-color:black; padding:8px 50px;
                    font-family:'system-ui'; text-transform:uppercase; letter-spacing:.8px; display:block;
                    margin: 0 auto; box-shadow:2px 2px 5px rgb(0, 0, 0, 0.2); cursor:pointer;" />
                </div>
            </div>
        </form>
    </div>

</div>
@endsection
