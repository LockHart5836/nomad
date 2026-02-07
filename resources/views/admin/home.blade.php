<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard — StacyGarage</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --bg: #0a0e1a;
            --fg: #f5f5f5;
            --muted: #b0b0b0;
            --card: #1a1f2e;
            --accent: #a41e34;
            --accent-light: #d63447;
            --accent-dark: #7a1628;
            --ring: rgba(164, 30, 52, 0.35);
            --sidebar-width: 260px;
        }
        * { box-sizing: border-box; }
        html, body { height: 100%; margin: 0; }
        body {
            font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif;
            color: var(--fg);
            background: var(--bg);
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, rgba(26, 31, 46, 0.95), rgba(10, 14, 26, 0.95));
            border-right: 1px solid rgba(164, 30, 52, 0.2);
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }
        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(164, 30, 52, 0.2);
        }
        .brand {
            display: flex;
            align-items: center;
            gap: .75rem;
            font-size: 1.3rem;
            font-weight: 700;
            text-decoration: none;
            color: var(--fg);
        }
        .brand-badge {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            display: grid;
            place-items: center;
            font-size: 1.2rem;
            box-shadow: 0 4px 12px var(--ring);
        }
        .sidebar-nav {
            flex: 1;
            padding: 1rem 0;
        }
        .nav-section {
            margin-bottom: 1.5rem;
        }
        .nav-section-title {
            padding: 0 1.5rem;
            font-size: .75rem;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: .5rem;
            letter-spacing: .05em;
        }
        .nav-item {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .75rem 1.5rem;
            color: var(--muted);
            text-decoration: none;
            transition: all .2s ease;
            border-left: 3px solid transparent;
        }
        .nav-item:hover {
            color: var(--fg);
            background: rgba(164, 30, 52, 0.1);
        }
        .nav-item.active {
            color: var(--accent-light);
            background: rgba(164, 30, 52, 0.15);
            border-left-color: var(--accent);
        }
        .nav-icon {
            font-size: 1.2rem;
        }
        .sidebar-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(164, 30, 52, 0.2);
        }
        
        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            display: flex;
            flex-direction: column;
        }
        
        /* Top Bar */
        .topbar {
            height: 70px;
            background: linear-gradient(90deg, rgba(26, 31, 46, 0.8), rgba(10, 14, 26, 0.9));
            border-bottom: 1px solid rgba(164, 30, 52, 0.2);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            backdrop-filter: blur(10px);
        }
        .topbar-left h1 {
            margin: 0;
            font-size: 1.5rem;
            color: var(--fg);
        }
        .topbar-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        .user-profile {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .5rem 1rem;
            background: rgba(164, 30, 52, 0.1);
            border-radius: .75rem;
            border: 1px solid rgba(164, 30, 52, 0.2);
        }
        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            display: grid;
            place-items: center;
            font-size: 1rem;
        }
        .user-info {
            display: flex;
            flex-direction: column;
        }
        .user-name {
            font-weight: 600;
            font-size: .95rem;
            color: var(--fg);
        }
        .user-role {
            font-size: .75rem;
            color: var(--muted);
        }
        
        /* Dashboard Content */
        .dashboard-content {
            flex: 1;
            padding: 2rem;
            overflow-y: auto;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        .stat-card {
            background: linear-gradient(135deg, rgba(26, 31, 46, 0.8), rgba(26, 31, 46, 0.5));
            border: 1px solid rgba(164, 30, 52, 0.2);
            border-radius: 1rem;
            padding: 1.5rem;
            transition: transform .3s ease, border-color .3s ease;
        }
        .stat-card:hover {
            transform: translateY(-4px);
            border-color: var(--accent);
        }
        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        .stat-title {
            color: var(--muted);
            font-size: .9rem;
            font-weight: 500;
        }
        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: .75rem;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            display: grid;
            place-items: center;
            font-size: 1.3rem;
        }
        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--fg);
            margin-bottom: .25rem;
        }
        .stat-change {
            font-size: .85rem;
            color: #22c55e;
        }
        .stat-change.negative {
            color: #ef4444;
        }
        
        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.5rem;
        }
        .card {
            background: linear-gradient(135deg, rgba(26, 31, 46, 0.8), rgba(26, 31, 46, 0.5));
            border: 1px solid rgba(164, 30, 52, 0.2);
            border-radius: 1rem;
            padding: 1.5rem;
        }
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--fg);
        }
        .card-action {
            color: var(--accent-light);
            text-decoration: none;
            font-size: .9rem;
            transition: color .2s ease;
        }
        .card-action:hover {
            color: var(--accent);
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th {
            text-align: left;
            padding: .75rem;
            color: var(--muted);
            font-size: .85rem;
            font-weight: 600;
            border-bottom: 1px solid rgba(164, 30, 52, 0.2);
        }
        .table td {
            padding: .75rem;
            color: var(--fg);
            border-bottom: 1px solid rgba(164, 30, 52, 0.1);
        }
        .table tr:hover {
            background: rgba(164, 30, 52, 0.05);
        }
        .badge {
            display: inline-block;
            padding: .25rem .75rem;
            border-radius: .5rem;
            font-size: .8rem;
            font-weight: 600;
        }
        .badge.success {
            background: rgba(34, 197, 94, 0.2);
            color: #22c55e;
        }
        .badge.warning {
            background: rgba(245, 158, 11, 0.2);
            color: #f59e0b;
        }
        .badge.danger {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
        }
        
        .btn {
            padding: .5rem 1rem;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            color: #fff;
            border: none;
            border-radius: .5rem;
            font-weight: 600;
            font-size: .9rem;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: transform .06s ease, box-shadow .2s ease;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px var(--ring);
        }
        
        @media (max-width: 1024px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
        }
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <x-admin-sidebar />

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Bar -->
        <header class="topbar">
            <div class="topbar-left">
                <h1>Dashboard Overview</h1>
            </div>
            <div class="topbar-right">
                <div class="user-profile">
                    <div class="user-avatar"><i class="fas fa-user-circle"></i></div>
                    <div class="user-info">
                        <div class="user-name">Admin User</div>
                        <div class="user-role">Administrator</div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <!-- Success Message -->
            @if(session('success'))
                <div class="alert" style="margin-bottom: 2rem;">
                    <i class="fas fa-check-circle"></i> 
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-title">Total Vehicles</span>
                        <div class="stat-icon"><i class="fas fa-car"></i></div>
                    </div>
                    <div class="stat-value">{{ $totalCars }}</div>
                    <div class="stat-change">{{ $availableCars }} available</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-title">Pending Bookings</span>
                        <div class="stat-icon"><i class="fas fa-clock"></i></div>
                    </div>
                    <div class="stat-value">{{ $pendingBookings }}</div>
                    <div class="stat-change">Awaiting confirmation</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-title">Confirmed Rentals</span>
                        <div class="stat-icon"><i class="fas fa-calendar-check"></i></div>
                    </div>
                    <div class="stat-value">{{ $confirmedBookings }}</div>
                    <div class="stat-change">Active bookings</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-title">Total Bookings</span>
                        <div class="stat-icon"><i class="fas fa-list"></i></div>
                    </div>
                    <div class="stat-value">{{ $totalBookings }}</div>
                    <div class="stat-change">All time</div>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="content-grid">
                <!-- Recent Bookings -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Recent Bookings (Pending)</h2>
                        <a href="#" class="card-action">View All →</a>
                    </div>
                    @if($recentBookings->count() > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Vehicle</th>
                                    <th>Dates</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentBookings as $booking)
                                    <tr>
                                        <td>
                                            <div style="display: flex; flex-direction: column;">
                                                <strong>{{ $booking->customer_name }}</strong>
                                                <small style="color: var(--muted); font-size: .85rem;">{{ $booking->customer_email }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            <strong>{{ $booking->car->name }}</strong>
                                        </td>
                                        <td>
                                            <div style="display: flex; flex-direction: column;">
                                                <span style="font-size: .9rem;">{{ \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') }}</span>
                                                <small style="color: var(--muted); font-size: .8rem;">to {{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            <strong style="color: var(--accent-light);">₱{{ number_format($booking->total_price, 2) }}</strong>
                                        </td>
                                        <td>
                                            <span class="badge {{ $booking->status === 'pending' ? 'warning' : ($booking->status === 'confirmed' ? 'success' : 'danger') }}">
                                                <i class="fas fa-{{ $booking->status === 'pending' ? 'clock' : ($booking->status === 'confirmed' ? 'check' : 'times') }}"></i>
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($booking->status === 'pending')
                                                <form action="{{ route('admin.bookings.approve', $booking) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn" style="padding: .4rem .8rem; font-size: .85rem;" onclick="return confirm('Approve this booking and send confirmation email to customer?');">
                                                        <i class="fas fa-check"></i> Approve
                                                    </button>
                                                </form>
                                            @else
                                                <span style="color: var(--muted); font-size: .85rem;">
                                                    <i class="fas fa-check-circle"></i> {{ ucfirst($booking->status) }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div style="text-align: center; padding: 3rem; color: var(--muted);">
                            <i class="fas fa-calendar-times" style="font-size: 3rem; opacity: 0.3; margin-bottom: 1rem;"></i>
                            <p>No bookings yet</p>
                            <p style="font-size: .9rem;">Bookings will appear here when customers make reservations</p>
                        </div>
                    @endif
                </div>

                <!-- Quick Actions -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Quick Actions</h2>
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 1rem;">
                        <a href="{{ route('admin.cars.create') }}" class="btn" style="width: 100%; text-align: center;">
                            <i class="fas fa-plus"></i> Add New Vehicle
                        </a>
                      
                        <a href="{{ route('admin.cars.index') }}" class="btn" style="width: 100%; text-align: center;">
                            <i class="fas fa-cog"></i> Manage Vehicles
                        </a>
                        <a href="/" class="btn" style="width: 100%; text-align: center;">
                            <i class="fas fa-home"></i> View Website
                        </a>
                    </div>
                    
                    <div style="margin-top: 2rem;">
                        <div class="card-header">
                            <h3 class="card-title" style="font-size: 1rem;">System Status</h3>
                        </div>
                        <div style="display: flex; flex-direction: column; gap: .75rem;">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span style="color: var(--muted); font-size: .9rem;">
                                    <i class="fas fa-database"></i> Database
                                </span>
                                <span class="badge success">Online</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span style="color: var(--muted); font-size: .9rem;">
                                    <i class="fas fa-car"></i> Available Cars
                                </span>
                                <span class="badge success">{{ $availableCars }}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span style="color: var(--muted); font-size: .9rem;">
                                    <i class="fas fa-clock"></i> Pending
                                </span>
                                <span class="badge warning">{{ $pendingBookings }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
