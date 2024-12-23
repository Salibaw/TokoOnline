@extends('front.layouts.header')
@section('content')
    <div class="container py-5">
        <h2 class="text-center mb-4">Shop</h2>
        
        <!-- Category Filter -->
        <div class="row mb-4">
            <div class="col">
                <h5>Filter by Category</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('front.shop') }}" class="btn btn-outline-primary">All</a></li>
                    <li><a href="{{ route('front.shop', ['category' => 'mens-fashion']) }}" class="btn btn-outline-primary">Men's Fashion</a></li>
                    <li><a href="{{ route('front.shop', ['category' => 'womens-fashion']) }}" class="btn btn-outline-primary">Women's Fashion</a></li>
                    <li><a href="{{ route('front.shop', ['category' => 'kids-fashion']) }}" class="btn btn-outline-primary">Kids Fashion</a></li>
                    <li><a href="{{ route('front.shop', ['category' => 'accessories']) }}" class="btn btn-outline-primary">Accessories</a></li>
                </ul>
            </div>
        </div>

        <!-- Products -->
        <div class="row">
            @if($products->isEmpty())
                <div class="col-12">
                    <p class="text-center">No products found in this category.</p>
                </div>
            @else
                @foreach($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ $product->description }}</p>
                                <p class="card-text"><strong>${{ number_format($product->price, 2) }}</strong></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
