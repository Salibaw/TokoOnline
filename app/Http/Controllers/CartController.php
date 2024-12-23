<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 1)->with('subcategories')->get(); 
        $products = Product::with('images')->where('status', 1)->get();
        $cartItems = session()->get('cart', []);

        // Tambahkan data stok ke item dalam keranjang
        foreach ($cartItems as $productId => $item) {
            $product = Product::find($productId);
            if ($product) {
                $cartItems[$productId]['stock'] = $product->stock;
            } else {
                unset($cartItems[$productId]); // Hapus jika produk tidak ditemukan
            }
        }

        return view('front.cart', compact('cartItems', 'categories', 'products'));
    }

    public function add(Request $request)
{
    $productId = $request->input('product_id');
    $quantity = $request->input('quantity', 1);

    // Ambil produk berdasarkan ID
    $product = Product::with('images')->find($productId);

    if (!$product) {
        return redirect()->back()->with('error', 'Product not found.');
    }

    // Ambil keranjang dari session
    $cart = session()->get('cart', []);

    // Jika produk sudah ada di keranjang
    if (isset($cart[$productId])) {
        $cart[$productId]['quantity'] += $quantity;
    } else {
        // Tambahkan produk baru ke keranjang
        $cart[$productId] = [
            'id' => $product->id,
            'name' => $product->title,
            'price' => $product->price,
            'image' => $product->images->first()->image ?? 'placeholder.jpg',
            'quantity' => $quantity,
        ];
    }

    // Simpan kembali ke session
    session()->put('cart', $cart);

    return redirect()->route('cart.index')->with('success', 'Product added to cart.');
}

public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity; // Update quantity
            session()->put('cart', $cart); // Simpan kembali ke session
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Cart updated successfully!',
            'cart' => $cart
        ]);
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Product removed from cart.');
    }
}
