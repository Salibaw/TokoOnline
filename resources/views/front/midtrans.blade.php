@extends('front.layouts.header')


@section('content')
<main>
    <section class="section-checkout pt-4">
        <div class="container">
            <h2>Payment</h2>
            <p>Total Payment: <strong>Rp{{ number_format($total, 0) }}</strong></p>
            <button id="pay-button" class="btn btn-primary btn-block w-100 mt-2">Proceed to Payment</button>
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
            },
            onError: function(result) {
                alert('Payment failed!');
                console.log(result);
            },
        });
    });
</script>
@endsection
