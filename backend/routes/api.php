<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/products', function () {
    return Product::all();
});

Route::get('/cart', function (Request $request) {
    $sessionId = $request->session()->getId();
    return CartItem::with('product')->where('session_id', $sessionId)->get();
});

Route::post('/cart', function (Request $request) {
    $sessionId = $request->session()->getId();

    $validated = $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'nullable|integer|min:1'
    ]);

    $item = CartItem::where('session_id', $sessionId)
        ->where('product_id', $validated['product_id'])
        ->first();

    if ($item) {
        $item->quantity += $validated['quantity'] ?? 1;
        $item->save();
    } else {
        CartItem::create([
            'session_id' => $sessionId,
            'product_id' => $validated['product_id'],
            'quantity' => $validated['quantity'] ?? 1
        ]);
    }

    return response()->json(['message' => 'Added to cart']);
});

Route::delete('/cart/{product}', function (Request $request, $productId) {
    $sessionId = $request->session()->getId();
    CartItem::where('session_id', $sessionId)
        ->where('product_id', $productId)
        ->delete();

    return response()->json(['message' => 'Removed from cart']);
});

Route::post('/order', function (Request $request) {
    $sessionId = $request->session()->getId();

    $cartItems = \App\Models\CartItem::with('product')->where('session_id', $sessionId)->get();

    if ($cartItems->isEmpty()) {
        return response()->json(['message' => 'Cart is empty'], 400);
    }

    $total = 0;
    foreach ($cartItems as $item) {
        $total += $item->product->price * $item->quantity;
    }

    $order = \App\Models\Order::create([
        'session_id' => $sessionId,
        'total_price' => $total,
        'status' => 'pending'
    ]);

    foreach ($cartItems as $item) {
        \App\Models\OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $item->product_id,
            'quantity' => $item->quantity,
            'price' => $item->product->price
        ]);
    }

    \App\Models\CartItem::where('session_id', $sessionId)->delete();

    return response()->json(['message' => 'Order placed', 'order_id' => $order->id]);
});
