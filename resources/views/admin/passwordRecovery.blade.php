@extends('layouts.master')

@section('content')
    <div style="border: 3px solid grey; border-radius:25px; width: 60%; height: 40%; margin-left: auto; margin-right: auto; margin-top: 10%; padding: 10px 10px 10px 10px;">
        <form action="/" method="POST">
            @csrf
            <legend>Password Recovery Form</legend>
            <table>
                <tr>
                    <td><label>New Password: </label></td>
                    <td><input type="text" name="password" id="email" size="60%" placeholder="Please fill in your new password here" /></td>
                </tr>
                <tr>
                    <td><label>Confirmed Password: </label></td>
                    <td><input type="password" name="password" id="password" size="60%" placeholder="Please fill in your confirmed password here" /></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <input type="button" name="submit" value="Submit" id="submit" style="margin: 10px 10px 10px 10px;"/>
                        <input type="button" name="cancel" value="Cancel" id="cancel" style="margin: 10px 10px 10px 10px;" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
@endsection
