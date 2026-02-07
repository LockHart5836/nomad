<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book {{ $car->name }} - StacyGarage</title>
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
        .booking-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            padding: 2rem 0 4rem;
        }
        .car-summary {
            background: linear-gradient(135deg, rgba(26, 31, 46, 0.8), rgba(26, 31, 46, 0.5));
            border: 1px solid rgba(164, 30, 52, 0.2);
            border-radius: 1rem;
            padding: 2rem;
            height: fit-content;
        }
        .car-summary h2 {
            margin: 0 0 1.5rem 0;
            color: var(--fg);
            font-size: 1.8rem;
        }
        .car-summary-image {
            width: 100%;
            height: 250px;
            border-radius: .75rem;
            overflow: hidden;
            margin-bottom: 1.5rem;
        }
        .car-summary-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .car-detail-item {
            display: flex;
            justify-content: space-between;
            padding: .75rem 0;
            border-bottom: 1px solid rgba(164, 30, 52, 0.1);
        }
        .car-detail-item:last-child {
            border-bottom: none;
        }
        .car-detail-label {
            color: var(--muted);
        }
        .car-detail-value {
            color: var(--fg);
            font-weight: 600;
        }
        .price-highlight {
            color: var(--accent-light);
            font-size: 1.5rem;
        }
        .booking-form {
            background: linear-gradient(135deg, rgba(26, 31, 46, 0.8), rgba(26, 31, 46, 0.5));
            border: 1px solid rgba(164, 30, 52, 0.2);
            border-radius: 1rem;
            padding: 2rem;
        }
        .booking-form h2 {
            margin: 0 0 1.5rem 0;
            color: var(--fg);
            font-size: 1.8rem;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        label {
            display: block;
            margin-bottom: .5rem;
            font-weight: 600;
            color: var(--fg);
            font-size: .95rem;
        }
        .required {
            color: var(--accent-light);
        }
        input, textarea {
            width: 100%;
            padding: .875rem;
            border: 1px solid rgba(164, 30, 52, 0.3);
            background: rgba(10, 14, 26, 0.6);
            color: var(--fg);
            border-radius: .5rem;
            font-size: 1rem;
            font-family: inherit;
            transition: border-color .2s ease;
        }
        input:focus, textarea:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--ring);
        }
        textarea {
            resize: vertical;
            min-height: 100px;
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        .error {
            color: var(--accent-light);
            font-size: .875rem;
            margin-top: .5rem;
        }
        .help-text {
            font-size: .875rem;
            color: var(--muted);
            margin-top: .5rem;
        }
        .btn {
            padding: 1rem 2rem;
            border: 0;
            border-radius: .75rem;
            cursor: pointer;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all .2s ease;
            display: inline-flex;
            align-items: center;
            gap: .75rem;
            text-decoration: none;
        }
        .btn-primary {
            width: 100%;
            justify-content: center;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            color: #fff;
            box-shadow: 0 8px 24px var(--ring);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px var(--ring);
        }
        .alert {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: .5rem;
            display: flex;
            align-items: center;
            gap: .75rem;
        }
        .alert-error {
            background: rgba(239, 68, 68, 0.2);
            border: 1px solid rgba(239, 68, 68, 0.5);
            color: #f87171;
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
            .booking-container {
                grid-template-columns: 1fr;
            }
            .form-row {
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
            <a href="{{ route('cars.show', $car) }}" class="back-link">
                <i class="fas fa-arrow-left"></i> Back to Car Details
            </a>

            @if(session('error'))
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                </div>
            @endif

            <div class="booking-container">
                {{-- Car Summary --}}
                <div class="car-summary">
                    <h2><i class="fas fa-car"></i> Booking Summary</h2>
                    
                    <div class="car-summary-image">
                        @if($car->image)
                            <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->name }}">
                        @else
                            <img src="{{ asset('images/placeholder-car.png') }}" alt="{{ $car->name }}">
                        @endif
                    </div>

                    <div class="car-detail-item">
                        <span class="car-detail-label">Vehicle</span>
                        <span class="car-detail-value">{{ $car->name }}</span>
                    </div>
                    <div class="car-detail-item">
                        <span class="car-detail-label">Category</span>
                        <span class="car-detail-value">{{ ucfirst($car->category) }}</span>
                    </div>
                    <div class="car-detail-item">
                        <span class="car-detail-label">Transmission</span>
                        <span class="car-detail-value">{{ $car->transmission }}</span>
                    </div>
                    <div class="car-detail-item">
                        <span class="car-detail-label">Seats</span>
                        <span class="car-detail-value">{{ $car->seats }} Passengers</span>
                    </div>
                    <div class="car-detail-item">
                        <span class="car-detail-label">Price per Day</span>
                        <span class="car-detail-value price-highlight">₱{{ number_format($car->price, 2) }}</span>
                    </div>
                </div>

                {{-- Booking Form --}}
                <div class="booking-form">
                    <h2><i class="fas fa-calendar-check"></i> Your Information</h2>

                    <form action="{{ route('bookings.store', $car) }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="customer_name">Full Name <span class="required">*</span></label>
                            <input type="text" id="customer_name" name="customer_name" value="{{ old('customer_name', Auth::check() ? Auth::user()->name : '') }}" required readonly style="background: rgba(10, 14, 26, 0.4); cursor: not-allowed;">
                            @error('customer_name')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="customer_email">Email Address <span class="required">*</span></label>
                            <input type="email" id="customer_email" name="customer_email" value="{{ old('customer_email', Auth::check() ? Auth::user()->email : '') }}" required readonly style="background: rgba(10, 14, 26, 0.4); cursor: not-allowed;">
                            @error('customer_email')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="customer_phone">Phone Number <span class="required">*</span></label>
                            <input type="tel" id="customer_phone" name="customer_phone" value="{{ old('customer_phone', Auth::check() ? Auth::user()->phone : '') }}" required>
                            @error('customer_phone')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="start_date">Start Date <span class="required">*</span></label>
                                <input type="date" id="start_date" name="start_date" value="{{ old('start_date', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}" required>
                                @error('start_date')
                                    <p class="error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="end_date">End Date <span class="required">*</span></label>
                                <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                                @error('end_date')
                                    <p class="error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="notes">Additional Notes (Optional)</label>
                            <textarea id="notes" name="notes" placeholder="Any special requests or requirements...">{{ old('notes') }}</textarea>
                            @error('notes')
                                <p class="error">{{ $message }}</p>
                            @enderror
                            <p class="help-text">Maximum 500 characters</p>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-check-circle"></i> Submit Booking Request
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    {{-- Footer --}}
    <x-footer />
</body>
</html>
