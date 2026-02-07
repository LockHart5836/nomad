<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Cars — StacyGarage Admin</title>
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
            width: 1.5rem;
            text-align: center;
        }
        .sidebar-footer {
            padding: 1rem 0;
            border-top: 1px solid rgba(164, 30, 52, 0.2);
        }
        
        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            display: flex;
            flex-direction: column;
        }
        .topbar {
            padding: 1.25rem 2rem;
            background: rgba(26, 31, 46, 0.4);
            border-bottom: 1px solid rgba(164, 30, 52, 0.15);
            display: flex;
            align-items: center;
            justify-content: space-between;
            backdrop-filter: blur(8px);
        }
        .topbar-left h1 {
            font-size: 1.75rem;
            margin: 0;
            font-weight: 600;
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
        }
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            display: grid;
            place-items: center;
            font-size: 1.2rem;
        }
        .user-info {
            line-height: 1.3;
        }
        .user-name {
            font-weight: 600;
            font-size: .95rem;
        }
        .user-role {
            font-size: .8rem;
            color: var(--muted);
        }
        
        /* Content Area */
        .content-area {
            flex: 1;
            padding: 2rem;
            overflow-y: auto;
        }
        .alert {
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            border-radius: .5rem;
            background: rgba(34, 197, 94, 0.15);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #4ade80;
            display: flex;
            align-items: center;
            gap: .75rem;
        }
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        .page-header h2 {
            font-size: 2rem;
            margin: 0;
        }
        .btn {
            padding: .75rem 1.5rem;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            color: #fff;
            border: none;
            border-radius: .5rem;
            font-weight: 600;
            font-size: .9rem;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            transition: transform .06s ease, box-shadow .2s ease;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px var(--ring);
        }
        .btn-sm {
            padding: .5rem 1rem;
            font-size: .85rem;
        }
        .btn-warning {
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
        }
        .btn-success {
            background: linear-gradient(135deg, #10b981, #059669);
        }
        .btn-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
        }
        
        /* Table */
        .table-wrapper {
            background: var(--card);
            border-radius: .75rem;
            overflow: hidden;
            border: 1px solid rgba(164, 30, 52, 0.15);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid rgba(164, 30, 52, 0.1);
        }
        th {
            background: rgba(164, 30, 52, 0.1);
            font-weight: 600;
            color: var(--accent-light);
            font-size: .9rem;
            text-transform: uppercase;
            letter-spacing: .05em;
        }
        tr:hover {
            background: rgba(164, 30, 52, 0.05);
        }
        tbody tr:last-child td {
            border-bottom: none;
        }
        .car-thumb {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: .5rem;
            border: 1px solid rgba(164, 30, 52, 0.2);
        }
        .badge {
            display: inline-block;
            padding: .35rem .75rem;
            border-radius: .375rem;
            font-size: .85rem;
            font-weight: 600;
        }
        .badge-success {
            background: rgba(34, 197, 94, 0.15);
            color: #4ade80;
            border: 1px solid rgba(34, 197, 94, 0.3);
        }
        .badge-danger {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }
        .badge-category {
            background: rgba(251, 191, 36, 0.15);
            color: #fbbf24;
            border: 1px solid rgba(251, 191, 36, 0.3);
        }
        .action-buttons {
            display: flex;
            gap: .5rem;
        }
        .no-cars {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--muted);
        }
        .no-cars i {
            font-size: 5rem;
            opacity: 0.2;
            margin-bottom: 1rem;
        }
        .no-cars h3 {
            margin: 1rem 0 .5rem;
            color: var(--fg);
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
                <h1>Manage Vehicles</h1>
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

        <!-- Content -->
        <div class="content-area">
            @if(session('success'))
                <div class="alert">
                    <i class="fas fa-check-circle"></i> 
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="page-header">
                <h2>Vehicle Fleet</h2>
                <a href="{{ route('admin.cars.create') }}" class="btn">
                    <i class="fas fa-plus"></i> Add New Car
                </a>
            </div>

            @if($cars->count() > 0)
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Price/Day</th>
                                <th>Seats</th>
                                <th>Transmission</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cars as $car)
                                <tr>
                                    <td>
                                        @if($car->image)
                                            <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->name }}" class="car-thumb">
                                        @else
                                            <div style="width: 80px; height: 60px; background: rgba(164, 30, 52, 0.1); border-radius: .5rem; display: flex; align-items: center; justify-content: center; border: 1px solid rgba(164, 30, 52, 0.2);">
                                                <i class="fas fa-car" style="color: var(--muted);"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td><strong>{{ $car->name }}</strong></td>
                                    <td><span class="badge badge-category">{{ ucfirst($car->category) }}</span></td>
                                    <td><strong>₱{{ number_format($car->price, 2) }}</strong></td>
                                    <td><i class="fas fa-user"></i> {{ $car->seats }}</td>
                                    <td><i class="fas fa-cog"></i> {{ $car->transmission }}</td>
                                    <td>
                                        <span class="badge {{ $car->available ? 'badge-success' : 'badge-danger' }}">
                                            <i class="fas fa-{{ $car->available ? 'check' : 'times' }}"></i>
                                            {{ $car->available ? 'Available' : 'Rented' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('admin.cars.edit', $car) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.cars.toggle', $car) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-success btn-sm" title="Toggle Availability">
                                                    <i class="fas fa-toggle-{{ $car->available ? 'on' : 'off' }}"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.cars.destroy', $car) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete this car?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="no-cars">
                    <i class="fas fa-car-side"></i>
                    <h3>No Cars Yet</h3>
                    <p>Start by adding your first car to the fleet.</p>
                </div>
            @endif
        </div>
    </main>
</body>
</html>
