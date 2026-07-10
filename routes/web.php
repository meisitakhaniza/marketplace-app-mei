<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\StoreController; 
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', [HomeController::class, 'index']);

// ==================== ROUTE KERANJANG ====================
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{key}', [CartController::class, 'remove'])->name('cart.remove');

// ==================== ROUTE CHECKOUT ====================
Route::middleware(['auth'])->get('/checkout', function () {
    $cart = session()->get('cart', []);

    if (empty($cart)) {
        return redirect('/')->with('error', 'Keranjang kosong!');
    }

    $productId = array_keys($cart)[0];
    $product = App\Models\Product::find($productId);
    $sellerId = $product->seller_id;

    $order = App\Models\Order::create([
        'buyer_id' => auth()->id(),
        'seller_id' => $sellerId,
        'total' => array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)),
        'status' => 'pending'
    ]);

    foreach ($cart as $item) {
        App\Models\OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $item['product_id'],
            'variant_name' => $item['variant_name'],
            'quantity' => $item['quantity'],
            'price' => $item['price'],
        ]);
    }

    $sellerQris = App\Models\User::find($sellerId)->qris_image ?? null;

    session()->forget('cart');

    return view('checkout', compact('order', 'sellerQris'));
})->name('checkout');

// ==================== ROUTE RIWAYAT PESANAN (Customer) ====================
Route::middleware(['auth'])->get('/my-orders', [HomeController::class, 'myOrders'])->name('my.orders');

// ==================== ROUTE SWITCH ROLE ====================
Route::middleware(['auth'])->post('/switch-role', [ProfileController::class, 'switchRole'])->name('switch.role');

// ==================== ROUTE TOKO SELLER (Public) ====================
Route::get('/store/{id}', [StoreController::class, 'index'])->name('store.index');

// ==================== ROUTE CHAT ====================
Route::middleware(['auth'])->group(function () {
    Route::get('/chat/{orderId}', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/{orderId}', [ChatController::class, 'store'])->name('chat.store');
});

// ==================== ROUTE TRIGGER ORDER (SIMULASI PESANAN BARU) ====================
Route::post('/trigger-order', function (Request $request) {
    session()->put('new_order', true);
    return redirect()->back()->with('success', 'Pesanan baru berhasil disimulasikan!');
})->name('trigger.order');

// ==================== ROUTE DASHBOARD BAWAAN ====================
Route::get('/dashboard', function () {
    if (auth()->check() && auth()->user()->role === 'seller') {
        return redirect('/seller/dashboard');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ==================== ROUTE PROFILE ====================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// ==================== ROUTE SELLER ====================
Route::middleware(['auth'])->prefix('seller')->group(function () {
    Route::get('/dashboard', [SellerController::class, 'dashboard'])->name('seller.dashboard');
    Route::get('/create', [SellerController::class, 'create'])->name('seller.create');
    Route::post('/store', [SellerController::class, 'store'])->name('seller.store');
    Route::get('/edit/{id}', [SellerController::class, 'edit'])->name('seller.edit');
    Route::put('/update/{id}', [SellerController::class, 'update'])->name('seller.update');
    Route::delete('/destroy/{id}', [SellerController::class, 'destroy'])->name('seller.destroy');
    Route::post('/seller/qris', [SellerController::class, 'uploadQRIS'])->name('seller.upload.qris');
    Route::get('/orders', [SellerController::class, 'orders'])->name('seller.orders');
});