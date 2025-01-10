<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index()
{
    $categories = Category::where('status', 1)->with('subcategories')->get(); 
    $products = Product::with('images')->where('status', 1)->get();
    $cartItems = session()->get('cart', []); // Ambil data terbaru dari session

    if (empty($cartItems)) {
        return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
    }

    return view('front.checkout', compact('cartItems','categories', 'products'));
}

}
