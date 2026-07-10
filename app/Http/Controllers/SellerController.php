<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SellerController extends Controller
{
    public function dashboard()
{
{
    $user = Auth::user();
    if (!$user) {
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
    }

    $products = Product::where('seller_id', $user->id)->with('variants')->get();
    return view('seller.dashboard', compact('products'));
}
}

    public function create()
    {
        return view('seller.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'variant_name' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category,
            'seller_id' => $user->id,
            'image' => $imagePath,
        ]);

        ProductVariant::create([
            'product_id' => $product->id,
            'variant_name' => $request->variant_name ?? 'Default',
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        return redirect()->route('seller.dashboard')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $product = Product::where('seller_id', $user->id)->findOrFail($id);
        return view('seller.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $product = Product::where('seller_id', $user->id)->findOrFail($id);

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category,
            'image' => $imagePath,
        ]);

        if ($product->variants->isNotEmpty()) {
            $variant = $product->variants->first();
            $variant->update([
                'variant_name' => $request->variant_name ?? 'Default',
                'price' => $request->price,
                'stock' => $request->stock,
            ]);
        }

        return redirect()->route('seller.dashboard')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $product = Product::where('seller_id', $user->id)->findOrFail($id);
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('seller.dashboard')->with('success', 'Produk berhasil dihapus!');
    }

    public function uploadQRIS(Request $request)
{
    $request->validate([
        'qris_image' => 'required|image|mimes:jpg,png,jpeg|max:2048'
    ]);


    /** @var User $user */
    $user = Auth::user();
    $file = $request->file('qris_image');
    $filename = time() . '.' . $file->getClientOriginalExtension();
    $file->storeAs('public/qris', $filename);

    $user->qris_image = $filename;
    $user->save();

    return redirect()->back()->with('success', 'QRIS berhasil diupload!');
}

public function orders()
{
    $orders = Order::where('seller_id', auth()->id())
                    ->with(['buyer', 'items'])
                    ->orderBy('created_at', 'desc')
                    ->get();

    return view('seller.orders', compact('orders'));
}

}