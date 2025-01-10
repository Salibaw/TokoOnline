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

    public function shopByCategory($categorySlug)
    {
        $category = Category::where('slug', $categorySlug)->firstOrFail();
        $categories = Category::where('status', 1)->with('subcategories')->get();
        
        $products = Product::where('category_id', $category->id)->paginate(12);
    
        return view('front.shop', compact('category', 'categories', 'products'));
    }
    public function shopBySubcategory($subcategorySlug)
    {
        $subcategory = Subcategory::where('slug', $subcategorySlug)->firstOrFail();
        $categories = Category::where('status', 1)->with('subcategories')->get();
        $products = Product::where('sub_category_id', $subcategory->id)->paginate(12);
    
        return view('front.shop', compact('subcategory', 'categories', 'products'));
    }
        
    public function showCategoryProducts(Category $category)
    {
        $products = Product::where('category_id', $category->id)->paginate(12);

        $categories = Category::with('subcategories')->get();

        return view('front.shop', compact('category', 'products', 'categories'));
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
