<!DOCTYPE html>
<html>
<head>
    <title>Inventory Management Portal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f6fa;
            text-align: center;
            padding-top: 120px;
        }
        .box {
            display: inline-block;
            margin: 20px;
            padding: 30px;
            background: #fff;
            border-radius: 6px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 250px;
        }
        a {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            padding: 10px 20px;
            background: #2f3640;
            color: #fff;
            border-radius: 4px;
        }
    </style>
</head>
<body>

    <h1>Inventory Management Portal</h1>
    <p>Please choose your role to continue</p>

    <div class="box">
        <h3>Admin</h3>
        <a href="/admin/login">Admin Login</a>
    </div>

    <div class="box">
        <h3>Customer</h3>
        <a href="/customer/login">Customer Login</a>
    </div>

</body>
</html>
