<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // GET /api/products - Ambil semua produk
    public function index()
    {
        $products = Product::with(['variants', 'images'])->get();
        return response()->json($products);
    }

    // GET /api/products/{id} - Ambil 1 produk
    public function show($id)
    {
        $product = Product::with(['variants', 'images'])->find($id);
        if (!$product) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }
        return response()->json($product);
    }

    // POST /api/products - Tambah produk baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'category' => 'nullable|string',
            'seller_id' => 'required|exists:users,id',
            'variants' => 'required|array',
            'variants.*.variant_name' => 'required|string',
            'variants.*.price' => 'required|numeric',
            'variants.*.stock' => 'required|integer'
        ]);

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category,
            'seller_id' => $request->seller_id
        ]);

        foreach ($request->variants as $variant) {
            ProductVariant::create([
                'product_id' => $product->id,
                'variant_name' => $variant['variant_name'],
                'price' => $variant['price'],
                'stock' => $variant['stock']
            ]);
        }

        return response()->json($product->load('variants'), 201);
    }

    // PUT /api/products/{id} - Update produk
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }

        $product->update($request->only(['name', 'description', 'category']));
        return response()->json($product);
    }

    // DELETE /api/products/{id} - Hapus produk
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }
        $product->delete();
        return response()->json(['message' => 'Produk dihapus']);
    }
}