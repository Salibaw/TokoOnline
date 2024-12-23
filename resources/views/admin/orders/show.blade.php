@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Order #{{ $order->id }}</h5>
            <span class="badge bg-info text-dark">Status: {{ ucfirst($order->status) }}</span>
        </div>
        <div class="card-body">
            <!-- Customer Details -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5 class="text-primary">Customer Details</h5>
                    <p><strong>Name:</strong> {{ $order->customer_name }}</p>
                    <p><strong>Email:</strong> {{ $order->customer_email }}</p>
                    <p><strong>Phone:</strong> {{ $order->customer_phone }}</p>
                    <p><strong>Address:</strong> {{ $order->customer_address }}</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <h5 class="text-primary">Order Summary</h5>
                    <p><strong>Order ID:</strong> #{{ $order->id }}</p>
                    <p><strong>Date:</strong> {{ $order->created_at->format('d M Y, H:i') }}</p>
                    <p><strong>Total:</strong> <span class="text-success">Rp{{ number_format($order->grand_total, 2) }}</span></p>
                </div>
            </div>

            <!-- Order Details -->
            <h5 class="text-primary mb-3">Order Details</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderItems as $item)
                            <tr>
                                <td>{{ $item->product->title ?? 'Product not found' }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>Rp{{ number_format($item->price, 2) }}</td>
                                <td>Rp{{ number_format($item->price * $item->quantity, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Grand Total -->
            <div class="text-end mt-4">
                <h4 class="text-primary"><strong>Grand Total:</strong> <span class="text-success">Rp{{ number_format($order->grand_total, 2) }}</span></h4>
            </div>
        </div>
        <div class="card-footer bg-light text-end">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back to Orders
            </a>
        </div>
    </div>
</div>
@endsection
