@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Card containing Order List -->
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Order List</h5>
        </div>

        <div class="card-body">
            <!-- Table of Orders -->
            <table class="table table-hover table-bordered table-sm mb-0">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td>{{ $order->customer_email }}</td>
                            <td>{{ $order->customer_phone }}</td>
                            <td>Rp{{ number_format($order->grand_total, 2) }}</td>
                            <td>
                                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                    @csrf
                                    <!-- Status Color-Coding & Icons -->
                                    <div class="btn-group">
                                        <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                            <option value="pending" class="text-warning" {{ $order->status == 'pending' ? 'selected' : '' }}>
                                                <i class="bi bi-hourglass-split"></i> Pending
                                            </option>
                                            <option value="process" class="text-info" {{ $order->status == 'process' ? 'selected' : '' }}>
                                                <i class="bi bi-cogs"></i> Process
                                            </option>
                                            <option value="delivered" class="text-success" {{ $order->status == 'delivered' ? 'selected' : '' }}>
                                                <i class="bi bi-check-circle"></i> Delivered
                                            </option>
                                            <option value="complete" class="text-primary" {{ $order->status == 'complete' ? 'selected' : '' }}>
                                                <i class="bi bi-badge-check"></i> Complete
                                            </option>
                                            <option value="cancel" class="text-danger" {{ $order->status == 'cancel' ? 'selected' : '' }}>
                                                <i class="bi bi-x-circle"></i> Cancel
                                            </option>
                                        </select>
                                    </div>
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-info btn-sm">
                                    <i class="bi bi-eye"></i> View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="card-footer d-flex justify-content-between align-items-center">
            <div>
                <strong>Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of {{ $orders->total() }} orders</strong>
            </div>
            <div>
                {{ $orders->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection
