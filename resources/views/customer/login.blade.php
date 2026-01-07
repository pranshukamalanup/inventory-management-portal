@extends('customer.layouts.app')

@section('title', 'Customer Login')

@section('content')
<div class="row justify-content-center align-items-center" style="min-height:70vh;">
    <div class="col-md-5 col-lg-4">

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">

                <h4 class="text-center mb-4 fw-bold">Customer Login</h4>

                @if ($errors->any())
                    <div class="alert alert-danger small">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="/customer/login">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email"
                               name="email"
                               value="{{ old('email') }}"
                               class="form-control"
                               placeholder="Enter email"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password"
                               name="password"
                               class="form-control"
                               placeholder="Enter password"
                               required>
                    </div>

                    <button class="btn btn-primary w-100">
                        Login
                    </button>
                </form>

                <hr>

                <p class="text-center mb-0 small">
                    New Customer?
                    <a href="/customer/register" class="fw-semibold">Create Account</a>
                </p>

            </div>
        </div>

    </div>
</div>
@endsection
