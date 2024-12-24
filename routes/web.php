<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\admin\TempImagesController;
use App\Http\Controllers\admin\OrdersController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MidtransController;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Define the route for creating a Midtrans transaction

Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/shop/{subcategorySlug}', [FrontController::class, 'shop'])->name('front.shop');
Route::get('/shop/{category_id}', [ProductController::class, 'categoryProducts'])->name('front.shop.category');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//Product Routes
Route::get('/product/{id}', [ProductController::class, 'detail'])->name('product.detail');
Route::get('/product', [ProductController::class, 'sort'])->name('products.index');


Route::middleware(['auth', 'role:user'])->group(function () {
    // Checkout Routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    //Order Routes
    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.myOrders')->middleware('auth');
    Route::get('/my-orders/{order}', [OrderController::class, 'viewOrder'])->name('orders.viewOrder')->middleware('auth');
    //Midtrans Routes
    Route::post('/checkout/process', [MidtransController::class, 'process'])->name('checkout.process');
    //Route Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    
});


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    // Category Routes
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    //Sub Category Routes
    Route::prefix('sub-categories')->group(function () {
        Route::get('/', [SubCategoryController::class, 'index'])->name('subcategories.index');
        Route::get('/create', [SubCategoryController::class, 'create'])->name('subcategories.create');
        Route::post('/', [SubCategoryController::class, 'store'])->name('subcategories.store');
        Route::get('/{subCategory}/edit', [SubCategoryController::class, 'edit'])->name('subcategories.edit');
        Route::put('/{subCategory}', [SubCategoryController::class, 'update'])->name('subcategories.update');
        Route::delete('/{subCategory}', [SubCategoryController::class, 'destroy'])->name('subcategories.destroy');
    });
    //Brand Routes
    Route::get('/brand', [BrandController::class, 'index'])->name('brand.index');
    Route::get('/brand/create', [BrandController::class, 'create'])->name('brand.create');
    Route::post('/brand', [BrandController::class, 'store'])->name('brand.store');
    Route::get('/brand/{brand}/edit', [BrandController::class, 'edit'])->name('brand.edit');
    Route::put('/brand/{brand}', [BrandController::class, 'update'])->name('brand.update');
    Route::delete('/brand/{brand}', [BrandController::class, 'destroy'])->name('brand.destroy');
    // Product Routes
    Route::get('/products', [ProductController::class, 'index'])->name('product.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/products', [ProductController::class, 'store'])->name('product.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::delete('/products/delete-image/{id}', [ProductController::class, 'destroyImage'])->name('product.destroyImage');
    //Order
    Route::post('/orders/{id}/update-status', [OrdersController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    Route::get('/orders', [OrdersController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{id}', [OrdersController::class, 'show'])->name('admin.orders.show');
    // Temporary Image Upload Route
    Route::post('/upload-temp-image', [TempImagesController::class, 'create'])->name('temp-images.create');
    // Temporary Image Delete Route (for Dropzone file removal)
    Route::delete('/delete-temp-image/{imageId}', [TempImagesController::class, 'delete'])->name('temp-images.delete');
    // Slug Generation Route
    Route::get('/getSlug', function (Request $request) {
        $slug = '';
        if (!empty($request->title)) {
            $slug = Str::slug($request->title);
        }
        return response()->json([
            'status' => true,
            'slug' => $slug
        ]);
    })->name('getSlug');
});
require __DIR__ . '/auth.php';
