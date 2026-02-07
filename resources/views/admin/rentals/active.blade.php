<x-admin-layout title="Active Rentals - Admin Panel" pageTitle="Active Rentals">
    <div class="container-fluid">
        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Stats Card -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <i class="fas fa-car-side"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $activeRentals->count() }}</h3>
                        <p>Cars Currently In Use</p>
                    </div>
                </div>
            </div>
        </div>
        <br>

        <!-- Active Rentals Table -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-list me-2"></i>Active Rentals
                </h5>
            </div>
            <div class="card-body">
                @if($activeRentals->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Booking ID</th>
                                    <th>Vehicle</th>
                                    <th>Customer</th>
                                    <th>Contact</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Total Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($activeRentals as $rental)
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
                                        <td>{{ \Carbon\Carbon::parse($rental->start_date)->format('M d, Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($rental->end_date)->format('M d, Y') }}</td>
                                        <td>
                                            <strong class="text-success">₱{{ number_format($rental->total_price, 2) }}</strong>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.rentals.complete', $rental->id) }}" 
                                                  method="POST" 
                                                  style="display: inline-block;"
                                                  onsubmit="return confirm('Mark this rental as completed and make {{ $rental->car->name }} available again?');">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-success">
                                                    <i class="fas fa-check me-1"></i>Complete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-inbox" style="font-size: 4rem; color: #6c757d; opacity: 0.3;"></i>
                        <h5 class="mt-3 text-muted">No Active Rentals</h5>
                        <p class="text-muted">All cars are currently available for booking.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .container-fluid {
            padding: 30px;
        }

        .alert {
            border-radius: 10px;
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .alert-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
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

        .text-muted {
            color: rgba(255, 255, 255, 0.6) !important;
        }

        .btn-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border: none;
            color: white;
            padding: 8px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
            background: linear-gradient(135deg, #20c997 0%, #28a745 100%);
        }

        .btn-close {
            filter: brightness(0) invert(1);
        }
    </style>
</x-admin-layout>
