<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<button id="rzp-button">Pay with Razorpay</button>

<script>
     var APP_URL = '{{ URL::to('/') }}';
const options = {
    "key": "{{ $razorpay_key }}",
    "amount": "{{ $amount * 100 }}",
    "currency": "INR",
    "name": "{{ $user->name }}",
    "order_id": "{{ $order_id }}",
    "handler": function (response){
        // After payment success
        window.location.href = APP_URL+"/payment/success?payment_id=" + response.razorpay_payment_id;
    }
};
const rzp = new Razorpay(options);
document.getElementById('rzp-button').onclick = function(e){
    rzp.open();
    e.preventDefault();
}
</script>
