@extends('front.layouts.header')

@section('content')
<main>
    <section class="section-orders pt-4">
        <div class="container">
            <h2>My Orders</h2>
            
            @if($orders->isEmpty())
                <p>You have no orders yet.</p>
            @else
                <table class="table">
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
                                <td>{{ $order->status }}</td>
                                <td>
                                    <a href="{{ route('orders.viewOrder', $order->id) }}" class="btn btn-info btn-sm">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </section>
</main>
@endsection
