@include('public_layout.header')
        <div>
            <a href="{{ url('/') }}" class="btn btn-light btn-sm">
                🏠 Home
            </a>
        </div>
    </header>
       

    <div class="container">
        <div class="order-card">
            <div class="card-header">
                Order #{{ $order->id }} - Details
            </div>
            <div class="card-body">
                <p><strong>Status:</strong>
                    <span class="order-status badge badge-completed">
                        {{ $order->status == 'completed' ? 'Completed' : 'Pending' }}
                    </span>
                </p>
                <p><strong>Total:</strong> ₹{{ number_format($order->total, 2) }}</p>

                <h5 class="mt-4">Order Items</h5>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $item)
                                <tr>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>₹{{ number_format($item->price, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ url('/') }}" class="btn btn-view">Back to Home</a>
                </div>
            </div>
        </div>
    </div>

    
    @include('public_layout.footer')

