@extends('customer.layouts.app')

@section('title', 'Customer Dashboard')

@section('content')

{{-- Welcome --}}
<div class="mb-4">
    <h4 class="fw-bold">
        Welcome, {{ auth('customer')->user()->name }}
    </h4>
    <p class="text-muted mb-0">
        Browse available products
    </p>
</div>

<div class="row">

    {{-- ================= CATEGORY FILTER ================= --}}
    <div class="col-md-3 mb-4">

        <div class="card shadow-sm border-0">
            <div class="card-body">

                <h6 class="fw-bold mb-3">Categories</h6>

                <form method="GET" action="{{ url('/customer/dashboard') }}">

                    @foreach ($categories as $category)
                        <div class="form-check mb-2">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="category"
                                value="{{ $category }}"
                                id="cat_{{ $loop->index }}"
                                onchange="this.form.submit()"
                                {{ request('category') == $category ? 'checked' : '' }}
                            >
                            <label class="form-check-label" for="cat_{{ $loop->index }}">
                                {{ $category }}
                            </label>
                        </div>
                    @endforeach

                    @if(request('category'))
                        <a href="{{ url('/customer/dashboard') }}"
                           class="btn btn-sm btn-light mt-3 w-100">
                            Clear Filter
                        </a>
                    @endif

                </form>

            </div>
        </div>

    </div>

    {{-- ================= PRODUCT LIST ================= --}}
    <div class="col-md-9">

        <div class="row g-4">

            @forelse ($products as $product)
                <div class="col-sm-6 col-lg-4">

                    <div class="card h-100 shadow-sm border-0">

                        <img
                            src="{{ $product->image
                                ? asset('storage/' . $product->image)
                                : asset('images/default-product.png') }}"
                            class="card-img-top"
                            style="height:180px; object-fit:cover;"
                            alt="{{ $product->name }}">

                        <div class="card-body d-flex flex-column">

                            <h6 class="mb-1">{{ $product->name }}</h6>

                            <small class="text-muted mb-2">
                                {{ $product->category }}
                            </small>

                            <div class="fw-bold text-success mb-3">
                                ₹{{ number_format($product->price, 2) }}
                            </div>

                            <a href="/customer/catalog/{{ $product->id }}"
                               class="btn btn-outline-primary btn-sm mt-auto">
                                View Details
                            </a>

                        </div>
                    </div>

                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-light border text-center">
                        No products found.
                    </div>
                </div>
            @endforelse

        </div>

        {{-- Pagination --}}
        @if ($products->hasPages())
            <div class="mt-4 d-flex justify-content-center">
                {{ $products->links() }}
            </div>
        @endif

    </div>
</div>

@endsection
