@extends('admin.layouts.app')

@section('content')
<style>
	/* Dashboard Title */
.dashboard-title {
    font-size: 32px;
    font-weight: bold;
    color: #1f2937;
    text-align: left;
    margin-bottom: 1.5rem;
}

/* Info Card Styling */
.info-card {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 1.5rem;
    border-radius: 12px;
    color: #fff;
    position: relative;
    overflow: hidden;
    transition: transform 0.3s ease;
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
}

.info-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 20px rgba(0, 0, 0, 0.3);
}

.info-card-icon {
    font-size: 48px;
    opacity: 0.8;
    margin-bottom: 1rem;
}

.info-card-content h3 {
    font-size: 28px;
    margin: 0;
}

.info-card-content p {
    font-size: 16px;
    font-weight: 500;
}

.info-card-footer {
    text-decoration: none;
    color: #fff;
    font-size: 14px;
    font-weight: bold;
    margin-top: 1rem;
    display: flex;
    align-items: center;
    justify-content: flex-end;
}

.info-card-footer i {
    margin-left: 0.5rem;
}

/* Gradient Colors */
.bg-gradient-info {
    background: linear-gradient(135deg, #4fc3f7, #0288d1);
}

.bg-gradient-success {
    background: linear-gradient(135deg, #81c784, #388e3c);
}

.bg-gradient-warning {
    background: linear-gradient(135deg, #ffd54f, #f57c00);
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #7986cb, #303f9f);
}

.bg-gradient-danger {
    background: linear-gradient(135deg, #e57373, #d32f2f);
}

.bg-gradient-secondary {
    background: linear-gradient(135deg, #cfd8dc, #607d8b);
}
</style>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="dashboard-title">📊 Admin Dashboard</h1>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- Total Orders -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="info-card bg-gradient-info">
                    <div class="info-card-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="info-card-content">
                        <h3>{{ $totalOrders }}</h3>
                        <p>Total Orders</p>
                    </div>
                    <a href="{{route('admin.orders.index')}}" class="info-card-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <!-- Total Customers -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="info-card bg-gradient-success">
                    <div class="info-card-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="info-card-content">
                        <h3>{{ $totalCustomers }}</h3>
                        <p>Total Customers</p>
                    </div>
                    <a href="#" class="info-card-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <!-- Total Sales -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="info-card bg-gradient-warning">
                    <div class="info-card-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="info-card-content">
                        <h3>Rp{{ number_format($totalSales, 2) }}</h3>
                        <p>Total Sales</p>
                    </div>
                    <a href="#" class="info-card-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <!-- Processed Orders -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="info-card bg-gradient-primary">
                    <div class="info-card-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="info-card-content">
                        <h3>{{ $processedOrders }}</h3>
                        <p>Processed Orders</p>
                    </div>
                    <a href="#" class="info-card-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <!-- Pending Orders -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="info-card bg-gradient-danger">
                    <div class="info-card-icon">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <div class="info-card-content">
                        <h3>{{ $pendingOrders }}</h3>
                        <p>Pending Orders</p>
                    </div>
                    <a href="#" class="info-card-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <!-- New Customers -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="info-card bg-gradient-secondary">
                    <div class="info-card-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="info-card-content">
                        <h3>{{ $newCustomers }}</h3>
                        <p>New Customers</p>
                    </div>
                    <a href="#" class="info-card-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
