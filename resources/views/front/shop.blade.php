@extends('front.layouts.header')

@section('content')
<style>
    /* Main container styling */
    .product-page {
        display: flex;
        gap: 20px;
    }

    /* Sidebar category styling */
    .sidebar {
        flex: 1;
        max-width: 250px;
        border-right: 1px solid #ddd;
        padding-right: 15px;
        background-color: rgba(255, 255, 255, 0.9);
        /* White with 90% opacity for transparency */
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        /* Light shadow for depth */
    }

    .sidebar h3 {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 20px;
        color: #333;
        /* Darker text for clarity */
    }

    /* Add spacing between categories */
    .sidebar .navbar-nav .nav-item {
        margin-bottom: 15px;
        /* Space between categories */
    }

    /* Dropdown Button Styling */
    .sidebar .navbar-nav .nav-item .dropdown-toggle {
        background-color: rgba(255, 255, 255, 0.9);
        /* Transparent white background for dropdown button */
        color: #007bff;
        /* Blue text */
        border: 1px solid #ddd;
        /* Light border around button */
        width: 100%;
        padding: 12px;
        font-weight: bold;
        text-align: left;
        border-radius: 8px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .sidebar .navbar-nav .nav-item .dropdown-toggle:hover {
        background-color: rgba(248, 249, 250, 0.8);
        /* Light gray hover effect with transparency */
        color: #0056b3;
        /* Darker blue text on hover */
    }

    /* Dropdown Menu Styling */
    .sidebar .navbar-nav .nav-item .dropdown-menu {
        background-color: rgba(255, 255, 255, 0.95);
        /* Slightly transparent white background for dropdown */
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 10px 0;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        /* Light shadow for dropdown */
    }

    .sidebar .navbar-nav .nav-item .dropdown-item {
        padding: 10px 20px;
        color: #333;
        /* Dark text for clarity */
        font-weight: normal;
        text-decoration: none;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .sidebar .navbar-nav .nav-item .dropdown-item:hover {
        background-color: rgba(240, 240, 240, 0.8);
        /* Light gray hover effect with transparency */
        color: #007bff;
        /* Change text color to blue on hover */
    }

    .sidebar .navbar-nav .nav-item .dropdown-item.active {
        background-color: #007bff;
        /* Blue background for active item */
        color: white;
        /* White text for active item */
    }

    /* Product content styling */
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

    /* Button styling */
    .product-card .btn {
        margin-top: 10px;
    }
</style>

<div class="container mt-4">
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Home</a> <span>&gt;</span>
        <a href="#">{{ $subcategory->category->name }}</a> <span>&gt;</span>
        <span>{{ $subcategory->name }}</span>
    </div>

    <div class="product-page">
        <!-- Sidebar with categories -->
        <div class="sidebar">
            <h3>Product Category</h3>
            <ul class="navbar-nav">
                @foreach ($categories as $category)
                    <li class="nav-item">
                        <!-- Category name (non-clickable) -->
                        <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ $category->name }}
                        </button>

                        <!-- Subcategories list -->
                        @if ($category->subcategories->isNotEmpty())
                            <ul class="dropdown-menu">
                                @foreach ($category->subcategories as $subcategory)
                                    <li>
                                        <a class="dropdown-item nav-link" href="{{ route('front.shop', $subcategory->slug) }}">
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

        <!-- Product content -->
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

                        <!-- View Detail Button -->
                        <a href="{{ route('product.detail', $product->id) }}" class="btn btn-primary btn-sm">Lihat
                            Detail</a>

                        <!-- Add to Cart Button -->
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1"> <!-- Atur default quantity -->
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="fa fa-shopping-cart"></i> Add To Cart
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $products->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>

@endsection