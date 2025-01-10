@extends('front.layouts.header')

@section('content')
<style>
    .cat-card .left img {
        width: 100%;
        /* Pastikan gambar menyesuaikan lebar container */
        height: 200px;
        /* Tetapkan tinggi tetap untuk seragam */
        object-fit: cover;
        /* Menjaga proporsi gambar dan memotong jika perlu */
        border-radius: 5px;
        /* Opsional: Tambahkan radius sudut jika diinginkan */
    }

    .product-card .product-image img {
        width: 100%;
        /* Mengisi lebar kartu secara penuh */
        height: 200px;
        /* Menyesuaikan tinggi gambar */
        object-fit: cover;
        /* Memastikan gambar tidak terdistorsi dan terpotong dengan baik */
        border-radius: 8px;
        /* Opsional: menambahkan radius pada sudut */
    }
</style>
<main>
<section class="section-1">
    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel"
        data-bs-interval="false">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <picture>
                    <source media="(max-width: 799px)" srcset="{{asset('front-assets/images/carousel-1-m.jpg')}}" />
                    <source media="(min-width: 800px)" srcset="{{asset('front-assets/images/carousel-1.jpg')}}" />
                    <img src="{{asset('front-assets/images/carousel-1.jpg')}}" alt="" />
                </picture>
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3">
                        <h1 class="display-4 text-white mb-3">Kids Fashion</h1>
                        <p class="mx-md-5 px-5">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                        <!-- Add query parameter to filter by "Kids Fashion" -->
                        <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{ route('front.shop.category', 'kids-fashion') }}">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <picture>
                    <source media="(max-width: 799px)" srcset="{{asset('front-assets/images/carousel-2-m.jpg')}}" />
                    <source media="(min-width: 800px)" srcset="{{asset('front-assets/images/carousel-2.jpg')}}" />
                    <img src="{{asset('front-assets/images/carousel-2.jpg')}}" alt="" />
                </picture>
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3">
                        <h1 class="display-4 text-white mb-3">Womens Fashion</h1>
                        <p class="mx-md-5 px-5">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                        <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{ route('front.shop.category', 'womens-fashion') }}">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <picture>
                    <source media="(max-width: 799px)" srcset="{{asset('front-assets/images/carousel-3-m.jpg')}}" />
                    <source media="(min-width: 800px)" srcset="{{asset('front-assets/images/carousel-3.jpg')}}" />
                    <img src="{{asset('front-assets/images/carousel-2.jpg')}}" alt="" />
                </picture>
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3">
                        <h1 class="display-4 text-white mb-3">Shop Online at Flat 70% off on Branded Clothes</h1>
                        <p class="mx-md-5 px-5">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                        <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{ route('front.shop.category', 'kids-fashion',) }}">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

    <section class="section-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="box shadow-lg">
                        <div class="fa icon fa-check text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">Quality Product</h5>
                    </div>
                </div>
                <div class="col-lg-3 ">
                    <div class="box shadow-lg">
                        <div class="fa icon fa-shipping-fast text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">Free Shipping</h2>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="box shadow-lg">
                        <div class="fa icon fa-exchange-alt text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">14-Day Return</h2>
                    </div>
                </div>
                <div class="col-lg-3 ">
                    <div class="box shadow-lg">
                        <div class="fa icon fa-phone-volume text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">24/7 Support</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-3">
        <div class="container">
            <div class="section-title">
                <h2>Categories</h2>
            </div>
            <div class="row pb-3">
                @foreach($categories as $category)
                    <div class="col-lg-3">
                        <div class="cat-card">
                            <div class="left">
                                <img src="{{ asset('uploads/' . $category->image) }}" alt="{{ $category->name }}"
                                    class="img-fluid">
                            </div>
                            <div class="right">
                                <div class="cat-data">
                                    <h2>{{ $category->name }}</h2>
                                    <p>{{ $category->products->count() }} Products</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-4 pt-5">
        <div class="container">
            <div class="section-title">
                <h2>Featured Products</h2>
            </div>
            <div class="row pb-3">
                @foreach($products as $product)
                    <div class="col-md-3">
                        <div class="card product-card">
                            <div class="product-image position-relative">
                                <a href="{{ route('product.detail', $product->id) }}" class="product-img">
                                    @if ($product->images->isNotEmpty())
                                        <img src="{{ asset('uploads/product/' . $product->images->first()->image) }}"
                                            class="img-thumbnail" alt="{{ $product->title }}">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                    <div class="product-action">
                                        <form action="{{ route('cart.add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="quantity" value="1"> <!-- Atur default quantity -->
                                            <button type="submit" class="btn btn-dark">
                                                <i class="fa fa-shopping-cart"></i> Add To Cart
                                            </button>
                                        </form>
                                    </div>
                            </div>
                            <div class="card-body text-center mt-3">
                                <a class="h6 link" href="{{ route('product.detail', $product->id) }}">
                                    {{ $product->title }}
                                </a>
                                <div class="price mt-2">
                                    <span class="h5"><strong>Rp{{ number_format($product->price, 2) }}</strong></span>
                                    @if($product->compare_price)
                                        <span class="h6 text-underline"><del>Rp{{ number_format($product->compare_price, 2) }}</del></span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</main>
@endsection