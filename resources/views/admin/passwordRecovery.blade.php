
    <div style="border: 3px solid grey; border-radius:25px; width: 60%; height: 40%; margin-left: auto; margin-right: auto; margin-top: 10%; padding: 10px 10px 10px 10px;">
        <form action="/" method="POST">
            @csrf
            <legend>Password Recovery</legend>
            <table>
                <tr>
                    <td><label>Email: </label></td>
                    <td><input type="text" name="email" id="email" size="60%" placeholder="Please fill in your email here" /></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <input type="submit" name="loginRecoverCancel" value="Submit" id="submit" style="margin: 10px 10px 10px 10px;"/>
                        <input type="submit" name="loginRecoverCancel" value="Cancel" id="cancel" style="margin: 10px 10px 10px 10px;" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
