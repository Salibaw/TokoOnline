@extends('front.layouts.header')

@section('content')
<main>
    <section class="section-order-detail pt-4">
        <div class="container">
            <h2>Order Details - {{ $order->order_id }}</h2>

            <div class="order-info">
                <p><strong>Date:</strong> {{ $order->created_at->format('d M Y') }}</p>
                <p><strong>Total:</strong> Rp{{ number_format($order->grand_total, 0, ',', '.') }}</p>
                <p><strong>Status:</strong> {{ $order->status }}</p>
            </div>

            <h4>Ordered Items</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderItems as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</main>
@endsection
