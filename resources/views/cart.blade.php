@include('public_layout.header')
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
@include('public_layout.footer')
