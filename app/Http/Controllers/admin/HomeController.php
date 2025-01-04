<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    //    $admin = Auth::guard('admin') ->user();
        
    //     echo 'Welcome '.$admin->name.'<a href="'.route('admin.logout').'"> Logout</a>';
    }

    public function dashboardData()
    {
        $totalOrders = DB::table('orders')->count();
        $totalCustomers = DB::table('orders')->distinct('user_id')->count('user_id');
        $totalSales = DB::table('orders')->sum('grand_total');
    
        $processedOrders = DB::table('orders')->where('status', 'process')->count();
        $pendingOrders = DB::table('orders')->where('status', 'pending')->count();
    
        $newCustomers = DB::table('users')
            ->where('created_at', '>=', now()->subMonth())
            ->count();
    
    
        return view('admin.dashboard', [
            'totalOrders' => $totalOrders,
            'totalCustomers' => $totalCustomers,
            'totalSales' => $totalSales,
            'processedOrders' => $processedOrders,
            'pendingOrders' => $pendingOrders,
            'newCustomers' => $newCustomers,
        ]);
    }
    

}
