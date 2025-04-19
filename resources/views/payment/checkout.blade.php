<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Razorpay Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f1f3f6;
            padding-top: 50px;
        }

        .payment-section {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
            padding: 2rem;
            max-width: 700px;
            margin: 2rem auto;
        }

        .payment-section h3 {
            text-align: center;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .btn-razorpay {
            background-color: #2E7D32;
            color: #fff;
            font-weight: 600;
            padding: 1rem 2rem;
            border-radius: 8px;
            width: 100%;
            border: none;
            font-size: 1.1rem;
            transition: background-color 0.3s ease;
        }

        .btn-razorpay:hover {
            background-color: #388e3c;
        }

        .btn-razorpay:active {
            background-color: #2c6e29;
        }

        .btn-razorpay:focus {
            outline: none;
        }

        .btn-cancel {
            background-color: #f44336;
            color: #fff;
            font-weight: 600;
            padding: 1rem 2rem;
            border-radius: 8px;
            width: 100%;
            border: none;
            font-size: 1.1rem;
            transition: background-color 0.3s ease;
            margin-top: 1rem;
        }

        .btn-cancel:hover {
            background-color: #e53935;
        }

        .btn-cancel:active {
            background-color: #c62828;
        }

        .btn-cancel:focus {
            outline: none;
        }

        /* Flexbox layout for the two buttons */
        .button-group {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
        }

        .button-group .btn {
            flex: 1;
        }

        @media (max-width: 576px) {
            .payment-section {
                padding: 1rem;
                margin: 1rem;
            }

            .btn-razorpay,
            .btn-cancel {
                font-size: 1rem;
            }

            /* Stack buttons on mobile */
            .button-group {
                flex-direction: column;
            }

            .button-group .btn {
                margin-bottom: 1rem;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="payment-section">
            <h3>Secure Checkout</h3>

            <p class="text-center text-muted mb-4">Click below to proceed with the payment using Razorpay.</p>

            <div class="button-group">
                <button id="rzp-button" class="btn-razorpay">
                    Pay ₹{{ number_format($amount, 2) }} with Razorpay
                </button>

                <!-- Cancel Button -->
                <a href="{{ url('/cart') }}" class="btn-cancel">
                    Cancel and Go Back
                </a>
            </div>
        </div>
    </div>

    <script>
        var APP_URL = '{{ URL::to('/') }}';
        const options = {
            "key": "{{ $razorpay_key }}", // Your Razorpay Key
            "amount": "{{ $amount * 100 }}", // Payment Amount in Paise
            "currency": "INR",
            "name": "{{ $user->name }}",
            "order_id": "{{ $order_id }}",
            "handler": function (response) {
                // After payment success
                window.location.href = APP_URL + "/payment/success?payment_id=" + response.razorpay_payment_id;
            }
        };
        const rzp = new Razorpay(options);
        document.getElementById('rzp-button').onclick = function (e) {
            rzp.open();
            e.preventDefault();
        }
    </script>

</body>

</html>
