<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Our Fleet - StacyGarage</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --bg: #0a0e1a;
            --fg: #f5f5f5;
            --muted: #b0b0b0;
            --accent: #a41e34;
            --accent-light: #d63447;
            --accent-dark: #7a1628;
            --ring: rgba(164, 30, 52, 0.35);
        }
        * { box-sizing: border-box; }
        html, body { height: 100%; }
        body {
            margin: 0;
            font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif;
            color: var(--fg);
            background: radial-gradient(1200px 600px at 70% -10%, rgba(164, 30, 52, 0.08), transparent 60%),
                        radial-gradient(800px 400px at 10% 10%, rgba(26, 31, 46, 0.5), transparent 60%),
                        var(--bg);
            display: flex;
            flex-direction: column;
            min-height: 100%;
        }
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.25rem;
        }
        header {
            position: sticky;
            top: 0;
            z-index: 50;
            backdrop-filter: saturate(180%) blur(6px);
            background: linear-gradient(to bottom, rgba(10, 14, 26, 0.85), rgba(10, 14, 26, 0.65));
            border-bottom: 1px solid rgba(164, 30, 52, 0.2);
        }
        .nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 64px;
        }
        .brand {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            font-weight: 700;
            letter-spacing: .2px;
            text-decoration: none;
            font-size: 1.3rem;
        }
        nav a {
            color: var(--muted);
            text-decoration: none;
            margin-left: 1.5rem;
            padding: .5rem .75rem;
            border-radius: .5rem;
            transition: color .2s ease;
        }
        nav a:hover {
            color: var(--accent-light);
        }
        .page-header {
            padding: 3rem 0 2rem;
            text-align: center;
        }
        .page-header h1 {
            font-size: 3rem;
            margin: 0 0 1rem 0;
            color: var(--fg);
        }
        .page-header p {
            color: var(--muted);
            font-size: 1.2rem;
        }
        .filters {
            display: flex;
            gap: 1rem;
            padding: 2rem 0;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
        }
        .filter-btn {
            padding: .75rem 1.5rem;
            border: 2px solid rgba(164, 30, 52, 0.3);
            background: rgba(26, 31, 46, 0.6);
            color: var(--fg);
            border-radius: .5rem;
            cursor: pointer;
            transition: all .2s ease;
            text-decoration: none;
            display: inline-block;
        }
        .filter-btn:hover, .filter-btn.active {
            border-color: var(--accent);
            background: rgba(164, 30, 52, 0.2);
            color: var(--accent-light);
        }
        .cars-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 2rem;
            padding: 2rem 0 4rem;
        }
        .car-card {
            background: linear-gradient(135deg, rgba(26, 31, 46, 0.8), rgba(26, 31, 46, 0.5));
            border: 1px solid rgba(164, 30, 52, 0.2);
            border-radius: 1rem;
            overflow: hidden;
            transition: transform .3s ease, border-color .3s ease;
        }
        .car-card:hover {
            transform: translateY(-6px);
            border-color: var(--accent);
        }
        .car-image-wrapper {
            width: 100%;
            height: 250px;
            background: linear-gradient(135deg, var(--accent-dark), var(--accent));
            overflow: hidden;
            position: relative;
        }
        .car-image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .availability-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            padding: .5rem 1rem;
            border-radius: .5rem;
            font-size: .85rem;
            font-weight: 600;
            backdrop-filter: blur(8px);
        }
        .badge-available {
            background: rgba(34, 197, 94, 0.2);
            border: 1px solid rgba(34, 197, 94, 0.5);
            color: #4ade80;
        }
        .badge-unavailable {
            background: rgba(239, 68, 68, 0.2);
            border: 1px solid rgba(239, 68, 68, 0.5);
            color: #f87171;
        }
        .car-info {
            padding: 1.5rem;
        }
        .car-category {
            display: inline-block;
            padding: .25rem .75rem;
            background: rgba(164, 30, 52, 0.2);
            border: 1px solid rgba(164, 30, 52, 0.3);
            border-radius: .25rem;
            font-size: .85rem;
            color: var(--accent-light);
            margin-bottom: .75rem;
        }
        .car-info h3 {
            margin: 0 0 .5rem 0;
            font-size: 1.4rem;
            color: var(--fg);
        }
        .car-info p {
            margin: 0 0 1rem 0;
            color: var(--muted);
            font-size: .95rem;
            line-height: 1.5;
        }
        .car-specs {
            display: flex;
            gap: 1rem;
            margin: 1rem 0;
            font-size: 0.9rem;
            color: var(--muted);
            flex-wrap: wrap;
        }
        .car-spec {
            display: flex;
            align-items: center;
            gap: .5rem;
        }
        .car-spec i {
            color: var(--accent-light);
        }
        .car-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid rgba(164, 30, 52, 0.2);
        }
        .car-price {
            font-size: 1.75rem;
            color: var(--accent-light);
            font-weight: 700;
        }
        .car-price span {
            font-size: .9rem;
            color: var(--muted);
            font-weight: 400;
        }
        .btn-view {
            padding: .75rem 1.5rem;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            color: #fff;
            border: 0;
            border-radius: .5rem;
            cursor: pointer;
            font-weight: 600;
            transition: transform .2s ease;
            text-decoration: none;
            display: inline-block;
        }
        .btn-view:hover {
            transform: translateY(-2px);
        }
        .no-results {
            text-align: center;
            padding: 4rem 0;
            color: var(--muted);
        }
        .no-results i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }
        footer {
            margin-top: auto;
            border-top: 1px solid rgba(164, 30, 52, 0.2);
            background: rgba(10, 14, 26, 0.8);
        }
        .footer-inner {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            padding: 3rem 1rem;
            color: var(--muted);
        }
        .footer-section h4 {
            color: var(--fg);
            margin: 0 0 1rem 0;
        }
        .footer-section a {
            display: block;
            color: var(--muted);
            text-decoration: none;
            margin-bottom: .5rem;
            transition: color .2s ease;
        }
        .footer-section a:hover {
            color: var(--accent-light);
        }
        .footer-bottom {
            border-top: 1px solid rgba(164, 30, 52, 0.2);
            padding: 2rem 1rem;
            text-align: center;
            color: var(--muted);
        }
        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 2rem;
            }
            .filters {
                flex-direction: column;
            }
            .filter-btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    {{-- Header Navigation --}}
    <x-header />

    {{-- Page Header --}}
    <main>
        <div class="container">
            <div class="page-header">
                <h1>Our Premium Fleet</h1>
                <p>Choose from our wide selection of luxury vehicles</p>
            </div>

            {{-- Filters --}}
            <div class="filters">
                <a href="{{ route('cars.index') }}" class="filter-btn {{ !request('category') ? 'active' : '' }}">
                    <i class="fas fa-th"></i> All Cars
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('cars.index', ['category' => $cat]) }}" 
                       class="filter-btn {{ request('category') == $cat ? 'active' : '' }}">
                        <i class="fas fa-car"></i> {{ ucfirst($cat) }}
                    </a>
                @endforeach
                <a href="{{ route('cars.index', ['availability' => 'available']) }}" 
                   class="filter-btn {{ request('availability') == 'available' ? 'active' : '' }}">
                    <i class="fas fa-check-circle"></i> Available Only
                </a>
            </div>

            {{-- Cars Grid --}}
            @if($cars->count() > 0)
                <div class="cars-grid">
                    @foreach($cars as $car)
                        <div class="car-card">
                            <div class="car-image-wrapper">
                                @if($car->image)
                                    <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->name }}">
                                @else
                                    <img src="{{ asset('images/placeholder-car.png') }}" alt="{{ $car->name }}">
                                @endif
                                <span class="availability-badge {{ $car->available ? 'badge-available' : 'badge-unavailable' }}">
                                    {{ $car->available ? 'Available' : 'Rented' }}
                                </span>
                            </div>
                            <div class="car-info">
                                <span class="car-category">{{ ucfirst($car->category) }}</span>
                                <h3>{{ $car->name }}</h3>
                                @if($car->description)
                                    <p>{{ Str::limit($car->description, 80) }}</p>
                                @endif
                                <div class="car-specs">
                                    <div class="car-spec">
                                        <i class="fas fa-users"></i>
                                        <span>{{ $car->seats }} Seats</span>
                                    </div>
                                    <div class="car-spec">
                                        <i class="fas fa-cog"></i>
                                        <span>{{ $car->transmission }}</span>
                                    </div>
                                    @if($car->features)
                                        <div class="car-spec">
                                            <i class="fas fa-star"></i>
                                            <span>{{ Str::limit($car->features, 15) }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="car-footer">
                                    <div class="car-price">
                                        ₱{{ number_format($car->price, 0) }}<span>/day</span>
                                    </div>
                                    <a href="{{ route('cars.show', $car) }}" class="btn-view">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="no-results">
                    <i class="fas fa-car-side"></i>
                    <h2>No Cars Found</h2>
                    <p>Try adjusting your filters or check back later.</p>
                </div>
            @endif
        </div>
    </main>

    {{-- Footer --}}
    <x-footer />
</body>
</html>
