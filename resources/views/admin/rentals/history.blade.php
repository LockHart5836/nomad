<x-admin-layout title="Rental History - Admin Panel" pageTitle="Rental History">
    <div class="container-fluid">
        <!-- Stats Card -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <i class="fas fa-history"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $completedRentals->count() }}</h3>
                        <p>Completed Transactions</p>
                    </div>
                </div>
                <br>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div class="stat-info">
                        <h3>₱{{ number_format($completedRentals->sum('total_price'), 2) }}</h3>
                        <p>Total Revenue</p>
                    </div>
                </div>
            </div>
        </div>
         <br>

        <!-- Rental History Table -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-list me-2"></i>Completed Rentals
                </h5>
            </div>
            <div class="card-body">
                @if($completedRentals->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Booking ID</th>
                                    <th>Vehicle</th>
                                    <th>Customer</th>
                                    <th>Contact</th>
                                    <th>Rental Period</th>
                                    <th>Total Price</th>
                                    <th>Completed At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($completedRentals as $rental)
                                    <tr>
                                        <td>
                                            <strong class="text-primary">#{{ $rental->id }}</strong>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($rental->car->image)
                                                    <img src="{{ asset('storage/' . $rental->car->image) }}" 
                                                         alt="{{ $rental->car->name }}"
                                                         style="width: 50px; height: 35px; object-fit: cover; border-radius: 5px; margin-right: 10px;">
                                                @endif
                                                <div>
                                                    <strong>{{ $rental->car->name }}</strong>
                                                    <br>
                                                    <small class="text-muted">{{ $rental->car->category }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $rental->customer_name }}</td>
                                        <td>
                                            <small>{{ $rental->customer_email }}</small>
                                            <br>
                                            <small>{{ $rental->customer_phone }}</small>
                                        </td>
                                        <td>
                                            <div>
                                                <small class="text-muted">From:</small>
                                                <strong>{{ \Carbon\Carbon::parse($rental->start_date)->format('M d, Y') }}</strong>
                                            </div>
                                            <div>
                                                <small class="text-muted">To:</small>
                                                <strong>{{ \Carbon\Carbon::parse($rental->end_date)->format('M d, Y') }}</strong>
                                            </div>
                                            <small class="text-info">
                                                ({{ \Carbon\Carbon::parse($rental->start_date)->diffInDays(\Carbon\Carbon::parse($rental->end_date)) }} days)
                                            </small>
                                        </td>
                                        <td>
                                            <strong class="text-success">₱{{ number_format($rental->total_price, 2) }}</strong>
                                        </td>
                                        <td>
                                            <div class="timestamp-box">
                                                <i class="fas fa-check-circle text-success me-1"></i>
                                                <div>
                                                    <strong>{{ \Carbon\Carbon::parse($rental->updated_at)->format('M d, Y') }}</strong>
                                                    <br>
                                                    <small class="text-muted">{{ \Carbon\Carbon::parse($rental->updated_at)->format('h:i A') }}</small>
                                                    <br>
                                                    <small class="text-info">{{ \Carbon\Carbon::parse($rental->updated_at)->diffForHumans() }}</small>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-inbox" style="font-size: 4rem; color: #6c757d; opacity: 0.3;"></i>
                        <h5 class="mt-3 text-muted">No Rental History</h5>
                        <p class="text-muted">Completed rentals will appear here.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .container-fluid {
            padding: 30px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 25px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .stat-icon {
            width: 70px;
            height: 70px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
        }

        .stat-info h3 {
            margin: 0;
            font-size: 2rem;
            font-weight: 700;
            color: white;
        }

        .stat-info p {
            margin: 0;
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
        }

        .card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: rgba(255, 255, 255, 0.03);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 15px 15px 0 0;
        }

        .card-header h5 {
            color: white;
            margin: 0;
            font-weight: 600;
        }

        .card-body {
            padding: 25px;
        }

        .table {
            color: white;
            margin-bottom: 0;
        }

        .table thead th {
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.8);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            padding: 15px;
        }

        .table tbody td {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            padding: 15px;
            vertical-align: middle;
        }

        .table tbody tr {
            transition: background-color 0.3s ease;
        }

        .table tbody tr:hover {
            background: rgba(255, 255, 255, 0.03);
        }

        .text-primary {
            color: #667eea !important;
        }

        .text-success {
            color: #28a745 !important;
        }

        .text-info {
            color: #17a2b8 !important;
        }

        .text-muted {
            color: rgba(255, 255, 255, 0.6) !important;
        }

        .timestamp-box {
            display: flex;
            align-items: flex-start;
            gap: 5px;
            background: rgba(40, 167, 69, 0.1);
            padding: 10px;
            border-radius: 8px;
            border-left: 3px solid #28a745;
        }

        .timestamp-box strong {
            color: white;
        }

        .timestamp-box .text-success {
            font-size: 1.2rem;
        }
    </style>
</x-admin-layout>
