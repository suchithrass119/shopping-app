<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
</head>
<body>
    <h1>Order #{{ $order->id }} - Details</h1>

    <p>Status: {{ $order->status }}</p>
    <p>Total: ₹{{ $order->total }}</p>
    
    <h3>Order Items</h3>
    <table border="1">
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
                    <td>₹{{ $item->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
