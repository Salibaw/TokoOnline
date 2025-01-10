@extends('front.layouts.header')

@section('content')
<style>
    /* Gaya CSS yang sudah diberikan */
    .product-page {
        display: flex;
        gap: 20px;
    }

    .sidebar {
        flex: 1;
        max-width: 250px;
        border-right: 1px solid #ddd;
        padding-right: 15px;
        background-color: rgba(255, 255, 255, 0.9);
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .sidebar h3 {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 20px;
        color: #333;
    }

    .sidebar .navbar-nav .nav-item {
        margin-bottom: 15px;
    }

    .sidebar .navbar-nav .nav-item .dropdown-toggle {
        background-color: rgba(255, 255, 255, 0.9);
        color: #007bff;
        border: 1px solid #ddd;
        width: 100%;
        padding: 12px;
        font-weight: bold;
        text-align: left;
        border-radius: 8px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .sidebar .navbar-nav .nav-item .dropdown-toggle:hover {
        background-color: rgba(248, 249, 250, 0.8);
        color: #0056b3;
    }

    .sidebar .navbar-nav .nav-item .dropdown-menu {
        background-color: rgba(255, 255, 255, 0.95);
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 10px 0;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .sidebar .navbar-nav .nav-item .dropdown-item {
        padding: 10px 20px;
        color: #333;
        font-weight: normal;
        text-decoration: none;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .sidebar .navbar-nav .nav-item .dropdown-item:hover {
        background-color: rgba(240, 240, 240, 0.8);
        color: #007bff;
    }

    .sidebar .navbar-nav .nav-item .dropdown-item.active {
        background-color: #007bff;
        color: white;
    }

    .product-content {
        flex: 3;
    }

    .breadcrumb {
        margin-bottom: 20px;
        font-size: 0.9rem;
    }

    .breadcrumb a {
        text-decoration: none;
        color: #007bff;
    }

    .breadcrumb a:hover {
        text-decoration: underline;
    }

    .breadcrumb span {
        margin: 0 5px;
        color: #6c757d;
    }

    .product-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
    }

    .product-card {
        text-align: center;
        border: 1px solid #ddd;
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s;
    }

    .product-card:hover {
        transform: scale(1.05);
    }

    .product-card img {
        width: 100%;
        height: 300px;
        object-fit: cover;
    }

    .product-card h5 {
        margin: 10px 0;
        font-size: 1rem;
        color: #333;
    }

    .product-card .price {
        color: #e83e8c;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .product-card .old-price {
        text-decoration: line-through;
        color: #6c757d;
        font-size: 0.9rem;
    }

    .product-card .btn {
        margin-top: 10px;
    }
</style>

<div class="container mt-4">
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Home</a> <span>&gt;</span>
        <a href="#">{{ $category->name ?? 'All Categories' }}</a> <!-- Gunakan data kategori atau default -->
    </div>


    <div class="product-page">
        <!-- Sidebar -->
        <div class="sidebar">
            <h3>Product Category</h3>
            <ul class="navbar-nav">
                @foreach ($categories as $category)
                    <li class="nav-item">
                        <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ $category->name }}
                        </button>
                        @if ($category->subcategories->isNotEmpty())
                            <ul class="dropdown-menu">
                                @foreach ($category->subcategories as $subcategory)
                                    <li>
                                        <a class="dropdown-item nav-link" href="{{ route('front.shop.subcategory', $subcategory->slug) }}">
                                            {{ $subcategory->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Produk -->
        <div class="product-content">
            <div class="product-header">
                <div>Showing {{ $products->count() }} of {{ $products->total() }} items</div>
            </div>

            <div class="product-grid">
                @foreach ($products as $product)
                    <div class="product-card">
                        <img src="{{ asset('uploads/product/' . $product->images->first()->image) }}"
                            alt="{{ $product->name }}">
                        <h5>{{ $product->title }}</h5>
                        <p class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <p class="old-price">Rp {{ number_format($product->compare_price, 0, ',', '.') }}</p>
                        <a href="{{ route('product.detail', $product->id) }}" class="btn btn-primary btn-sm">Lihat
                            Detail</a>
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="fa fa-shopping-cart"></i> Add To Cart
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $products->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>

@endsection