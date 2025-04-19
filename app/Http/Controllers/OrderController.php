<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Show a specific order
    public function show(Order $order)
    {
        // Optionally, you can check if the logged-in user is the owner of the order.
        if (auth()->user()->id !== $order->user_id) {
            abort(403, 'Unauthorized action.');
        }

        // Return a view to display the order details
        return view('orders.show', compact('order'));
    }
}

