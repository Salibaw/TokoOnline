<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class MidtransController extends Controller
{
    public function process(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'address' => 'required|string|max:500',
        'phone' => 'required|string|max:20',
    ]);

    $cartItems = session()->get('cart', []);
    $user_id = Auth::id();

    if (empty($cartItems)) {
        Log::warning('Cart is empty during checkout.');
        return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
    }

    $grandTotal = array_sum(array_map(function ($item) {
        return $item['price'] * $item['quantity'];
    }, $cartItems));

    try {
        $order = Order::create([
            'user_id' => $user_id,
            'customer_name' => $request->name,
            'customer_email' => $request->email,
            'customer_phone' => $request->phone,
            'customer_address' => $request->address,
            'grand_total' => $grandTotal,
            'status' => 'Pending',
        ]);

        Log::info('Order created successfully:', $order->toArray());

        foreach ($cartItems as $item) {
            // Simpan item order ke tabel order_items
            $orderItem = $order->items()->create([
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);

            Log::info('Order item created:', $orderItem->toArray());

            // Kurangi stok produk
            $product = Product::find($item['id']); // Temukan produk berdasarkan ID
            if ($product) {
                if ($product->qty >= $item['quantity']) {
                    $product->qty -= $item['quantity'];
                    $product->save();

                    Log::info('Stock updated for product ID ' . $item['id'], [
                        'new_stock' => $product->qty,
                    ]);
                } else {
                    Log::warning('Insufficient stock for product ID ' . $item['id']);
                    return back()->with('error', 'Insufficient stock for some items.');
                }
            } else {
                Log::error('Product not found for product ID ' . $item['id']);
            }
        }

        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $transactionDetails = [
            'order_id' => 'ORDER-' . $order->id,
            'gross_amount' => $grandTotal,
        ];

        $customerDetails = [
            'first_name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];

        $transaction = [
            'transaction_details' => $transactionDetails,
            'customer_details' => $customerDetails,
        ];

        $snapToken = Snap::getSnapToken($transaction);

        // Hapus keranjang setelah berhasil
        session()->forget('cart');

        return view('front.midtrans', [
            'snapToken' => $snapToken,
            'total' => $grandTotal,
            'customerDetails' => $customerDetails,
            'categories' => Category::all(),
            'subCategories' => SubCategory::all(),
            'brands' => Brand::all(),
        ]);
    } catch (\Exception $e) {
        Log::error('Order creation failed:', ['error' => $e->getMessage()]);
        return back()->with('error', 'Failed to create order. Please try again.');
    }
}

}
