<?php

namespace App\Http\Controllers;

use App\Category;
use App\Orders;
use Auth;

class OrdersController extends Controller
{
    function index() {
        $orders = Orders::all();
        $admin = (Auth::user())->admin;
        if($admin){
            return view('orders.orders', ['orders' => $orders, 'admin' => $admin]);
        } else {
            redirect('categories');
        }
    }
}
