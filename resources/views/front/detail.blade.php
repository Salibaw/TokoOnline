@extends('front.layouts.header')

@section('content')
<style>
    .product-detail .product-images img {
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: 8px;
    }

    .product-detail .price {
        color: #28a745;
        font-size: 1.5rem;
        font-weight: bold;
    }

    .product-detail .price del {
        color: #dc3545;
        font-size: 1.2rem;
        margin-left: 10px;
    }

    .related-products .product-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        border-radius: 10px;
        overflow: hidden;
    }

    .related-products .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
    }

    .related-products .product-image img {
        height: 200px;
        object-fit: cover;
        width: 100%;
        border-radius: 10px 10px 0 0;
    }
</style>

<div class="container product-detail mt-5">
    <div class="row">
        <div class="col-md-6">
            <!-- Gambar produk -->
            @if ($product->images->isNotEmpty())
                <img src="{{ asset('uploads/product/' . $product->images->first()->image) }}" alt="{{ $product->title }}" class="img-fluid">
            @else
                <img src="{{ asset('front-assets/images/no-image.png') }}" alt="No Image" class="img-fluid">
            @endif
        </div>
        <div class="col-md-6">
            <!-- Informasi produk -->
            <h1>{{ $product->title }}</h1>
            <p class="price">
                Rp{{ number_format($product->price, 2) }}
                @if($product->compare_price)
                    <del>Rp{{ number_format($product->compare_price, 2) }}</del>
                @endif
            </p>
            <p>{{ $product->description }}</p>
            <!-- Form untuk menambahkan ke keranjang -->
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1">
                </div>
                <button type="submit" class="btn btn-primary mt-3">
                    <i class="fa fa-shopping-cart"></i> Add to Cart
                </button>
            </form>
        </div>
    </div>

    <!-- Produk terkait -->
    <div class="related-products mt-5">
        <h3>Related Products</h3>
        <div class="row">
            @foreach($relatedProducts as $related)
                <div class="col-md-3">
                    <div class="card product-card">
                        <div class="product-image">
                            <a href="{{ route('product.detail', $related->id) }}">
                                @if ($related->images->isNotEmpty())
                                    <img src="{{ asset('uploads/product/' . $related->images->first()->image) }}" alt="{{ $related->title }}" class="img-fluid">
                                @else
                                    <img src="{{ asset('front-assets/images/no-image.png') }}" alt="No Image" class="img-fluid">
                                @endif
                            </a>
                        </div>
                        <div class="card-body text-center">
                            <a href="{{ route('product.detail', $related->id) }}" class="h6">
                                {{ $related->title }}
                            </a>
                            <p class="price">
                                Rp{{ number_format($related->price, 2) }}
                                @if($related->compare_price)
                                    <del>Rp{{ number_format($related->compare_price, 2) }}</del>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
