@extends('admin.layouts.app')

@section('title', 'Admin Registration')

@section('content')

<div class="container d-flex justify-content-center align-items-center" style="min-height:85vh;">
    <div class="col-md-6 col-lg-5">

        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-4">

                {{-- Heading --}}
                <h3 class="text-center fw-bold mb-2">Admin Registration</h3>
                <p class="text-center text-muted mb-4">
                    Create a new admin account
                </p>

                {{-- Validation Errors --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0 small">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Registration Form --}}
                <form method="POST" action="/admin/register">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Full Name</label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               placeholder="Enter full name"
                               value="{{ old('name') }}"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email Address</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               placeholder="Enter email"
                               value="{{ old('email') }}"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password</label>
                        <input type="password"
                               name="password"
                               class="form-control"
                               placeholder="Create password"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Confirm Password</label>
                        <input type="password"
                               name="password_confirmation"
                               class="form-control"
                               placeholder="Confirm password"
                               required>
                    </div>

                    <button type="submit"
                            class="btn btn-primary w-100 fw-semibold">
                        Register Admin
                    </button>
                </form>

                <hr class="my-4">

                <p class="text-center mb-0">
                    Already registered?
                    <a href="/admin/login" class="fw-semibold text-decoration-none">
                        Login here
                    </a>
                </p>

            </div>
        </div>

    </div>
</div>

@endsection
