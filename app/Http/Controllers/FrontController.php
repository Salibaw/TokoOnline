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

    public function shop($subcategorySlug)
    {
        // Dapatkan subkategori berdasarkan slug
        $subcategory = Subcategory::where('slug', $subcategorySlug)->firstOrFail();

        // Dapatkan kategori
        $categories = Category::where('status', 1)->with('subcategories')->get();

        // Dapatkan produk berdasarkan subkategori
        $products = Product::where('sub_category_id', $subcategory->id)->paginate(12);

        // Tampilkan view shop dengan data
        return view('front.shop', compact('subcategory', 'categories', 'products'));
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
