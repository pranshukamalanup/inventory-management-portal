@extends('admin.layouts.app')

@section('title', 'Edit Product')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="card shadow-sm">
                <div class="card-body">

                    <h4 class="mb-4">Edit Product</h4>

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
                          action="/admin/products/{{ $product->id }}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            <!-- Product Name -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Product Name</label>
                                <input type="text"
                                       name="name"
                                       class="form-control"
                                       value="{{ old('name', $product->name) }}"
                                       required>
                            </div>

                            <!-- Price -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Price</label>
                                <input type="number"
                                       step="0.01"
                                       name="price"
                                       class="form-control"
                                       value="{{ old('price', $product->price) }}"
                                       required>
                            </div>

                            <!-- Description -->
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description"
                                          class="form-control"
                                          rows="3">{{ old('description', $product->description) }}</textarea>
                            </div>

                            <!-- Category -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Category</label>
                                <input type="text"
                                       name="category"
                                       class="form-control"
                                       value="{{ old('category', $product->category) }}"
                                       required>
                            </div>

                            <!-- Stock -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Stock</label>
                                <input type="number"
                                       name="stock"
                                       class="form-control"
                                       value="{{ old('stock', $product->stock) }}"
                                       required>
                            </div>

                            <!-- Current Image -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Current Image</label><br>
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                         width="120"
                                         class="img-thumbnail"
                                         style="cursor:pointer"
                                         data-bs-toggle="modal"
                                         data-bs-target="#imageModal">
                                @else
                                    <p class="text-muted">No image available</p>
                                @endif
                            </div>

                            <!-- Upload Image -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Change Image</label>
                                <input type="file"
                                       name="image"
                                       class="form-control">
                                <small class="text-muted">
                                    Leave empty to keep existing image
                                </small>
                            </div>

                        </div>

                        <div class="mt-4">
                            <button class="btn btn-primary">
                                Update Product
                            </button>

                            <a href="/admin/products"
                               class="btn btn-secondary ms-2">
                                Back
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- IMAGE MODAL -->
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Product Image</h5>
                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img src="{{ asset('storage/' . $product->image) }}"
                    class="img-fluid"
                    alt="Product Image">
            </div>
        </div>
    </div>
</div>
@endsection
