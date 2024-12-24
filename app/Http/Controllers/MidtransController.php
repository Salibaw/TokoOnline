<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;
use Illuminate\Support\Facades\Log;

class MidtransController extends Controller
{
    public function __construct()
    {
        // Set your Midtrans credentials
        Config::$serverKey = 'SB-Mid-server-TzQym617_qWodH0hxqYiNt5r';
        Config::$clientKey = 'Mid-client-LONJiWaPOVq7Qo8G';
        Config::$isProduction = false; // Set to true for production environment
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }


    public function createTransaction(Request $request)
    {
        $grandTotal = $request->input('grandTotal');
        $orderId = 'ORDER' . time(); // Unique order ID

        // Transaction details
        $transactionDetails = [
            'order_id' => $orderId,
            'gross_amount' => $grandTotal,
        ];

        // Customer details
        $customerDetails = [
            'first_name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'shipping_address' => $request->input('address'),
        ];

        // Prepare the transaction
        $transaction = [
            'transaction_details' => $transactionDetails,
            'customer_details' => $customerDetails,
        ];

        try {
            // Create Snap token
            $snapToken = Snap::getSnapToken($transaction);
            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Midtrans error: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong. Please try again later.']);
        }
    }

}
