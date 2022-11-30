@extends('layouts.master')

@section('content')
<div>

    <div style="border: 3px solid grey; border-radius:25px; width: 55%; height: 40%; margin-left: auto; margin-right: auto; margin-top: 10%; padding: 10px 10px 10px 10px;">
        <form action="{{ route('admin.changePasswordSubmit') }}" method="POST">
            @csrf
            <legend>Change Password Form</legend>
            <table>
                <tr>
                    <td><label>Old Password: </label></td>
                    <td><input type="password" name="oldPassword" id="oldPassword" size="60%" placeholder="Please fill in your old password here" /></td>
                </tr>
                <tr>
                    <td><label>New Password: </label></td>
                    <td><input type="password" name="newPassword" id="newPassword" size="60%" placeholder="Please fill in your new password here" /></td>
                </tr>
                <tr>
                    <td><label>Confirm Password: </label></td>
                    <td><input type="password" name="confirmPassword" id="confirmPassword" size="60%" placeholder="Please fill in your confirm password here" /></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <input type="submit" name="changeCancel" value="Change" id="change" style="margin: 10px 10px 10px 10px;"/>
                        <input type="submit" name="changeCancel" value="Cancel" id="cancel" style="margin: 10px 10px 10px 10px;" />
                    </td>
                </tr>
            </table>
        </form>
    </div>

</div>
@endsection
