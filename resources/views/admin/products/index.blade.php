@extends('admin.layouts.app')

@section('title', 'Products')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h4 class="fw-bold mb-0">
                Products
            </h4>

            <div class="d-flex gap-2">
                <a href="/admin/products/import" class="btn btn-outline-primary btn-sm">
                    Import Products
                </a>

                <a href="/admin/products/create" class="btn btn-success btn-sm">
                    + Add Product
                </a>
            </div>

        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category }}</td>
                        <td>₹ {{ number_format($product->price, 2) }}</td>
                        <td>{{ $product->stock }}</td>
                        <td class="text-center">
                            <a href="/admin/products/{{ $product->id }}/edit"
                               class="btn btn-sm btn-primary">
                                Edit
                            </a>

                            <form method="POST"
                                  action="/admin/products/{{ $product->id }}"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Delete this product?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            No products found.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-end">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>

    </div>
</div>
@endsection
