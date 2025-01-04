@extends('front.layouts.header')

@section('content')
<style>
    /* Style untuk tampilan yang lebih meriah */
body {
    background-color: #f7f7f7;
    font-family: 'Arial', sans-serif;
}

.section-checkout {
    padding-top: 50px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    margin: 0 auto;
    max-width: 600px;
}

.celebration-icon {
    width: 80px;
    margin-bottom: 20px;
}

.payment-title {
    color: #28a745;
    font-size: 2.5rem;
    margin-bottom: 15px;
    font-weight: bold;
}

.total-payment {
    font-size: 1.25rem;
    margin-bottom: 25px;
    font-weight: 600;
    color: #ff5722;
}

.btn-payment {
    background-color: #ff9800;
    color: white;
    font-size: 1.2rem;
    padding: 15px 30px;
    border: none;
    border-radius: 5px;
    width: 80%;
    transition: background-color 0.3s ease, transform 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.btn-payment:hover {
    background-color: #f57c00;
    transform: translateY(-3px);
}

.payment-secure {
    font-size: 1rem;
    color: #757575;
    margin-bottom: 10px;
}

.payment-methods {
    width: 250px;
    margin-top: 10px;
    border-radius: 5px;
}

@media (max-width: 768px) {
    .section-checkout {
        padding: 20px;
    }

    .btn-payment {
        width: 100%;
    }

    .payment-methods {
        width: 200px;
    }
}

</style>
<main>
    <section class="section-checkout pt-4">
        <div class="container">
            <div class="text-center mb-4">
                <img src="{{asset ('front-assets/images/download.jpg')}}" alt="Celebration Icon" class="img-fluid celebration-icon">
            </div>
            <h2 class="payment-title">🎉 Payment Time! 🎉</h2>
            <p class="total-payment">Total Payment: <strong>Rp{{ number_format($total, 0) }}</strong></p>

            <div class="text-center">
                <button id="pay-button" class="btn-payment">Proceed to Payment</button>
            </div>

            <div class="text-center mt-4">
                <p class="payment-secure">Secure Payment Gateway</p>
            </div>
        </div>
    </section>
</main>


<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    document.getElementById('pay-button').addEventListener('click', function () {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                alert('Payment successful!');
                console.log(result);
                window.location.href = '/my-orders';
            },
            onPending: function(result) {
                alert('Payment pending!');
                console.log(result);
                window.location.href = '/checkout';
            },
            onError: function(result) {
                alert('Payment failed!');
                console.log(result);
                window.location.href = '/checkout';
            },
        });
    });
</script>
@endsection
