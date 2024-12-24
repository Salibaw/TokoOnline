<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'subcategory', 'brand'])->paginate(10);

        return view('admin.product.list', compact('products'));
    }


    public function create()
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $brands = Brand::all();
        return view('admin.product.create', compact('categories', 'subCategories', 'brands'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|gte:price',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'nullable|exists:sub_categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'sku' => 'required|string|unique:products,sku',
            'barcode' => 'nullable|string',
            'track_qty' => 'nullable|in:Yes,No',
            'qty' => 'nullable|integer|min:0',
            'status' => 'required|boolean',
            'is_featured' => 'required|in:Yes,No',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Validasi array gambar
        ]);

        // Simpan produk
        // dd($validated);
        $product = Product::create($validated);

        // Simpan gambar
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $index => $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/product'), $imageName);

                $product->images()->create([
                    'image' => $imageName,
                    'sort_order' => $index + 1,
                ]);
            }
        }

        return redirect()->route('product.index')->with('success', 'Product created successfully.');
    }



    public function edit(Product $product)
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $brands = Brand::all();
        return view('admin.product.edit', compact('product', 'categories', 'subCategories', 'brands'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|gte:price',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'nullable|exists:sub_categories,id',
            'is_featured' => 'required|in:Yes,No',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // dd($validated);
        // Update product data
        $product->update($validated);

        // Handle new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/product'), $imageName);

                $product->images()->create([
                    'image' => $imageName,
                    'sort_order' => $index + 1,
                ]);
            }
        }

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }


    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
    }
    public function destroyImage($id)
    {
        $image = ProductImage::findOrFail($id); // Pastikan tabel atau model gambar digunakan sesuai struktur database Anda

        // Hapus file gambar dari penyimpanan
        $imagePath = public_path('uploads/product/' . $image->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Hapus record gambar dari database
        $image->delete();

        return response()->json([
            'success' => true,
            'message' => 'Image deleted successfully.',
        ]);
    }
    public function detail($id)
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $brands = Brand::all();
        $product = Product::with('images')->findOrFail($id);
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $id)
            ->take(4)
            ->get();

        return view('front.detail', compact('product', 'relatedProducts', 'categories', 'subCategories', 'brands'));
    }
    public function sort(Request $request)
    {
        $query = Product::query();
        // Check if category filter is applied
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }
        // Fetch products with pagination
        $products = $query->paginate(12);
        // Fetch all categories to display in the sidebar
        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }
    // In ProductController.php
    public function categoryProducts($category_id)
    {
        $categories = Category::all();
        $category = Category::findOrFail($category_id); // Get the selected category
        $products = Product::where('category_id', $category_id)->paginate(12); // Get products for the category

        return view('front.shop', compact('products', 'categories', 'category'));
    }



}
