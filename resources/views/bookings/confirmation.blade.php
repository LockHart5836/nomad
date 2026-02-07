<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking Confirmation - StacyGarage</title>
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
            max-width: 800px;
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
        .confirmation-container {
            padding: 3rem 0;
        }
        .success-icon {
            text-align: center;
            margin-bottom: 2rem;
        }
        .success-icon i {
            font-size: 5rem;
            color: #4ade80;
        }
        .confirmation-card {
            background: linear-gradient(135deg, rgba(26, 31, 46, 0.8), rgba(26, 31, 46, 0.5));
            border: 1px solid rgba(164, 30, 52, 0.2);
            border-radius: 1rem;
            padding: 2.5rem;
        }
        .confirmation-card h1 {
            margin: 0 0 .5rem 0;
            color: var(--fg);
            font-size: 2rem;
            text-align: center;
        }
        .confirmation-card p.lead {
            text-align: center;
            color: var(--muted);
            margin: 0 0 2rem 0;
            font-size: 1.1rem;
        }
        .booking-id {
            text-align: center;
            padding: 1rem;
            background: rgba(164, 30, 52, 0.1);
            border: 1px solid rgba(164, 30, 52, 0.3);
            border-radius: .5rem;
            margin-bottom: 2rem;
        }
        .booking-id strong {
            color: var(--accent-light);
            font-size: 1.3rem;
        }
        .detail-section {
            margin: 2rem 0;
        }
        .detail-section h3 {
            margin: 0 0 1rem 0;
            color: var(--fg);
            font-size: 1.2rem;
            border-bottom: 2px solid rgba(164, 30, 52, 0.3);
            padding-bottom: .5rem;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: .75rem 0;
            border-bottom: 1px solid rgba(164, 30, 52, 0.1);
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-label {
            color: var(--muted);
        }
        .detail-value {
            color: var(--fg);
            font-weight: 600;
        }
        .total-price {
            background: rgba(164, 30, 52, 0.2);
            border: 1px solid rgba(164, 30, 52, 0.3);
            border-radius: .5rem;
            padding: 1.5rem;
            margin: 2rem 0;
            text-align: center;
        }
        .total-price .label {
            color: var(--muted);
            font-size: .95rem;
            margin-bottom: .5rem;
        }
        .total-price .amount {
            color: var(--accent-light);
            font-size: 2.5rem;
            font-weight: 700;
        }
        .status-badge {
            display: inline-block;
            padding: .5rem 1rem;
            border-radius: .5rem;
            font-weight: 600;
            font-size: .9rem;
        }
        .status-pending {
            background: rgba(251, 191, 36, 0.2);
            border: 1px solid rgba(251, 191, 36, 0.5);
            color: #fbbf24;
        }
        .info-box {
            background: rgba(59, 130, 246, 0.1);
            border: 1px solid rgba(59, 130, 246, 0.3);
            border-radius: .5rem;
            padding: 1.5rem;
            margin: 2rem 0;
        }
        .info-box h4 {
            margin: 0 0 1rem 0;
            color: var(--fg);
            display: flex;
            align-items: center;
            gap: .5rem;
        }
        .info-box ul {
            margin: 0;
            padding-left: 1.5rem;
            color: var(--muted);
            line-height: 1.8;
        }
        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }
        .btn {
            flex: 1;
            padding: 1rem 2rem;
            border: 0;
            border-radius: .75rem;
            cursor: pointer;
            font-weight: 700;
            font-size: 1rem;
            transition: all .2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .75rem;
            text-decoration: none;
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            color: #fff;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px var(--ring);
        }
        .btn-secondary {
            background: rgba(26, 31, 46, 0.8);
            border: 1px solid rgba(164, 30, 52, 0.3);
            color: var(--fg);
        }
        .btn-secondary:hover {
            background: rgba(26, 31, 46, 1);
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
    </style>
</head>
<body>
    {{-- Header Navigation --}}
    <x-header />

    <main>
        <div class="container">
            <div class="confirmation-container">
                <div class="success-icon">
                    <i class="fas fa-check-circle"></i>
                </div>

                <div class="confirmation-card">
                    <h1>Booking Confirmed!</h1>
                    <p class="lead">Thank you for your booking request. We'll contact you shortly.</p>

                    <div class="booking-id">
                        Booking Reference: <strong>#{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</strong>
                    </div>

                    {{-- Customer Details --}}
                    <div class="detail-section">
                        <h3><i class="fas fa-user"></i> Customer Information</h3>
                        <div class="detail-row">
                            <span class="detail-label">Name</span>
                            <span class="detail-value">{{ $booking->customer_name }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Email</span>
                            <span class="detail-value">{{ $booking->customer_email }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Phone</span>
                            <span class="detail-value">{{ $booking->customer_phone }}</span>
                        </div>
                    </div>

                    {{-- Vehicle Details --}}
                    <div class="detail-section">
                        <h3><i class="fas fa-car"></i> Vehicle Information</h3>
                        <div class="detail-row">
                            <span class="detail-label">Vehicle</span>
                            <span class="detail-value">{{ $booking->car->name }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Category</span>
                            <span class="detail-value">{{ ucfirst($booking->car->category) }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Transmission</span>
                            <span class="detail-value">{{ $booking->car->transmission }}</span>
                        </div>
                    </div>

                    {{-- Booking Details --}}
                    <div class="detail-section">
                        <h3><i class="fas fa-calendar-alt"></i> Booking Details</h3>
                        <div class="detail-row">
                            <span class="detail-label">Start Date</span>
                            <span class="detail-value">{{ $booking->start_date->format('F d, Y') }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">End Date</span>
                            <span class="detail-value">{{ $booking->end_date->format('F d, Y') }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Duration</span>
                            <span class="detail-value">{{ $booking->total_days }} {{ $booking->total_days == 1 ? 'Day' : 'Days' }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Status</span>
                            <span class="status-badge status-pending">{{ ucfirst($booking->status) }}</span>
                        </div>
                        @if($booking->notes)
                        <div class="detail-row">
                            <span class="detail-label">Notes</span>
                            <span class="detail-value">{{ $booking->notes }}</span>
                        </div>
                        @endif
                    </div>

                    {{-- Total Price --}}
                    <div class="total-price">
                        <div class="label">Total Amount</div>
                        <div class="amount">₱{{ number_format($booking->total_price, 2) }}</div>
                        <div class="label" style="margin-top: .5rem;">({{ $booking->total_days }} days × ₱{{ number_format($booking->car->price, 2) }}/day)</div>
                    </div>

                    {{-- Important Information --}}
                    <div class="info-box">
                        <h4><i class="fas fa-info-circle"></i> What's Next?</h4>
                        <ul>
                            <li>You'll receive a confirmation email at <strong>{{ $booking->customer_email }}</strong></li>
                            <li>Our team will contact you within 24 hours to confirm your booking</li>
                            <li>Please have your valid driver's license and ID ready</li>
                            <li>Payment can be made upon vehicle pickup</li>
                            <li>Save your booking reference: <strong>#{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</strong></li>
                        </ul>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="action-buttons">
                        <a href="{{ route('cars.index') }}" class="btn btn-secondary">
                            <i class="fas fa-car"></i> Browse More Cars
                        </a>
                        <a href="/" class="btn btn-primary">
                            <i class="fas fa-home"></i> Back to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- Footer --}}
    <x-footer />
</body>
</html>
