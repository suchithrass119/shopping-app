<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details - Shopping App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8f9fa;
        }

        header {
            background-color: #2874f0;
            color: white;
            padding: 1.5rem 2rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            font-size: 1.75rem;
            font-weight: 600;
        }

        .order-card {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            margin-top: 30px;
            background-color: #ffffff;
        }

        .order-card .card-header {
            background-color: #2874f0;
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        .order-card .card-body {
            padding: 2rem;
        }

        .order-status {
            padding: 0.4rem 0.8rem;
            font-weight: bold;
        }

        .btn-view {
            background-color: #fb641b;
            color: white;
            font-weight: 600;
            border-radius: 5px;
            padding: 0.75rem 2rem;
            text-transform: uppercase;
        }

        .btn-view:hover {
            background-color: #fbbc4f;
            color: white;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .badge-completed {
            background-color: #28a745;
        }

        .badge-pending {
            background-color: #ffc107;
        }

        @media (max-width: 768px) {
            .order-card .card-body {
                padding: 1rem;
            }

            .btn-view {
                width: 100%;
                padding: 0.5rem 1.5rem;
            }
        }
    </style>
</head>

<body>

    <header class="bg-primary text-white py-3 px-4 d-flex justify-content-between align-items-center flex-wrap shadow-sm">
        <div class="d-flex align-items-center mb-2 mb-md-0">
            <h1 class="h5 m-0"> 🛍️ Shopping App</h1>
        </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
