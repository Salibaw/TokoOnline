<!DOCTYPE html>
<html class="no-js" lang="en_AU" />

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?php echo (!empty($title)) ? 'Title-' . $title : 'Home'; ?></title>
	<meta name="description" content="" />
	<meta name="viewport"
		content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />
	<meta name="HandheldFriendly" content="True" />
	<meta name="pinterest" content="nopin" />
	<meta property="og:locale" content="en_AU" />
	<meta property="og:type" content="website" />
	<meta property="fb:admins" content="" />
	<meta property="fb:app_id" content="" />
	<meta property="og:site_name" content="" />
	<meta property="og:title" content="" />
	<meta property="og:description" content="" />
	<meta property="og:url" content="" />
	<meta property="og:image" content="" />
	<meta property="og:image:type" content="image/jpeg" />
	<meta property="og:image:width" content="" />
	<meta property="og:image:height" content="" />
	<meta property="og:image:alt" content="" />
	<meta name="twitter:title" content="" />
	<meta name="twitter:site" content="" />
	<meta name="twitter:description" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:image:alt" content="" />
	<meta name="twitter:card" content="summary_large_image" />
	<link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/slick.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/slick-theme.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/style.css') }}" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;500&family=Raleway:ital,wght@0,400;0,600;0,800;1,200&family=Roboto+Condensed:wght@400;700&family=Roboto:wght@300;400;700;900&display=swap"
		rel="stylesheet">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<!-- Fav Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="#" />
</head>

<body data-instant-intensity="mousedown">
	<div class="bg-light top-header">
		<div class="container">
			<div class="row align-items-center py-3 d-none d-lg-flex justify-content-between">
				<div class="col-lg-4 logo">
					<a href="/" class="text-decoration-none">
						<span class="h1 text-uppercase text-primary bg-dark px-2">Online</span>
						<span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">SHOP</span>
					</a>
				</div>
				<div class="col-lg-6 col-6 text-left d-flex justify-content-end align-items-center">
					<!-- Search Form -->
					<form action="" class="mr-3">
						<div class="input-group">
							<input type="text" placeholder="Search For Products" class="form-control"
								aria-label="Search">
							<span class="input-group-text">
								<i class="fa fa-search"></i>
							</span>
						</div>
					</form>
					<div class="dropdown">
						@if (Auth::check())
							<a class="dropdown-toggle d-flex align-items-center" href="#" role="button" id="userMenu"
								data-bs-toggle="dropdown" aria-expanded="false">
								<img src="{{ asset('admin-assets/img/avatar.png') }}" alt="Profile" class="rounded-circle"
									style="width: 40px; height: 40px; object-fit: cover;">
							</a>
							<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
								<li class="dropdown-item text-center text-muted">
									<strong>{{ Auth::user()->name }}</strong>
								</li>
								<li>
									<a class="dropdown-item" href="{{ route('profile.edit') }}">
										<i class="fas fa-user-cog mr-2"></i> Profile
									</a>
								</li>
								<li>
									<a class="dropdown-item" href="{{ route('profile.edit') }}">
										<i class="fas fa-id-badge mr-2"></i> My Account
									</a>
								</li>
								<li>
									<hr class="dropdown-divider">
								</li>
								<li>
									<form id="logout-form" action="{{ route('logout') }}" method="POST"
										style="display: none;">
										@csrf
									</form>
									<a class="dropdown-item text-danger" href="#"
										onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
										<i class="fas fa-sign-out-alt mr-2"></i> Logout
									</a>
								</li>
							</ul>
						@else
							<!-- Tampilkan jika belum login -->
							<a class="btn btn-primary mr-2" href="{{ route('login') }}">
								<i class="fas fa-sign-in-alt mr-1"></i> Login
							</a>
							<a class="btn btn-success" href="{{ route('register') }}">
								<i class="fas fa-user-plus mr-1"></i> Register
							</a>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
	<header class="bg-dark">
		<div class="container">
			<nav class="navbar navbar-expand-xl" id="navbar">
				<a href="index.php" class="text-decoration-none mobile-logo">
					<span class="h2 text-uppercase text-primary bg-dark">Online</span>
					<span class="h2 text-uppercase text-white px-2">SHOP</span>
				</a>
				<button class="navbar-toggler menu-btn" type="button" data-bs-toggle="collapse"
					data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
					aria-expanded="false" aria-label="Toggle navigation">
					<i class="navbar-toggler-icon fas fa-bars"></i>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						@foreach ($categories as $category)
							<li class="nav-item">
								<a class="btn btn-dark" href="{{ route('front.shop.category', $category->slug) }}">
									{{ $category->name }}
								</a>
							</li>
						@endforeach
					</ul>
				</div>

				<div class="right-nav py-0">
					<a href="{{ route('cart.index') }}" class="ml-3 d-flex pt-2">
						<i class="fas fa-shopping-cart text-primary"></i>
					</a>
				</div>
			</nav>
		</div>
	</header>

	@yield('content')
	@include('front.layouts.footer')

</body>

</html>