<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Method to fetch and display user's orders
    public function myOrders()
    {
        // Get the orders associated with the authenticated user
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $brands = Brand::all();
        $orders = Order::where('user_id', Auth::id())->get(); // Assuming the 'user_id' column exists in 'orders' table
        
        
        return view('front.orders.myorder', compact('orders', 'categories', 'subCategories', 'brands'));
    }
    public function viewOrder(Order $order)
{
    $categories = Category::all();
    $subCategories = SubCategory::all();
    // Ensure the order belongs to the authenticated user
    if ($order->user_id != Auth::id()) {
        abort(403, 'Unauthorized action.');
    }

    // Fetch the order details (you might need to adjust this depending on your DB structure)
    $orderItems = $order->items; // Assuming an 'items' relationship on the Order model

    return view('front.orders.view', compact('order', 'orderItems','categories','subCategories'));
}

}

