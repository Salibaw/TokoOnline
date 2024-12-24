@extends('front.layouts.header')

@section('content')
<main>
    <section class="section-checkout pt-4">
        <div class="container">
            <h2>Checkout</h2>
            <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <h4>Billing Details</h4>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control"
                                value="{{ Auth::check() ? Auth::user()->name : old('name') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                value="{{ Auth::check() ? Auth::user()->email : old('email') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea id="address" name="address" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" id="phone" name="phone" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h4>Your Order</h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $grandTotal = 0; @endphp
                                @foreach ($cartItems as $item)
                                    <tr>
                                        <td>{{ $item['name'] }} (x{{ $item['quantity'] }})</td>
                                        <td>Rp{{ number_format($item['price'] * $item['quantity'], 0) }}</td>
                                    </tr>
                                    @php $grandTotal += $item['price'] * $item['quantity']; @endphp
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Total</th>
                                    <th>Rp{{ number_format($grandTotal, 0) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                        <button type="button" class="btn btn-primary btn-block w-100 mt-2" id="place-order">Place Order</button>
                        <a href="{{ url('/cart') }}" class="btn btn-secondary w-100 mt-2">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>

<script type="text/javascript">
    document.getElementById('place-order').addEventListener('click', function () {
        // Get the total amount from the form
        var grandTotal = {{ $grandTotal }};
        
        // Send AJAX request to create the transaction
        fetch("{{ route('midtrans.createTransaction') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
            },
            body: JSON.stringify({
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                address: document.getElementById('address').value,
                phone: document.getElementById('phone').value,
                grandTotal: grandTotal
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.snap_token) {
                // Redirect to Midtrans payment page
                window.location.href = `https://app.midtrans.com/snap/v1/transactions/${data.snap_token}`;
            } else {
                alert('Error creating transaction');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Something went wrong.');
        });
    });
</script>
@endsection
