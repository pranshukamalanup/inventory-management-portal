<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <style>
        body {
            margin: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif;
            background: #f1f3f6;
        }

        .header {
            background: #172337; /* Flipkart dark blue */
            color: #fff;
            padding: 14px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header .left {
            font-size: 18px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .header .right {
            font-size: 14px;
        }

        .header .right form {
            display: inline;
            margin-left: 12px;
        }

        .header button {
            background: none;
            border: 1px solid #fff;
            color: #fff;
            padding: 4px 10px;
            font-size: 13px;
            border-radius: 3px;
            cursor: pointer;
        }

        .container {
            padding: 40px 20px;
        }

        .card {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            width: 480px;
            margin: auto;
        }

        .btn-primary {
            display: inline-block;
            padding: 12px 22px;
            background: #2874f0; /* Flipkart blue */
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 500;
        }

        .btn-primary:hover {
            background: #0b5ed7;
        }
    </style>
</head>
<body>

<div class="header">
    <div class="left">Admin Panel</div>

    @auth('admin')
        <div class="right">
            {{ auth('admin')->user()->name }}
            <form method="POST" action="/admin/logout">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    @endauth
</div>

<div class="container">
