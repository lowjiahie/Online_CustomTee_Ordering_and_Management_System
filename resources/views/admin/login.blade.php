<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            background-color: black;
        }

        header {
            background-color: black;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 15vh;
            box-shadow: 5px 5px 10px rgb(0, 0, 0, 0.3);
        }

        h1 {
            letter-spacing: 1.5vw;
            font-family: 'system-ui';
            text-transform: uppercase;
            text-align: center;
        }

        a {
            text-align: right;
            text-decoration: underline blue;
            margin-left: 70%;
        }

        table {
            margin: 0 auto;
        }

        main {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 70vh;
            width: 100%;
            background: url(https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Mountains-1412683.svg/1280px-Mountains-1412683.svg.png) no-repeat center center;
            background-size: cover;
        }

        .form_class {
            width: 500px;
            padding: 40px;
            border-radius: 8px;
            background-color: white;
            font-family: 'system-ui';
            box-shadow: 5px 5px 10px rgb(0, 0, 0, 0.3);
        }

        .form_div {
            text-transform: uppercase;
        }

        .form_div label {
            letter-spacing: 3px;
            font-size: 1rem;
        }

        .field_class {
            width: 100%;
            border-radius: 6px;
            border-style: solid;
            border-width: 1px;
            padding: 5px 0px;
            text-indent: 6px;
            margin-top: 10px;
            margin-bottom: 20px;
            font-family: 'system-ui';
            font-size: 0.9rem;
            letter-spacing: 2px;
        }

        .submit_class {
            border-style: none;
            border-radius: 5px;
            background-color: black;
            color: white;
            padding: 8px 50px;
            font-family: 'system-ui';
            text-transform: uppercase;
            letter-spacing: .8px;
            display: block;
            margin-top: 10px;
            margin-left: 10px;
            margin-right: 10px;
            box-shadow: 2px 2px 5px rgb(0, 0, 0, 0.2);
            cursor: pointer;
        }

        footer {
            height: 10  vh;
            background-color: black;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: -5px -5px 10px rgb(0, 0, 0, 0.3);
        }

        footer p {
            text-align: center;
            font-family: 'system-ui';
            letter-spacing: 3px;
        }

        footer p a {
            text-decoration: none;
            color: white;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <header>
        <h1><b>Staff Login Form</b></h1>
    </header>
    <main>
        <form action="{{ route('admin.loginSubmit') }}" method="POST" id="login_form" class="form_class">
            @csrf
            <div class="form_div">
                <label>Email: </label>
                <input type="text" class="field_class" name="email" id="email" size="60%"
                    placeholder="Please fill in your email here" />

                <label>Password: </label>
                <input type="password" class="field_class" name="password" id="password" size="60%"
                    placeholder="Please fill in your password here" />

                <a href="{{ route('admin.forgotPassword') }}">
                    Forgot Password
                </a>
                <table>
                    <tr>
                        <td>
                            <input type="submit" class="submit_class" name="loginRecoverCancel" value="Login"
                                id="login" />
                        </td>
                        <td>
                            <input type="submit" class="submit_class" name="loginRecoverCancel" value="Cancel"
                                id="cancel" />
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </main>
    <footer>

    </footer>
</body>

</html>
