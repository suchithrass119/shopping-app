<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

use Razorpay\Api\Api;
use Illuminate\Support\Facades\Session;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;

class CartController extends Controller
{
    
    public function add(Product $product)
    {
        // dd($product->id);
        $item = auth()->user()->cartItems()->firstOrCreate(
            ['product_id' => $product->id],   
            ['quantity' => 0]
        );
        $item->increment('quantity');
        return back()->with('success', 'Added to cart!');
    }

    public function view()
    {
        $cartItems = auth()->user()->cartItems()->with('product')->get();
        return view('cart', compact('cartItems'));
    }

    public function remove(CartItem $item)
    {
        $item->delete();
        return back()->with('success', 'Removed from cart!');
    }

    public function checkout()
    {
        $cartItems = auth()->user()->cartItems()->with('product')->get();
        return view('checkout.index', compact('cartItems'));
    }

    public function createPayment(Request $request)
    {
        $user = auth()->user();
        $cartItems = $user->cartItems()->with('product')->get();
        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        $razorpayOrder = $api->order->create([
            'receipt' => 'rcptid_' . rand(1000, 9999),
            'amount' => $total * 100,
            'currency' => 'INR'
        ]);

        Session::put('razorpay_order_id', $razorpayOrder['id']);
        Session::put('order_amount', $total);

        return view('payment.checkout', [
            'order_id' => $razorpayOrder['id'],
            'amount' => $total,
            'razorpay_key' => config('services.razorpay.key'),
            'user' => $user
        ]);
    }

    public function paymentSuccess(Request $request)
    {
        $user = auth()->user();
        $cartItems = $user->cartItems()->with('product')->get();
        $total = session('order_amount');

        $order = $user->orders()->create([
            'total' => $total,
            'status' => 'paid'
        ]);

        foreach ($cartItems as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        $user->cartItems()->delete();
        Session::forget(['razorpay_order_id', 'order_amount']);

        return redirect()->route('orders.show', $order)->with('success', 'Payment successful. Order placed!');
    }

}