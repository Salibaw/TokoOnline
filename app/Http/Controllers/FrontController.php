<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
class FrontController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 1)->with('subcategories')->get();
        $products = Product::with('images')->where('status', 1)->get();
        return view('front.home', compact('categories', 'products'));
    }
    public function showShopPage(Request $request)
    {
        
        // Get the category from the request (if present)
        $categories = $request->input('categories');
        // Fetch products based on category
        if ($categories) {
            $products = Product::where('categories', $categories)->get();
        } else {
            $products = Product::all(); // Show all products if no category is selected
        }

        // Return the view with the products
        return view('front.shop', compact('products','categories','products'));
    }
    public function cart()
    {
        $categories = Category::where('status', 1)->with('subcategories')->get();
        $products = Product::with('images')->where('status', 1)->get();
        return view('front.cart', compact('categories', 'products'));
    }

    public function checkout()
    {
        $categories = Category::where('status', 1)->with('subcategories')->get();
        $products = Product::with('images')->where('status', 1)->get();
        return view('front.checkout', compact('categories', 'products'));
    }
}
