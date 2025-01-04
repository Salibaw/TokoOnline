@extends('front.layouts.header')

@section('content')
<style>
    /* Container styling */
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 1.5rem;
    }

    /* Title styling */
    .orders-title {
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 1rem;
        color: #3b82f6;
        text-align: center;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        position: relative;
        display: inline-block;
    }

    .orders-title::after {
        content: '';
        display: block;
        width: 50px;
        height: 4px;
        background-color: #f59e0b;
        margin: 8px auto 0;
        border-radius: 2px;
    }

    /* Empty orders message */
    .no-orders {
        color: #ef4444;
        font-size: 18px;
        text-align: center;
        font-weight: bold;
        padding: 1rem;
        background-color: #fee2e2;
        border: 1px solid #fca5a5;
        border-radius: 8px;
    }

    /* Table styling */
    .table-wrapper {
        overflow-x: auto;
        margin-top: 1rem;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .orders-table {
        width: 100%;
        border-collapse: collapse;
        background-color: #fff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .orders-table thead {
        background-color: #f3f4f6;
        color: #1f2937;
    }

    .orders-table th,
    .orders-table td {
        text-align: left;
        padding: 12px 16px;
        border-bottom: 1px solid #e5e7eb;
    }

    .orders-table tr:hover {
        background-color: #f0f9ff;
    }

    .orders-table th {
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .orders-table td {
        font-size: 14px;
        color: #374151;
    }

    /* Status styling */
    .status {
        display: inline-block;
        padding: 4px 8px;
        font-size: 12px;
        font-weight: bold;
        border-radius: 12px;
        text-transform: capitalize;
    }

    .status.pending {
        background-color: #f59e0b;
        color: #fff;
    }

    .status.completed {
        background-color: #10b981;
        color: #fff;
    }

    .status.canceled {
        background-color: #ef4444;
        color: #fff;
    }

    /* Button styling */
    .btn-view {
        display: inline-block;
        padding: 8px 16px;
        background-color: #3b82f6;
        color: #fff;
        text-decoration: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: bold;
        text-align: center;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .btn-view:hover {
        background-color: #2563eb;
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
    }
</style>
<main>
    <section class="section-orders pt-4">
        <div class="container">
            <h2 class="orders-title">🎉 My Orders</h2>

            @if($orders->isEmpty())
                <p class="no-orders">😢 You have no orders yet. Start shopping now!</p>
            @else
                <div class="table-wrapper">
                    <table class="orders-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                    <td>Rp{{ number_format($order->grand_total, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="status {{ strtolower($order->status) }}">{{ $order->status }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('orders.viewOrder', $order->id) }}" class="btn-view">🔍 View</a>
                                    </td>
                                </tr>
                            @endforeach
                           
                        </tbody>
                    </table> <a href="{{ url('/') }}" class="btn btn-secondary w-100 mt-2">Back</a>
                </div>
            @endif
        </div>
    </section>
</main>
@endsection