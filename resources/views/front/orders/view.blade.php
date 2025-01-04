@extends('front.layouts.header')

@section('content')
<style>
    /* Order Header */
.order-header {
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    color: #fff;
    border-radius: 8px;
    padding: 1.5rem;
}

.order-header h2 {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 0.5rem;
}

.order-id {
    font-size: 16px;
    font-weight: 500;
}

/* Badge Styling */
.badge-success {
    background-color: #28a745;
    color: #fff;
    padding: 0.3rem 0.6rem;
    border-radius: 4px;
}

.badge-warning {
    background-color: #ffc107;
    color: #fff;
    padding: 0.3rem 0.6rem;
    border-radius: 4px;
}

/* Order Summary */
.order-summary {
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.order-summary h4 {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 1rem;
}

.table th {
    font-weight: 600;
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: #f9f9f9;
}

/* Buttons */
.btn-outline-primary {
    border: 2px solid #2575fc;
    color: #2575fc;
    font-weight: bold;
    transition: all 0.3s ease;
}

.btn-outline-primary:hover {
    background-color: #2575fc;
    color: #fff;
}

</style>
<main>
    <section class="section-order-detail py-5">
        <div class="container">
            <div class="order-header bg-gradient-primary text-white rounded-lg p-4 mb-4">
                <h2 class="mb-2">Order Details</h2>
                <p class="order-id"><strong>Order ID:</strong> {{ $order->order_id }}</p>
                <p><strong>Date:</strong> {{ $order->created_at->format('d M Y') }}</p>
                <p><strong>Status:</strong> 
                    <span class="badge badge-{{ strtolower($order->status) == 'completed' ? 'success' : 'warning' }}">
                        {{ $order->status }}
                    </span>
                </p>
            </div>

            <div class="order-summary bg-white rounded-lg shadow-sm p-4">
                <h4 class="mb-3">Ordered Items</h4>
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead class="bg-light text-secondary">
                            <tr>
                                <th>No</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderItems as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->product->title }}</td>
                                    <td>Rp{{ number_format($item->price, 2) }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-end mt-4">
                    <h4 class="text-primary"><strong>Grand Total:</strong> <span
                            class="text-success">Rp{{ number_format($order->grand_total, 2) }}</span></h4>
                </div>
            </div>

            <div class="text-end mt-4">
                <a href="{{ route('orders.myOrders') }}" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left"></i> Back to Orders
                </a>
            </div>
        </div>
    </section>
</main>
@endsection
