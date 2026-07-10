<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    // Lihat keranjang
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    // Tambah produk ke keranjang
    public function add(Request $request)
    {
        $productId = $request->product_id;
        $variantName = $request->variant_name;
        $price = $request->price;

        $cart = session()->get('cart', []);

        $key = $productId . '_' . $variantName;

        if (isset($cart[$key])) {
            $cart[$key]['quantity']++;
        } else {
            $cart[$key] = [
                'product_id' => $productId,
                'variant_name' => $variantName,
                'price' => $price,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang!');
    }

    // Hapus item dari keranjang
    public function remove(string $key)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$key])) {
            unset($cart[$key]);
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.index')->with('success', 'Item dihapus!');
    }
}