<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = auth()->user()->cartItems()->with('product')->get();
        return view('checkout.index', compact('cartItems'));
    }

    public function placeOrder(Request $request)
    {
        $user = auth()->user();
        $cartItems = $user->cartItems()->with('product')->get();

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        $order = $user->orders()->create(['total' => $total]);

        foreach ($cartItems as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        $user->cartItems()->delete();

        return redirect()->route('orders.show', $order)->with('success', 'Order placed!');
    }

}
