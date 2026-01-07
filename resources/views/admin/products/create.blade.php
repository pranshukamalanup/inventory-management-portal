@extends('admin.layouts.app')

@section('title', 'Add Product')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="card shadow-sm">
            <div class="card-body">

                <h4 class="mb-3">Add Product</h4>

                {{-- Validation Errors --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST"
                      action="/admin/products"
                      enctype="multipart/form-data">
                    @csrf

                    <!-- Product Name -->
                    <div class="mb-3">
                        <input type="text"
                               name="name"
                               class="form-control"
                               placeholder="Product Name"
                               value="{{ old('name') }}"
                               required>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <textarea name="description"
                                  class="form-control"
                                  placeholder="Description">{{ old('description') }}</textarea>
                    </div>

                    <!-- Price -->
                    <div class="mb-3">
                        <input type="number"
                               step="0.01"
                               name="price"
                               class="form-control"
                               placeholder="Price"
                               value="{{ old('price') }}"
                               required>
                    </div>

                    <!-- Category -->
                    <div class="mb-3">
                        <input type="text"
                               name="category"
                               class="form-control"
                               placeholder="Category"
                               value="{{ old('category') }}"
                               required>
                    </div>

                    <!-- Stock -->
                    <div class="mb-3">
                        <input type="number"
                               name="stock"
                               class="form-control"
                               placeholder="Stock"
                               value="{{ old('stock') }}"
                               required>
                    </div>

                    <!-- Image -->
                    <div class="mb-3">
                        <input type="file"
                               name="image"
                               class="form-control">
                        <small class="text-muted">
                            Allowed: jpg, jpeg, png
                        </small>
                    </div>

                    <button class="btn btn-success">
                        Save Product
                    </button>

                </form>

            </div>
        </div>

    </div>
</div>
@endsection
