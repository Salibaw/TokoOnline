<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use Midtrans\Transaction;
use Illuminate\Support\Facades\Log;

class MidtransController extends Controller
{
    public function process(Request $request)
    {

        $categories = Category::all();
        $subCategories = SubCategory::all();
        $brands = Brand::all();
        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Data transaksi
        $transactionDetails = [
            'order_id' => 'ORDER-' . time(),
            'gross_amount' => $request->input('total'),
        ];

        $customerDetails = [
            'first_name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
        ];

        $transaction = [
            'transaction_details' => $transactionDetails,
            'customer_details' => $customerDetails,
        ];

        try {
            $snapToken = Snap::getSnapToken($transaction);

            // Kirim ke view
            return view('front.midtrans', [
                'snapToken' => $snapToken,
                'total' => $request->input('total'),
                'customerDetails' => $customerDetails,
                'categories' => $categories,
                'subCategories' => $subCategories,
                'brands' => $brands,
            ]);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

}
