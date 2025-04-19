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
        <div class="order-card">
            <div class="card-header">
                Order #{{ $order->id }} - Details
            </div>
            <div class="card-body">
                <p><strong>Status:</strong> 
                    <span class="order-status badge bg-{{ $order->status == 'completed' ? 'success' : 'warning' }}">
                        {{ $order->status }}
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

                
            </div>
        </div>
    </div>

</body>

</html>