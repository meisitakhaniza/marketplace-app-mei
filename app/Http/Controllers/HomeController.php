<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('variants')->get();
        return view('home', compact('products'));

    }

    public function myOrders()
{
    $orders = Order::where('buyer_id', auth()->id())
                    ->with(['seller', 'items'])
                    ->orderBy('created_at', 'desc')
                    ->get();

    return view('my-orders', compact('orders'));
}
}