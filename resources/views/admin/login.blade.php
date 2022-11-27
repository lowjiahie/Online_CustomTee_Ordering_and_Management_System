
    <div style="border: 3px solid grey; border-radius:25px; width: 55%; height: 40%; margin-left: auto; margin-right: auto; margin-top: 10%; padding: 10px 10px 10px 10px;">
        <form action="{{ route('admin.loginSubmit') }}" method="POST">
            @csrf
            <legend>Staff Login Form</legend>
            <table>
                <tr>
                    <td><label>Email: </label></td>
                    <td><input type="text" name="email" id="email" size="60%" placeholder="Please fill in your email here" /></td>
                </tr>
                <tr>
                    <td><label>Password: </label></td>
                    <td><input type="password" name="password" id="password" size="60%" placeholder="Please fill in your password here" /></td>
                </tr>
                <tr>
                    <td colspan="2"><a href="#" style="text-align: right; text-decoration: underline blue; margin-left: 70%;">Forgot Password</a></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <input type="submit" name="loginRecoverCancel" value="Login" id="login" style="margin: 10px 10px 10px 10px;"/>
                        <input type="submit" name="loginRecoverCancel" value="Cancel" id="cancel" style="margin: 10px 10px 10px 10px;" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
