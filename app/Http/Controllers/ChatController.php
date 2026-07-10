<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index($orderId)
    {
        $order = Order::with(['buyer', 'seller'])->findOrFail($orderId);
        $chats = Chat::where('order_id', $orderId)->with(['sender', 'receiver'])->get();

        return view('chat', compact('order', 'chats'));
    }

    public function store(Request $request, $orderId)
    {
        $request->validate([
            'message' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $order = Order::findOrFail($orderId);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('chat_images', 'public');
        }

        // Tentukan receiver (lawan bicara)
        $receiverId = Auth::id() == $order->seller_id ? $order->buyer_id : $order->seller_id;

        Chat::create([
            'order_id' => $orderId,
            'sender_id' => Auth::id(),
            'receiver_id' => $receiverId,
            'message' => $request->message,
            'image' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Pesan terkirim!');
    }
}