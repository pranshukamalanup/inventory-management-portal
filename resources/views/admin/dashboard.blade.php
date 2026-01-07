@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="card shadow-sm">
            <div class="card-body text-center">

                <h4 class="card-title mb-2">
                    Welcome, {{ auth('admin')->user()->name }}
                </h4>

                <p class="text-muted mb-4">
                    You are logged in successfully.
                </p>

                <a href="/admin/products" class="btn btn-primary px-4">
                    Manage Products
                </a>

            </div>
        </div>

    </div>
</div>
@endsection
