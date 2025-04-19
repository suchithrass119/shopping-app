<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Shopping App</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f1f3f6;
            font-family: 'Segoe UI', sans-serif;
        }

        header {
            background-color: #2874f0;
            color: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .checkout-wrapper {
            max-width: 900px;
            margin: 2rem auto;
        }

        .checkout-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
            padding: 2rem;
        }

        .product-list-item {
            padding: 1rem 0;
            border-bottom: 1px solid #eee;
        }

        .product-list-item:last-child {
            border-bottom: none;
        }

        .product-img {
            height: 60px;
            width: 60px;
            object-fit: contain;
            border: 1px solid #ddd;
            border-radius: 6px;
            margin-right: 1rem;
        }

        .product-info {
            flex-grow: 1;
        }

        .product-name {
            font-weight: 600;
        }

        .price-tag {
            font-weight: bold;
            color: #388e3c;
        }

        .proceed-btn {
            background-color: #fb641b;
            color: #fff;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            transition: background-color 0.3s ease;
            border: none;
        }

        .proceed-btn:hover {
            background-color: #f75d13;
        }

        .total-bar {
            font-size: 1.2rem;
            font-weight: bold;
            color: #2e7d32;
        }

        .empty-cart {
            text-align: center;
            padding: 4rem 2rem;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
        }

        .empty-cart h5 {
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>

    <header class="d-flex justify-content-between align-items-center flex-wrap">
        <h4 class="m-0">🛍️ Shopping App</h4>
        <a href="{{ url('/cart') }}" class="btn btn-light btn-sm">← Back to Cart</a>
    </header>

    <div class="checkout-wrapper">
        @if(count($cartItems) > 0)
            <div class="checkout-card">
                <h3 class="mb-4">🧾 Order Summary</h3>
                <ul class="list-unstyled">
                    @foreach($cartItems as $item)
                        <li class="product-list-item d-flex align-items-center">
                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}"
                                 class="product-img">
                            <div class="product-info">
                                <div class="product-name">{{ $item->product->name }}</div>
                                <small class="text-muted">₹{{ $item->product->price }} × {{ $item->quantity }}</small>
                            </div>
                            <div class="ms-auto price-tag">
                                ₹{{ number_format($item->product->price * $item->quantity, 2) }}
                            </div>
                        </li>
                    @endforeach
                </ul>

                <hr class="my-4">

                <div class="d-flex justify-content-between align-items-center mb-4 total-bar">
                    <span>Total Amount</span>
                    <span>
                        ₹{{ number_format($cartItems->sum(fn($item) => $item->product->price * $item->quantity), 2) }}
                    </span>
                </div>

                <div class="text-end">
                    <a href="{{ route('cart.createPayment') }}" class="proceed-btn">
                        Proceed to Payment →
                    </a>
                </div>
            </div>
        @else
            <div class="empty-cart">
                <h5>Your cart is empty 🛒</h5>
                <a href="{{ url('/') }}" class="btn btn-primary">🛍️ Start Shopping</a>
            </div>
        @endif
    </div>

</body>

</html>
