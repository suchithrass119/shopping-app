<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping App</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
    body {
        background-color: #f1f3f6;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    header {
        background-color: #2874f0;
        color: #fff;
        padding: 1rem;
    }

    .success-message {
        background-color: #d1e7dd;
        color: #0f5132;
        border: 1px solid #badbcc;
        padding: 1rem;
        border-radius: 8px;
        margin: 1rem auto;
        max-width: 900px;
    }

    .product-card {
        background-color: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .product-card:hover {
        transform: translateY(-5px);
    }

    .product-image {
        height: 220px;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
        background-color: #fafafa;
    }

    .product-details {
        padding: 1rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .product-details h2 {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .product-details p {
        font-size: 0.95rem;
        color: #555;
        margin-bottom: 0.25rem;
    }

    .price {
        font-weight: bold;
        color: #388e3c;
    }

    .btn-add-to-cart {
        background-color: #ff9f00;
        color: white;
        padding: 0.5rem;
        text-align: center;
        border-radius: 5px;
        margin-top: auto;
        text-decoration: none;
    }

    .btn-add-to-cart:hover {
        background-color: #fb8c00;
    }

    @media (max-width: 576px) {
        header {
            text-align: center;
        }

        .product-details h2,
        .product-details p,
        .price {
            font-size: 1rem;
        }

        .btn-add-to-cart {
            font-size: 0.9rem;
            padding: 0.45rem 0.75rem;
        }
    }

    #successAlert {
        animation: slideDownFade 0.5s ease-out;
    }

    @keyframes slideDownFade {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 576px) {
        header h1 {
            font-size: 1.2rem;
        }

        header img {
            height: 32px;
        }

        .btn-sm {
            padding: 0.25rem 0.6rem;
            font-size: 0.875rem;
        }
    }

    .product-details .badge {
        font-size: 0.8rem;
        padding: 0.35em 0.6em;
        background-color: #388e3c;
    }

    .price {
        font-size: 1.1rem;
        color: #212121;
    }

    .price .text-danger {
        font-size: 0.95rem;
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
            <a href="{{ url('/cart') }}" class="btn btn-light btn-sm">
                🛒 View Cart
            </a>
        </div>
    </header>

    @if(session('success'))
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1055;">
        <div id="successToast" class="toast align-items-center text-bg-success border-0 show" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    ✅ {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
    @endif


    <div class="container mt-4">
        <div class="row g-4">
            @foreach ($products as $product)
            <div class="col-12 col-sm-6 col-md-4">
                <div class="product-card h-100">
                    <div class="product-image"
                        style="background-image: url('{{ asset('storage/' . $product->image) }}');"></div>
                    <div class="product-details">
                        <h2>{{ $product->name }}</h2>
                        <div class="d-flex align-items-center mb-1">
                            <span class="badge bg-success me-2">
                                ★ 4.3
                            </span>
                            <small class="text-muted">(1,234 ratings)</small>
                        </div>
                        <p class="text-truncate">{{ $product->description }}</p>

                        <p class="price mt-auto mb-2">
                            ₹{{ number_format($product->price, 2) }}
                            <span
                                class="text-muted text-decoration-line-through ms-2">₹{{ number_format($product->price + 300, 2) }}</span>
                            <span class="text-danger fw-semibold ms-2">25% off</span>
                        </p>

                        <a href="{{ url('/add-to-cart/' . $product->id) }}" class="btn-add-to-cart">Add to Cart</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</body>

</html>




<script>
// Bootstrap Toast auto-dismiss
document.addEventListener('DOMContentLoaded', function() {
    const toastElement = document.getElementById('successToast');
    if (toastElement) {
        const toast = new bootstrap.Toast(toastElement, {
            delay: 3000
        });
        toast.show();
    }
});
</script>