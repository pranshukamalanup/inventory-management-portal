@extends('admin.layouts.app')

@section('title', 'Import Products')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">

            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body p-4">

                    {{-- Heading --}}
                    <h4 class="fw-bold mb-1">Bulk Import Products</h4>
                    <p class="text-muted mb-4">
                        Upload CSV or Excel file to import products in bulk.
                    </p>

                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Import Form --}}
                    <form method="POST"
                          action="/admin/products/import"
                          enctype="multipart/form-data">

                        @csrf

                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Select CSV / Excel File
                            </label>

                            <input
                                type="file"
                                name="file"
                                class="form-control"
                                required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="/admin/products" class="btn btn-outline-secondary">
                                ← Back
                            </a>

                            <button type="submit" class="btn btn-primary px-4">
                                Upload & Import
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
