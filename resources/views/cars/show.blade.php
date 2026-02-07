<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $car->name }} - StacyGarage</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --bg: #0a0e1a;
            --fg: #f5f5f5;
            --muted: #b0b0b0;
            --accent: #a41e34;
            --accent-light: #d63447;
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
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            color: var(--accent-light);
            text-decoration: none;
            margin: 2rem 0 1rem;
            font-weight: 600;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        .car-detail {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            padding: 2rem 0 4rem;
        }
        .car-image-large {
            width: 100%;
            height: 500px;
            background: linear-gradient(135deg, rgba(26, 31, 46, 0.8), rgba(26, 31, 46, 0.5));
            border: 1px solid rgba(164, 30, 52, 0.2);
            border-radius: 1rem;
            overflow: hidden;
        }
        .car-image-large img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .car-details-info {
            display: flex;
            flex-direction: column;
        }
        .car-category {
            display: inline-block;
            padding: .5rem 1rem;
            background: rgba(164, 30, 52, 0.2);
            border: 1px solid rgba(164, 30, 52, 0.3);
            border-radius: .5rem;
            font-size: .9rem;
            color: var(--accent-light);
            margin-bottom: 1rem;
            width: fit-content;
        }
        h1 {
            font-size: 3rem;
            margin: 0 0 1rem 0;
            color: var(--fg);
        }
        .price-tag {
            font-size: 2.5rem;
            color: var(--accent-light);
            font-weight: 700;
            margin: 1rem 0;
        }
        .price-tag span {
            font-size: 1.2rem;
            color: var(--muted);
            font-weight: 400;
        }
        .availability {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            padding: .75rem 1.5rem;
            border-radius: .5rem;
            font-weight: 600;
            margin: 1rem 0;
            width: fit-content;
        }
        .available-yes {
            background: rgba(34, 197, 94, 0.2);
            border: 1px solid rgba(34, 197, 94, 0.5);
            color: #4ade80;
        }
        .available-no {
            background: rgba(239, 68, 68, 0.2);
            border: 1px solid rgba(239, 68, 68, 0.5);
            color: #f87171;
        }
        .specs-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
            margin: 2rem 0;
        }
        .spec-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: rgba(26, 31, 46, 0.5);
            border: 1px solid rgba(164, 30, 52, 0.2);
            border-radius: .5rem;
        }
        .spec-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            border-radius: .5rem;
            display: grid;
            place-items: center;
            font-size: 1.3rem;
            color: #fff;
        }
        .spec-content h4 {
            margin: 0 0 .25rem 0;
            color: var(--muted);
            font-size: .9rem;
            font-weight: 500;
        }
        .spec-content p {
            margin: 0;
            color: var(--fg);
            font-size: 1.1rem;
            font-weight: 600;
        }
        .description {
            margin: 2rem 0;
            padding: 2rem;
            background: rgba(26, 31, 46, 0.5);
            border: 1px solid rgba(164, 30, 52, 0.2);
            border-radius: 1rem;
        }
        .description h3 {
            margin: 0 0 1rem 0;
            color: var(--fg);
        }
        .description p {
            margin: 0;
            color: var(--muted);
            line-height: 1.8;
        }
        .btn-book {
            padding: 1.25rem 2rem;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            color: #fff;
            border: 0;
            border-radius: .75rem;
            cursor: pointer;
            font-weight: 700;
            font-size: 1.1rem;
            transition: transform .2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .75rem;
            margin-top: 2rem;
        }
        .btn-book:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px var(--ring);
        }
        .btn-book:disabled {
            opacity: 0.5;
            cursor: not-allowed;
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
            .car-detail {
                grid-template-columns: 1fr;
            }
            h1 {
                font-size: 2rem;
            }
            .specs-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    {{-- Header Navigation --}}
    <x-header />

    <main>
        <div class="container">
            <a href="{{ route('cars.index') }}" class="back-link">
                <i class="fas fa-arrow-left"></i> Back to All Cars
            </a>

            <div class="car-detail">
                <div class="car-image-large">
                    @if($car->image)
                        <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->name }}">
                    @else
                        <img src="{{ asset('images/placeholder-car.png') }}" alt="{{ $car->name }}">
                    @endif
                </div>

                <div class="car-details-info">
                    <span class="car-category">{{ ucfirst($car->category) }}</span>
                    <h1>{{ $car->name }}</h1>
                    
                    <div class="price-tag">
                        ₱{{ number_format($car->price, 0) }}<span>/day</span>
                    </div>

                    <div class="availability {{ $car->available ? 'available-yes' : 'available-no' }}">
                        <i class="fas fa-{{ $car->available ? 'check-circle' : 'times-circle' }}"></i>
                        {{ $car->available ? 'Available Now' : 'Currently Rented' }}
                    </div>

                    <div class="specs-grid">
                        <div class="spec-item">
                            <div class="spec-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="spec-content">
                                <h4>Passengers</h4>
                                <p>{{ $car->seats }} Seats</p>
                            </div>
                        </div>

                        <div class="spec-item">
                            <div class="spec-icon">
                                <i class="fas fa-cog"></i>
                            </div>
                            <div class="spec-content">
                                <h4>Transmission</h4>
                                <p>{{ $car->transmission }}</p>
                            </div>
                        </div>

                        @if($car->features)
                        <div class="spec-item" style="grid-column: 1 / -1;">
                            <div class="spec-icon">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="spec-content">
                                <h4>Features</h4>
                                <p>{{ $car->features }}</p>
                            </div>
                        </div>
                        @endif
                    </div>

                    @if($car->description)
                    <div class="description">
                        <h3>About This Car</h3>
                        <p>{{ $car->description }}</p>
                    </div>
                    @endif

                    @if($car->available)
                        <a href="{{ route('bookings.create', $car) }}" class="btn-book">
                            <i class="fas fa-calendar-check"></i>
                            Book This Car Now
                        </a>
                    @else
                        <button class="btn-book" disabled>
                            <i class="fas fa-times-circle"></i>
                            Currently Unavailable
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </main>

    {{-- Footer --}}
    <x-footer />
</body>
</html>
