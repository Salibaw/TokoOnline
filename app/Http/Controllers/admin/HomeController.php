<?php

namespace App\Http\Controllers\admin;

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
}
