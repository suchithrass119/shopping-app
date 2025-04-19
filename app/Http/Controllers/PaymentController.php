<?php

namespace App\Http\Controllers;
use Razorpay\Api\Api;
use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Order;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function create(Request $request)
    {
        $user = auth()->user();
        $cartItems = $user->cartItems()->with('product')->get();
        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        $razorpayOrder = $api->order->create([
            'receipt' => 'rcptid_' . rand(1000, 9999),
            'amount' => $total * 100, // INR paise
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

    public function success(Request $request)
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
