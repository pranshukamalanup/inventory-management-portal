<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f1f3f6;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
    <a class="navbar-brand fw-bold" href="/admin/dashboard">
        Admin Panel
    </a>

    <div class="collapse navbar-collapse justify-content-end">
        @auth('admin')
            <ul class="navbar-nav align-items-center">
                <li class="nav-item text-white me-3">
                    {{ auth('admin')->user()->name }}
                </li>
                <li class="nav-item">
                    <form method="POST" action="/admin/logout">
                        @csrf
                        <button class="btn btn-outline-light btn-sm">
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        @endauth
    </div>
</nav>

<div class="container py-5">
    @yield('content')
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
