<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        // Ambil semua order dari database
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $brands = Brand::all();
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.orders.index', compact('orders','categories','subCategories', 'brands'));
    }
    public function show($id)
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $order = Order::findOrFail($id);
        $orderItems = $order->items()->with('product')->get();
    
        return view('admin.orders.show', compact('order', 'orderItems','categories','subCategories'));
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
