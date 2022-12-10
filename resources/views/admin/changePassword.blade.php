@extends('layouts.master')

@section('content')
<div>

    <div class="shadow p-3 mb-5 bg-white rounded" style="width:80%; margin: 0 auto;">
        <form action="{{ route('admin.changePasswordSubmit') }}" method="POST">
            @csrf
            <h1>Change Password Form</h1>
            <div class='row' style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                <div class='col' style='color:rgb(0, 0, 0);'>
                    Old Password:
                </div>
                <div class='col' style='color:rgb(0, 0, 0);'>
                    <input type="password" name="oldPassword" id="oldPassword" size="60%" placeholder="Please fill in your old password here" />
                </div>
            </div>
            <div class='row' style='background-color: white; color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                <div class='col' style='color:rgb(0, 0, 0);'>
                    New Password:
                </div>
                <div class='col' style='color:rgb(0, 0, 0);'>
                    <input type="password" name="newPassword" id="newPassword" size="60%" placeholder="Please fill in your new password here" />
                </div>
            </div>
            <div class='row' style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                <div class='col' style='color:rgb(0, 0, 0);'>
                    Confirm Password:
                </div>
                <div class='col' style='color:rgb(0, 0, 0);'>
                    <input type="password" name="confirmPassword" id="confirmPassword" size="60%" placeholder="Please fill in your confirm password here" />
                </div>
            </div>
            <div class='row' style='background-color: white; margin: 0 auto; padding: 10px 10px 10px 10px;'>
                <div class='col' style='color:rgb(0, 0, 0);'>
                    <input type="submit" name="changeCancel" value="Change" onclick="return confirm('Are you sure you want to change your password?')"
                    style="border-style:none; border-radius:5px; color:white; background-color:black; padding:8px 50px;
                    font-family:'system-ui'; text-transform:uppercase; letter-spacing:.8px; display:block;
                    margin: 0 auto; box-shadow:2px 2px 5px rgb(0, 0, 0, 0.2); cursor:pointer;" />
                </div>
                <div class='col' style='color:rgb(0, 0, 0);'>
                    <input type="submit" name="changeCancel" value="Cancel"
                    style="border-style:none; border-radius:5px; color:white; background-color:black; padding:8px 50px;
                    font-family:'system-ui'; text-transform:uppercase; letter-spacing:.8px; display:block;
                    margin: 0 auto; box-shadow:2px 2px 5px rgb(0, 0, 0, 0.2); cursor:pointer;" />
                </div>
            </div>
        </form>
    </div>

</div>
@endsection
