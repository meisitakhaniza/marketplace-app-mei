<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class StoreController extends Controller
{
  public function index($id)
{
    $seller = User::findOrFail($id);
    $products = Product::where('seller_id', $id)->with('variants')->get();

    return view('store', compact('seller', 'products'));
}
}
