@extends('admin.layouts.app')

@section('content')
<style>
    /* Gradient Header */
.bg-gradient-primary {
    background: linear-gradient(135deg, #007bff, #6610f2);
    color: white;
}

/* Table Enhancements */
.table thead {
    font-weight: bold;
}

.table-hover tbody tr:hover {
    background-color: #f8f9fa;
}

/* Form Select Styling */
.form-select-sm {
    border-radius: 5px;
    font-size: 0.875rem;
}

/* Buttons */
.btn-outline-primary {
    border-color: #007bff;
    color: #007bff;
    transition: all 0.3s ease-in-out;
}

.btn-outline-primary:hover {
    background-color: #007bff;
    color: white;
}

</style>
<div class="container mt-4">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Card: Order List -->
    <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient-primary text-white">
            <h5 class="mb-0"><i class="bi bi-cart-fill me-2"></i> Order List</h5>
        </div>

        <div class="card-body">
            <!-- Table: Orders -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center">
                    <thead class="table-dark">
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
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->customer_name }}</td>
                                <td>{{ $order->customer_email }}</td>
                                <td>{{ $order->customer_phone }}</td>
                                <td>Rp{{ number_format($order->grand_total, 2) }}</td>
                                <td>
                                    <!-- Status Dropdown -->
                                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <select name="status" class="form-select form-select-sm text-center text-capitalize" onchange="this.form.submit()">
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>
                                                Pending
                                            </option>
                                            <option value="process" {{ $order->status == 'process' ? 'selected' : '' }}>
                                                Process
                                            </option>
                                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>
                                                Delivered
                                            </option>
                                            <option value="complete" {{ $order->status == 'complete' ? 'selected' : '' }}>
                                                Complete
                                            </option>
                                            <option value="cancel" {{ $order->status == 'cancel' ? 'selected' : '' }}>
                                                Cancel
                                            </option>
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-eye-fill"></i> View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="card-footer d-flex justify-content-between align-items-center">
            <span>
                <strong>Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of {{ $orders->total() }} orders</strong>
            </span>
            <nav>
                {{ $orders->links('pagination::bootstrap-5') }}
            </nav>
        </div>
    </div>
</div>
@endsection
