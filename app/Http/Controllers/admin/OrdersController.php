<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        // Ambil semua order dari database
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }
    public function show($id)
    {
        // Ambil order dengan items dan produk terkait
        $order = Order::findOrFail($id);
        $orderItems = $order->items()->with('product')->get();
    
        return view('admin.orders.show', compact('order', 'orderItems'));
    }
    
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,process,delivered,complete,cancel',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }

}
