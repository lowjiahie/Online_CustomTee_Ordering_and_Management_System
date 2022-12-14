<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Password Recovery</title>
</head>

<body>
    <h2>You have requested a password recovery action</h2>
    <p>Click Below link to redirect password recovery page</p>
    <a href="{{ 'http://localhost:3000/customer/pwdRecoveryForm/'.$token }}">redirect to password recovery page</a>
</body>

</html>
