    @include('public_layout.header')
        <div>
            <a href="{{ url('/cart') }}" class="btn btn-light btn-sm">← Back to Cart</a>
        </div>
    </header>
    <div class="container-fluid px-2 px-sm-4">
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
    </div>
    @include('public_layout.footer')
