<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Shopping App</title>
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
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    header h1 {
        font-size: 1.5rem;
    }

    .cart-container {
        max-width: 1200px;
        margin: 2rem auto;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .cart-header {
        border-bottom: 1px solid #ddd;
        padding: 1.5rem;
        font-weight: 600;
        font-size: 1.2rem;
    }

    /* .cart-item {
        display: flex;
        flex-wrap: wrap;
        padding: 1.5rem;
        border-bottom: 1px solid #eee;
        align-items: center;
    } */

    .cart-item {
        padding: 1.5rem 1rem;
        border-bottom: 1px solid #eee;
        background-color: #fff;
        border-radius: 5px;
        margin: 0;
        transition: all 0.2s ease;
    }

    /* .cart-item:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    } */

    .cart-item img {
        height: 120px;
        width: 120px;
        object-fit: contain;
        margin-right: 1.5rem;
    }


    .item-details {
        flex: 1;
    }

    .item-actions {
        text-align: right;
    }

    .item-details h5 {
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .item-details p {
        margin-bottom: 0.25rem;
        font-size: 0.95rem;
        color: #555;
    }

    .btn-remove {
        border: none;
        background: none;
        color: #d32f2f;
        font-weight: 600;
    }

    
    .checkout-section {
        text-align: right;
        padding: 1.5rem;
    }

    .checkout-btn {
        background-color: #fb641b;
        color: white;
        padding: 0.75rem 2rem;
        border-radius: 5px;
        border: none;
        font-weight: 600;
    }

 

   
    @media (max-width: 768px) {
        .cart-item .col-md-2,
        .cart-item .col-md-7,
        .cart-item .col-md-3 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .cart-item img {
            margin-bottom: 1rem;
            height: auto;
            width: 100px;
        }

        .cart-item .col-md-3 {
            text-align: left;
            margin-top: 1rem;
        }
        .cart-item .col-md-3 {
            text-align: right;
            margin-top: 1rem;
        }
    }

    .total-summary {
        background-color: #fff3e0;
        border-radius: 8px;
        margin: 0 1rem 1rem;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }


    </style>
</head>

<body>


    <header
        class="bg-primary text-white py-3 px-4 d-flex justify-content-between align-items-center flex-wrap shadow-sm">
        <div class="d-flex align-items-center mb-2 mb-md-0">
            <!-- <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 40px;" class="me-2"> -->

            <h1 class="h5 m-0"> 🛍️ Shopping App</h1>
        </div>
        <div>
            <a href="{{ url('/') }}" class="btn btn-light btn-sm">
                🏠 Home
            </a>
        </div>
    </header>
    <div class="container-fluid px-2 px-sm-4">
        <div class="cart-container">
            <div class="cart-header">My Cart</div>

            @if(session('success'))
            <div class="alert alert-success text-center m-3">{{ session('success') }}</div>
            @endif

            @if($cartItems->isEmpty())
            <div class="p-5 text-center">
                <h5>Your cart is empty!</h5>
                <a href="{{ url('/') }}" class="btn btn-primary mt-3">Shop Now</a>
            </div>
            @else
            @foreach($cartItems as $item)
            <div class="cart-item row g-4">
                <div class="col-md-2 col-4 text-center">
                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}"
                        class="img-fluid">
                </div>
                <div class="col-md-7 col-8">
                    <h5>{{ $item->product->name }}</h5>
                    <p class="text-muted small mb-1">{{ Str::limit($item->product->description, 80) }}</p>
                    <p class="mb-1">
                        <strong>Price:</strong> ₹{{ number_format($item->product->price, 2) }}
                    </p>
                    <p class="mb-1">
                        <strong>Quantity:</strong> {{ $item->quantity }}
                    </p>
                    <p class="text-success fw-semibold">
                        Total: ₹{{ number_format($item->product->price * $item->quantity, 2) }}
                    </p>
                </div>
                <div class="col-md-3 col-12 d-flex justify-content-md-end justify-content-end align-items-center">
                    <a href="{{ route('cart.remove', $item->id) }}" class="btn btn-outline-danger btn-sm ms-auto">Remove</a>
                </div>
            </div>
            @endforeach
            
            <div class="checkout-section">
                <div class="bg-white  px-4 py-3 mb-3">
                    <h6 class="fw-bold mb-3">Price Details</h6>
                    <div class="d-flex justify-content-between mb-1">
                        <span>Price ({{ $cartItems->count() }} items)</span>
                        <span>₹{{ number_format($cartItems->sum(fn($item) => $item->product->price * $item->quantity), 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <span>Delivery Charges</span>
                        <span class="text-success">Free</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold fs-5">
                        <span>Total Amount</span>
                        <span class="text-success">₹{{ number_format($cartItems->sum(fn($item) => $item->product->price * $item->quantity), 2) }}</span>
                    </div>
                </div>

                <a href="{{ route('cart.checkout') }}" class="checkout-btn">Proceed to Checkout →</a>
            </div>
            @endif
        </div>
    </div>

</body>

</html>