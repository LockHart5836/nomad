<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Bookings - StacyGarage</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        :root {
            --bg: #0a0e1a;
            --fg: #f5f5f5;
            --muted: #b0b0b0;
            --accent: #a41e34;
            --accent-light: #d63447;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--bg);
            color: var(--fg);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .container {
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

        .footer-section p {
            margin: 0;
        }

        .footer-bottom {
            border-top: 1px solid rgba(164, 30, 52, 0.2);
            padding: 2rem 1rem;
            text-align: center;
            color: var(--muted);
        }

        a[href*="cars.index"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(164, 30, 52, 0.4);
        }

        @media (max-width: 768px) {
            div[style*="grid-template-columns: 250px 1fr"] {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
</head>
<body>
    @include('components.header')

    <main style="padding-top: 80px; min-height: 100vh; background: var(--bg);">
        <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 2rem 1rem;">
            <div style="margin-bottom: 2rem;">
                <h1 style="color: var(--fg); margin: 0; font-size: 2rem; display: flex; align-items: center; gap: 0.75rem;">
                    <i class="fas fa-calendar-check" style="color: var(--accent);"></i>
                    My Bookings
                </h1>
                <p style="color: var(--muted); margin: 0.5rem 0 0 0;">View and manage your car rental bookings</p>
            </div>

            @if($bookings->isEmpty())
                <div style="background: rgba(26, 31, 46, 0.95); border: 1px solid rgba(164, 30, 52, 0.3); border-radius: 1rem; padding: 3rem; text-align: center;">
                    <i class="fas fa-calendar-times" style="font-size: 4rem; color: rgba(164, 30, 52, 0.3); margin-bottom: 1rem;"></i>
                    <h3 style="color: var(--fg); margin: 0 0 0.5rem 0;">No Bookings Yet</h3>
                    <p style="color: var(--muted); margin: 0 0 1.5rem 0;">You haven't made any car rental bookings yet.</p>
                    <a href="{{ route('cars.index') }}" style="display: inline-block; padding: 0.75rem 2rem; background: linear-gradient(135deg, #a41e34, #d63447); color: white; border-radius: 0.5rem; text-decoration: none; font-weight: 600;">
                        <i class="fas fa-car"></i> Browse Cars
                    </a>
                </div>
            @else
                <div style="display: grid; gap: 1.5rem;">
                    @foreach($bookings as $booking)
                        <div style="background: rgba(26, 31, 46, 0.95); border: 1px solid rgba(164, 30, 52, 0.3); border-radius: 1rem; overflow: hidden; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);">
                            <div style="display: grid; grid-template-columns: 250px 1fr; gap: 1.5rem;">
                                <!-- Car Image -->
                                <div style="position: relative; overflow: hidden;">
                                    @if($booking->car && $booking->car->image)
                                        <img src="{{ asset('storage/' . $booking->car->image) }}" alt="{{ $booking->car->name }}"
                                             style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        <div style="width: 100%; height: 100%; background: linear-gradient(135deg, rgba(164, 30, 52, 0.2), rgba(10, 14, 26, 0.8)); display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-car" style="font-size: 3rem; color: rgba(164, 30, 52, 0.5);"></i>
                                        </div>
                                    @endif
                                </div>

                                <!-- Booking Details -->
                                <div style="padding: 1.5rem;">
                                    <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
                                        <div>
                                            <h3 style="color: var(--fg); margin: 0 0 0.5rem 0; font-size: 1.5rem;">
                                                @if($booking->car)
                                                    {{ $booking->car->name }}
                                                @else
                                                    Booking #{{ $booking->id }}
                                                @endif
                                            </h3>
                                            <p style="color: var(--muted); margin: 0; font-size: 0.9rem;">
                                                <i class="fas fa-calendar"></i> Booked on {{ $booking->created_at->format('M d, Y') }}
                                            </p>
                                        </div>
                                        @if($booking->status === 'pending')
                                            <span style="background: rgba(251, 191, 36, 0.1); color: #fbbf24; padding: 0.5rem 1rem; border-radius: 0.5rem; font-size: 0.9rem; font-weight: 600;">
                                                <i class="fas fa-clock"></i> Pending
                                            </span>
                                        @elseif($booking->status === 'confirmed')
                                            <span style="background: rgba(16, 185, 129, 0.1); color: #10b981; padding: 0.5rem 1rem; border-radius: 0.5rem; font-size: 0.9rem; font-weight: 600;">
                                                <i class="fas fa-check-circle"></i> Confirmed
                                            </span>
                                        @elseif($booking->status === 'completed')
                                            <span style="background: rgba(59, 130, 246, 0.1); color: #3b82f6; padding: 0.5rem 1rem; border-radius: 0.5rem; font-size: 0.9rem; font-weight: 600;">
                                                <i class="fas fa-flag-checkered"></i> Completed
                                            </span>
                                        @else
                                            <span style="background: rgba(239, 68, 68, 0.1); color: #ef4444; padding: 0.5rem 1rem; border-radius: 0.5rem; font-size: 0.9rem; font-weight: 600;">
                                                <i class="fas fa-times-circle"></i> {{ ucfirst($booking->status) }}
                                            </span>
                                        @endif
                                    </div>

                                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 1rem;">
                                        <div style="background: rgba(10, 14, 26, 0.6); padding: 1rem; border-radius: 0.5rem; border-left: 3px solid var(--accent);">
                                            <p style="color: var(--muted); margin: 0 0 0.25rem 0; font-size: 0.85rem;">
                                                <i class="fas fa-calendar-day"></i> Pickup Date
                                            </p>
                                            <p style="color: var(--fg); margin: 0; font-weight: 600;">
                                                {{ $booking->start_date->format('M d, Y') }}
                                            </p>
                                        </div>

                                        <div style="background: rgba(10, 14, 26, 0.6); padding: 1rem; border-radius: 0.5rem; border-left: 3px solid var(--accent);">
                                            <p style="color: var(--muted); margin: 0 0 0.25rem 0; font-size: 0.85rem;">
                                                <i class="fas fa-calendar-check"></i> Return Date
                                            </p>
                                            <p style="color: var(--fg); margin: 0; font-weight: 600;">
                                                {{ $booking->end_date->format('M d, Y') }}
                                            </p>
                                        </div>

                                        <div style="background: rgba(10, 14, 26, 0.6); padding: 1rem; border-radius: 0.5rem; border-left: 3px solid var(--accent);">
                                            <p style="color: var(--muted); margin: 0 0 0.25rem 0; font-size: 0.85rem;">
                                                <i class="fas fa-clock"></i> Duration
                                            </p>
                                            <p style="color: var(--fg); margin: 0; font-weight: 600;">
                                                {{ $booking->total_days }} {{ $booking->total_days == 1 ? 'Day' : 'Days' }}
                                            </p>
                                        </div>

                                        <div style="background: rgba(10, 14, 26, 0.6); padding: 1rem; border-radius: 0.5rem; border-left: 3px solid var(--accent);">
                                            <p style="color: var(--muted); margin: 0 0 0.25rem 0; font-size: 0.85rem;">
                                                <i class="fas fa-dollar-sign"></i> Total Price
                                            </p>
                                            <p style="color: var(--accent); margin: 0; font-weight: 700; font-size: 1.1rem;">
                                                ${{ number_format($booking->total_price, 2) }}
                                            </p>
                                        </div>
                                    </div>

                                    @if($booking->notes)
                                        <div style="background: rgba(59, 130, 246, 0.1); border-left: 3px solid #3b82f6; padding: 0.75rem; border-radius: 0.5rem; margin-top: 1rem;">
                                            <p style="color: var(--muted); margin: 0 0 0.25rem 0; font-size: 0.85rem;">
                                                <i class="fas fa-sticky-note"></i> Notes:
                                            </p>
                                            <p style="color: var(--fg); margin: 0; font-size: 0.9rem;">{{ $booking->notes }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($bookings->hasPages())
                    <div style="margin-top: 2rem;">
                        {{ $bookings->links() }}
                    </div>
                @endif
            @endif

            <!-- Browse More Cars Button -->
            <div style="margin-top: 2rem; text-align: center;">
                <a href="{{ route('cars.index') }}" style="display: inline-block; padding: 0.875rem 2rem; background: linear-gradient(135deg, #a41e34, #d63447); color: white; border-radius: 0.5rem; text-decoration: none; font-weight: 600; box-shadow: 0 4px 12px rgba(164, 30, 52, 0.3); transition: all 0.3s ease;">
                    <i class="fas fa-car"></i> Browse More Cars
                </a>
            </div>
        </div>
    </main>

    @include('components.footer')
    
    <x-chatbot />
</body>
</html>
