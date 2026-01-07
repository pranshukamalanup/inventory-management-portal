@extends('admin.layouts.app')

@section('title', 'Admin Registration')

@section('content')
    <div class="card">
        <h3 style="text-align:center; margin-bottom:20px;">Admin Registration</h3>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div style="background:#fdecea; padding:10px; margin-bottom:15px; border-radius:4px;">
                <ul style="margin:0; padding-left:18px; color:#e74c3c;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/admin/register">
            @csrf

            <input type="text"
                   name="name"
                   placeholder="Full Name"
                   value="{{ old('name') }}"
                   required>

            <input type="email"
                   name="email"
                   placeholder="Email"
                   value="{{ old('email') }}"
                   required>

            <input type="password"
                   name="password"
                   placeholder="Password"
                   required>

            <input type="password"
                   name="password_confirmation"
                   placeholder="Confirm Password"
                   required>

            <button type="submit">Register</button>
        </form>

        <p style="text-align:center; margin-top:15px;">
            Already registered?
            <a href="/admin/login">Login</a>
        </p>
    </div>
@endsection
