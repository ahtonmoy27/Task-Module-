@extends('layouts.master')

@section('page_title')
    <h1 class="display-4 fw-bold mb-4 text-center">{{ $product->name }}</h1>
@endsection

@section('content')
<div class="container my-5">
    <div class="row g-5 align-items-center">
        <!-- Product Image -->
        <div class="col-md-6">
            <div class="border rounded shadow-sm overflow-hidden text-center" style="max-height: 500px;">
                <img src="{{ asset('img/products/' . $product->image) }}" 
                     class="img-fluid w-100" 
                     alt="{{ $product->name }}" 
                     style="object-fit: cover; height: 100%;">
            </div>
        </div>

        <!-- Product Info -->
        <div class="col-md-6">
            <h2 class="mb-3">{{ $product->name }}</h2>
            <p class="text-secondary mb-4 text-dark" style="line-height: 1.6;">{{ $product->description }}</p>


            <div class="mb-4">
                @if($product->old_price)
                    <span class="text-muted fs-5 text-decoration-line-through me-3">${{ number_format($product->old_price, 2) }}</span>
                @endif
                <span class="text-danger fw-bold fs-4">${{ number_format($product->new_price, 2) }}</span>
            </div>

            <p class="text-secondary mb-4" style="line-height: 1.6;">{{ $product->description }}</p>

        </div>
    </div>
</div>
@endsection
