<!DOCTYPE html>
<html>
<head>
    <title>Checkout - Shopping App</title>
</head>
<body>
    <h1>Checkout</h1>
    
    @if(count($cartItems) > 0)
        <ul>
            @foreach($cartItems as $item)
                <li>
                    {{ $item->product->name }} - ₹{{ $item->product->price }} x {{ $item->quantity }}
                </li>
            @endforeach
        </ul>

        <a href="{{ route('cart.createPayment') }}">Proceed to Payment</a>
    @else
        <p>Your cart is empty.</p>
    @endif
</body>
</html>
