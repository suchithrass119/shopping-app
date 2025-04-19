<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .cart-container {
            max-width: 1200px;
            margin: 4rem auto;
        }

        .cart-item {
            background: #fff;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 1.5rem;
            transition: transform 0.2s ease, box-shadow 0.3s ease;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cart-item:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }

        .cart-item .product-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #ddd;
            transition: transform 0.3s ease;
        }

        .cart-item .product-image:hover {
            transform: scale(1.05);
            border-color: #007bff;
        }

        .cart-item .product-details {
            flex: 1;
            padding-right: 2rem;
            padding-left: 1rem;
        }

        .cart-item h3 {
            font-size: 1.2rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 0.8rem;
        }

        .cart-item p {
            color: #555;
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }

        .cart-item .remove-btn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            font-size: 0.9rem;
            transition: background-color 0.3s ease;
        }

        .cart-item .remove-btn:hover {
            background-color: #d32f2f;
        }

        .checkout-btn {
            display: block;
            margin: 3rem auto;
            max-width: 350px;
            background-color: #ffb400;
            color: white;
            font-size: 1.2rem;
            font-weight: 600;
            padding: 1rem;
            border-radius: 8px;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .checkout-btn:hover {
            background-color: #e68900;
        }

        .empty-cart {
            text-align: center;
            margin-top: 3rem;
        }

        .empty-cart p {
            font-size: 1.4rem;
            color: #888;
        }

        .empty-cart .btn-primary {
            font-size: 1.1rem;
            padding: 0.75rem 1.5rem;
        }

        header {
            background-color: #007bff;
            color: white;
            padding: 1.2rem 2rem;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        header h1 {
            font-size: 1.8rem;
            font-weight: 700;
            letter-spacing: 1px;
        }

        header .cart-icon {
            font-size: 1.5rem;
        }

        @media (max-width: 768px) {
            .cart-item h3 {
                font-size: 1rem;
            }

            .checkout-btn {
                font-size: 1rem;
                padding: 0.9rem;
            }

            .remove-btn {
                font-size: 0.8rem;
                padding: 0.5rem 1rem;
            }

            header {
                text-align: center;
            }

            header .cart-icon {
                font-size: 1.2rem;
            }
        }

        @media (max-width: 576px) {
            .cart-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .cart-item .remove-btn {
                width: 100%;
                text-align: center;
                padding: 0.8rem;
            }

            .checkout-btn {
                font-size: 1rem;
                padding: 0.8rem;
            }

            .cart-item .product-details {
                padding-right: 0;
            }

            .cart-item .product-image {
                margin-bottom: 1rem;
                width: 120px;
                height: 120px;
            }
        }
    </style>
</head>
<body>

    <header class="bg-primary text-white py-3 px-4 d-flex justify-content-between align-items-center flex-wrap shadow-sm">
        <div class="d-flex align-items-center mb-2 mb-md-0">
            <!-- <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 40px;" class="me-2"> -->
            <h1 class="h5 m-0">🛍️ Shopping App</h1>
        </div>
        <div>
            <a href="{{ url('/cart') }}" class="btn btn-light btn-sm">
                🛒 View Cart
            </a>
        </div>
    </header>

    <div class="container cart-container">

        <h2 class="text-center mb-4">Your Cart</h2>

        @if(session('success'))
            <div class="alert alert-success text-center" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if($cartItems->isEmpty())
            <div class="empty-cart">
                <p>Your cart is empty. Add some products to your cart!</p>
                <a href="{{ url('/') }}" class="btn btn-primary">Continue Shopping</a>
            </div>
        @else
            @foreach($cartItems as $item)
                <div class="cart-item">
                    <div class="product-image">
                        <img src="{{ asset('storage/'.$item->product->image) }}" alt="Product Image" class="img-fluid">
                    </div>
                    <div class="product-details">
                        <h3>{{ $item->product->name }}</h3>
                        <p>Price: ₹{{ $item->product->price }}</p>
                        <p>Quantity: {{ $item->quantity }}</p>
                    </div>
                    <div>
                        <a href="{{ route('cart.remove', $item->id) }}" class="remove-btn">Remove</a>
                    </div>
                </div>
            @endforeach

            <a href="{{ route('cart.checkout') }}" class="checkout-btn">
                Proceed to Checkout
            </a>
        @endif
    </div>

</body>
</html>
