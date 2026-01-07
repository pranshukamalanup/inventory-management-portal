@extends('customer.layouts.app')

@section('title', 'Product Details')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-9 col-lg-8">

        <div class="card shadow-sm border-0">
            <div class="row g-0">

                {{-- Image --}}
                <div class="col-md-5">
                    <img
                        src="{{ $product->image
                            ? asset('storage/' . $product->image)
                            : asset('images/default-product.png') }}"
                        class="img-fluid rounded-start"
                        style="height:100%; object-fit:cover;"
                        alt="{{ $product->name }}">
                </div>

                {{-- Details --}}
                <div class="col-md-7">
                    <div class="card-body">

                        <h4 class="card-title mb-2">
                            {{ $product->name }}
                        </h4>

                        <p class="text-muted mb-1">
                            Category: {{ $product->category }}
                        </p>

                        <h5 class="text-success mb-3">
                            ₹{{ number_format($product->price, 2) }}
                        </h5>

                        <p class="mb-3">
                            {{ $product->description ?? 'No description available.' }}
                        </p>

                        <p class="small text-muted">
                            Stock Available: {{ $product->stock }}
                        </p>

                        <a href="/customer/dashboard" class="btn btn-outline-secondary btn-sm">
                            ← Back to Products
                        </a>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
