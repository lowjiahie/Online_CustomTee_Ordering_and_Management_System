@extends('layouts.master')

@section('content')
<div>

    <div style="border: 3px solid grey; border-radius:25px; width: 55%; height: 40%; margin-left: auto; margin-right: auto; margin-top: 10%; padding: 10px 10px 10px 10px;">
        <form action="{{ route('admin.updateProfileSubmit') }}" method="POST">
            @csrf
            <legend>Update Profile Form</legend>
            <table>
                <tr>
                    <td><label>Name: </label></td>
                    <td><input type="text" name="name" id="name" size="60%" value="{{ $staffInfo->name }}" /></td>
                </tr>
                <tr>
                    <td><label>Email: </label></td>
                    <td><input type="text" name="email" id="email" size="60%" value="{{ $staffInfo->email }}" /></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <input type="submit" name="updateCancel" value="Update" id="update" style="margin: 10px 10px 10px 10px;"/>
                        <input type="submit" name="updateCancel" value="Cancel" id="cancel" style="margin: 10px 10px 10px 10px;" />
                    </td>
                </tr>
            </table>
        </form>
    </div>

</div>
@endsection
