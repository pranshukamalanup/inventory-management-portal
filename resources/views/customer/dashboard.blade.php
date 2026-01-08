@extends('customer.layouts.app')

@section('title', 'Customer Dashboard')

@section('content')

<div class="container-fluid">

    {{-- ================= HEADER ================= --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">
                Welcome, {{ auth('customer')->user()->name }}
            </h4>
            <p class="text-muted mb-0">
                Discover products you’ll love
            </p>
        </div>

        {{-- SEARCH --}}
        <form method="GET" action="{{ url('/customer/dashboard') }}" class="search-bar">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                class="form-control"
                placeholder="Search products…"
            >
            <button class="btn btn-primary">
                🔍
            </button>
        </form>
    </div>

    <div class="row">

        {{-- ================= FILTER SIDEBAR ================= --}}
        <div class="col-md-3 mb-4">

            <div class="card filter-card shadow-sm border-0">
                <div class="card-body">

                    <h6 class="fw-bold mb-3 text-uppercase text-secondary">
                        Filters
                    </h6>

                    {{-- CATEGORY --}}
                    <form method="GET" action="{{ url('/customer/dashboard') }}">

                        <label class="fw-semibold mb-2">Category</label>

                        @foreach ($categories as $category)
                            <div class="form-check mb-2">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="category"
                                    value="{{ $category }}"
                                    onchange="this.form.submit()"
                                    {{ request('category') == $category ? 'checked' : '' }}
                                >
                                <label class="form-check-label">
                                    {{ $category }}
                                </label>
                            </div>
                        @endforeach

                        {{-- PRICE RANGE --}}
                        <hr>
                        <label class="fw-semibold mb-2">
                            Price Range
                        </label>

                        <input type="range"
                               min="0"
                               max="100000"
                               step="500"
                               value="{{ request('price', 100000) }}"
                               class="form-range"
                               name="price"
                               oninput="priceValue.innerText = this.value">

                        <div class="text-muted small">
                            Up to ₹<span id="priceValue">{{ request('price', 100000) }}</span>
                        </div>

                        <button class="btn btn-outline-primary btn-sm w-100 mt-3">
                            Apply
                        </button>

                        @if(request()->anyFilled(['category','search','price']))
                            <a href="{{ url('/customer/dashboard') }}"
                               class="btn btn-light btn-sm w-100 mt-2">
                                Clear Filters
                            </a>
                        @endif

                    </form>

                </div>
            </div>

        </div>

        {{-- ================= PRODUCT GRID ================= --}}
        <div class="col-md-9">

            <div class="row g-4">

                @forelse ($products as $product)
                    <div class="col-sm-6 col-lg-4">

                        <div class="card product-card h-100 border-0 shadow-sm">

                            {{-- IMAGE --}}
                            <div class="image-wrap">
                                <img
                                    loading="lazy"
                                    src="{{ $product->image
                                        ? asset('storage/'.$product->image)
                                        : asset('images/default-product.png') }}"
                                    alt="{{ $product->name }}">

                                {{-- WISHLIST --}}
                                <button class="wishlist-btn" title="Add to wishlist">
                                    ❤️
                                </button>
                            </div>

                            <div class="card-body d-flex flex-column">

                                <h6 class="fw-semibold mb-1">
                                    {{ $product->name }}
                                </h6>

                                <small class="text-muted mb-2">
                                    {{ $product->category }}
                                </small>

                                <div class="fw-bold text-success mb-3 fs-6">
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

            {{-- ================= PAGINATION (FIXED) ================= --}}
            @if ($products->hasPages())
                <div class="mt-5 d-flex justify-content-center">
                    {{ $products->onEachSide(1)->links('pagination::bootstrap-5') }}
                </div>
            @endif

        </div>
    </div>
</div>

{{-- ================= STYLES ================= --}}
<style>
/* SEARCH */
.search-bar {
    display: flex;
    gap: 8px;
    width: 320px;
}
.search-bar input {
    border-radius: 30px;
}
.search-bar button {
    border-radius: 30px;
}

/* FILTER */
.filter-card {
    border-radius: 12px;
}

/* PRODUCT CARD */
.product-card {
    border-radius: 14px;
    transition: transform .2s ease, box-shadow .2s ease;
}
.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 26px rgba(0,0,0,0.15);
}

/* IMAGE */
.image-wrap {
    position: relative;
}
.image-wrap img {
    height: 180px;
    width: 100%;
    object-fit: cover;
    border-radius: 14px 14px 0 0;
}

/* WISHLIST */
.wishlist-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    background: white;
    border: none;
    border-radius: 50%;
    padding: 6px 8px;
    font-size: 16px;
    box-shadow: 0 4px 10px rgba(0,0,0,.2);
    cursor: pointer;
}

/* PAGINATION */
.pagination {
    gap: 6px;
}
.page-link {
    border-radius: 8px !important;
    padding: 6px 14px;
}
.page-item.active .page-link {
    background: #0d6efd;
    border-color: #0d6efd;
}
</style>

@endsection
