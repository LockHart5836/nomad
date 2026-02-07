<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>DriveElite — Premium Car Rental</title>
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
        .hero {
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            gap: 3rem;
            padding: 4rem 1rem;
            position: relative;
            overflow: visible;
        }
        .hero-content {
            animation: fadeInLeft 1s ease-out;
            position: relative;
            z-index: 1;
        }
        .hero-content h1 {
            margin: 0 0 1rem 0;
            font-size: clamp(2.5rem, 5vw, 3.5rem);
            line-height: 1.1;
            color: var(--fg);
            background: linear-gradient(135deg, var(--fg), var(--accent-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: glow 3s ease-in-out infinite;
        }
        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        @keyframes glow {
            0%, 100% {
                text-shadow: 0 0 20px rgba(164, 30, 52, 0.3);
            }
            50% {
                text-shadow: 0 0 30px rgba(164, 30, 52, 0.6);
            }
        }
        .hero-content p {
            margin: 0 0 1.5rem 0;
            color: var(--muted);
            font-size: 1.1rem;
            line-height: 1.6;
            animation: fadeIn 1.5s ease-out;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        .cta {
            display: flex;
            gap: 1rem;
            align-items: center;
            margin-bottom: 2rem;
            animation: fadeInUp 2s ease-out;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .btn {
            appearance: none;
            border: 0;
            outline: 0;
            cursor: pointer;
            padding: .95rem 1.5rem;
            border-radius: .75rem;
            font-weight: 600;
            transition: transform .06s ease, box-shadow .2s ease, background .2s ease;
            text-decoration: none;
            display: inline-block;
            font-size: 1rem;
            position: relative;
            overflow: hidden;
        }
        .btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }
        .btn:hover::before {
            width: 300px;
            height: 300px;
        }
        .btn span {
            position: relative;
            z-index: 1;
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            color: #fff;
            box-shadow: 0 8px 24px var(--ring);
            animation: pulse-shadow 2s ease-in-out infinite;
        }
        .btn-primary:hover { 
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 12px 32px var(--ring);
            animation: none;
        }
        @keyframes pulse-shadow {
            0%, 100% {
                box-shadow: 0 8px 24px var(--ring);
            }
            50% {
                box-shadow: 0 8px 32px rgba(164, 30, 52, 0.5);
            }
        }
        .btn-outline {
            background: transparent;
            color: var(--fg);
            border: 2px solid var(--accent);
            position: relative;
            overflow: hidden;
        }
        .btn-outline::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(164, 30, 52, 0.3), transparent);
            transition: left 0.5s;
        }
        .btn-outline:hover::after {
            left: 100%;
        }
        .btn-outline:hover { 
            background: rgba(164, 30, 52, 0.15);
            transform: translateY(-2px) scale(1.05);
            border-color: var(--accent-light);
            box-shadow: 0 8px 24px var(--ring);
        }
        .hero-image {
            position: relative;
            height: 400px;
            overflow: visible;
            animation: float 6s ease-in-out infinite;
        }
        .hero-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            filter: drop-shadow(0 20px 40px rgba(164, 30, 52, 0.4));
            transition: transform 0.3s ease, filter 0.3s ease;
        }
        .hero-image:hover img {
            transform: scale(1.05) translateY(-10px);
            filter: drop-shadow(0 30px 60px rgba(164, 30, 52, 0.6));
        }
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            padding: 3rem 1rem;
            background: rgba(26, 31, 46, 0.3);
        }
        .feature-card {
            background: linear-gradient(135deg, rgba(26, 31, 46, 0.6), rgba(26, 31, 46, 0.3));
            border: 1px solid rgba(164, 30, 52, 0.2);
            padding: 2rem;
            border-radius: 1rem;
            transition: transform .3s ease, border-color .3s ease;
        }
        .feature-card:hover {
            transform: translateY(-4px);
            border-color: var(--accent);
        }
        .feature-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            border-radius: .75rem;
            display: grid;
            place-items: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #fff;
        }
        .feature-card h3 {
            margin: 0 0 .75rem 0;
            font-size: 1.25rem;
            color: var(--fg);
        }
        .feature-card p {
            margin: 0;
            color: var(--muted);
            line-height: 1.6;
        }
        .fleet-section {
            padding: 4rem 1rem;
        }
        .section-title {
            text-align: center;
            font-size: 2.5rem;
            margin: 0 0 3rem 0;
            color: var(--fg);
        }
        .fleet-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
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
        .car-info {
            padding: 1.5rem;
        }
        .car-info h4 {
            margin: 0 0 .5rem 0;
            font-size: 1.3rem;
            color: var(--fg);
        }
        .car-specs {
            display: flex;
            gap: 1rem;
            margin: 1rem 0;
            font-size: 0.9rem;
            color: var(--muted);
        }
        .car-price {
            font-size: 1.5rem;
            color: var(--accent-light);
            font-weight: 700;
            margin: 1rem 0 0 0;
        }
        .testimonials {
            padding: 4rem 1rem;
        }
        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        .testimonial-card {
            background: linear-gradient(135deg, rgba(26, 31, 46, 0.8), rgba(26, 31, 46, 0.5));
            border: 1px solid rgba(164, 30, 52, 0.2);
            padding: 2rem;
            border-radius: 1rem;
        }
        .stars {
            color: var(--accent-light);
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }
        .testimonial-text {
            color: var(--muted);
            margin-bottom: 1rem;
            line-height: 1.6;
            font-style: italic;
        }
        .testimonial-author {
            color: var(--fg);
            font-weight: 600;
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
        
        /* Animated Mustang */
        .animated-mustang {
            position: absolute;
            bottom: -25px;
            left: -300px;
            width: 200px;
            height: auto;
            z-index: 10;
            animation: driveMustang 12s linear infinite;
            filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.5));
        }
        .animated-mustang img {
            width: 100%;
            height: 110;
        }
        
        /* Second Car - Ford */
        .animated-ford {
            position: absolute;
            bottom: -50px;
            left: -300px;
            width: 200px;
            height: auto;
            z-index: 10;
            animation: driveFord 15s linear infinite;
            animation-delay: 6s;
            filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.5));
        }
        .animated-ford img {
            width: 100%;
            height: auto;
        }
        
        @keyframes driveMustang {
            0% {
                left: -300px;
            }
            100% {
                left: calc(100% + 100px);
            }
        }
        
        @keyframes driveFord {
            0% {
                left: -300px;
            }
            100% {
                left: calc(100% + 100px);
            }
        }
        
        /* Enhanced mobile responsiveness with comprehensive media queries */
        @media (max-width: 1024px) {
            .hero {
                gap: 2rem;
                padding: 3rem 1rem;
            }
            .hero-image {
                height: 350px;
            }
            .section-title {
                font-size: 2rem;
            }
            .fleet-grid {
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            }
        }

        @media (max-width: 768px) {
            nav { display: none; }
            
            .hero {
                grid-template-columns: 1fr;
                padding: 2rem 1rem;
                gap: 2rem;
            }
            .hero-image {
                height: 300px;
            }
            .hero-content h1 {
                font-size: clamp(1.75rem, 4vw, 2.5rem);
            }
            .hero-content p {
                font-size: 1rem;
            }
            
            .cta { 
                flex-direction: column; 
                align-items: stretch;
                gap: 0.75rem;
            }
            .btn { 
                width: 100%;
                padding: 0.85rem 1.25rem;
                font-size: 0.95rem;
            }
            
            .section-title {
                font-size: 1.75rem;
                margin-bottom: 2rem;
            }
            
            .features {
                padding: 2rem 1rem;
                gap: 1.5rem;
            }
            .feature-card {
                padding: 1.5rem;
            }
            .feature-icon {
                width: 45px;
                height: 45px;
                font-size: 1.25rem;
            }
            .feature-card h3 {
                font-size: 1.1rem;
            }
            
            .fleet-section {
                padding: 2rem 1rem;
            }
            .fleet-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            
            .car-card {
                border-radius: 0.75rem;
            }
            .car-info {
                padding: 1.25rem;
            }
            .car-info h4 {
                font-size: 1.1rem;
            }
            .car-specs {
                gap: 0.75rem;
                font-size: 0.85rem;
                flex-wrap: wrap;
            }
            .car-price {
                font-size: 1.25rem;
            }
            
            .testimonials {
                padding: 2rem 1rem;
            }
            .testimonial-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            .testimonial-card {
                padding: 1.5rem;
            }
            
            .footer-inner {
                gap: 1.5rem;
                padding: 2rem 1rem;
            }
            .footer-bottom {
                padding: 1.5rem 1rem;
                font-size: 0.9rem;
            }
            
            .animated-mustang {
                width: 120px;
                bottom: -30px;
                animation: driveMustang 15s linear infinite;
            }
            .animated-ford {
                width: 120px;
                bottom: -40px;
                animation: driveFord 18s linear infinite;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 0 1rem;
            }
            
            .nav {
                height: 56px;
            }
            .brand {
                font-size: 1.1rem;
                gap: 0.35rem;
            }
            
            .hero {
                padding: 1.5rem 1rem;
                gap: 1.5rem;
            }
            .hero-content h1 {
                font-size: clamp(1.5rem, 3.5vw, 2rem);
                margin-bottom: 0.75rem;
            }
            .hero-content p {
                font-size: 0.95rem;
                margin-bottom: 1rem;
                line-height: 1.5;
            }
            
            .hero-image {
                height: 250px;
            }
            
            .cta {
                margin-bottom: 1rem;
            }
            .btn {
                padding: 0.75rem 1rem;
                font-size: 0.9rem;
                border-radius: 0.5rem;
            }
            
            .section-title {
                font-size: 1.5rem;
                margin-bottom: 1.5rem;
            }
            
            .features {
                padding: 1.5rem 1rem;
                gap: 1rem;
            }
            .feature-card {
                padding: 1.25rem;
                border-radius: 0.75rem;
            }
            .feature-icon {
                width: 40px;
                height: 40px;
                font-size: 1.1rem;
                margin-bottom: 0.75rem;
            }
            .feature-card h3 {
                font-size: 1rem;
                margin-bottom: 0.5rem;
            }
            .feature-card p {
                font-size: 0.9rem;
            }
            
            .fleet-section {
                padding: 1.5rem 1rem;
            }
            .fleet-grid {
                gap: 1rem;
            }
            
            .car-card {
                border-radius: 0.75rem;
            }
            .car-info {
                padding: 1rem;
            }
            .car-info h4 {
                font-size: 1rem;
                margin-bottom: 0.35rem;
            }
            .car-specs {
                gap: 0.5rem;
                font-size: 0.8rem;
                margin: 0.75rem 0;
            }
            .car-price {
                font-size: 1.1rem;
                margin: 0.75rem 0 0 0;
            }
            
            .testimonials {
                padding: 1.5rem 1rem;
            }
            .testimonial-grid {
                gap: 1rem;
            }
            .testimonial-card {
                padding: 1.25rem;
                border-radius: 0.75rem;
            }
            .stars {
                font-size: 1rem;
                margin-bottom: 0.75rem;
            }
            .testimonial-text {
                font-size: 0.95rem;
                margin-bottom: 0.75rem;
            }
            .testimonial-author {
                font-size: 0.95rem;
            }
            
            .footer-inner {
                gap: 1rem;
                padding: 1.5rem 1rem;
            }
            .footer-section h4 {
                font-size: 0.95rem;
                margin-bottom: 0.75rem;
            }
            .footer-section a {
                font-size: 0.9rem;
                margin-bottom: 0.35rem;
            }
            .footer-bottom {
                padding: 1rem;
                font-size: 0.85rem;
            }
            
            .animated-mustang {
                width: 100px;
                bottom: -25px;
                animation: driveMustang 18s linear infinite;
            }
            .animated-ford {
                width: 100px;
                bottom: -35px;
                animation: driveFord 20s linear infinite;
            }
        }

        @media (max-width: 360px) {
            .container {
                padding: 0 0.75rem;
            }
            
            .hero-content h1 {
                font-size: clamp(1.35rem, 3vw, 1.75rem);
            }
            .hero-content p {
                font-size: 0.9rem;
            }
            
            .section-title {
                font-size: 1.35rem;
            }
            
            .btn {
                padding: 0.7rem 0.9rem;
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>
    {{-- Header Navigation --}}
    <x-header />

    {{-- Hero Section --}}
    <main>
        <div class="container">
            <section class="hero">
                <div class="hero-content">
                    <h1>Premium Car Rental Experience</h1>
                    <p>Discover luxury and comfort with our exclusive fleet of premium vehicles. Book your perfect ride today and enjoy unmatched service.</p>
                    <div class="cta">
                        <a class="btn btn-primary" href="/cars">Rent Now!</a>
                     
                    </div>
                </div>
                <div class="hero-image">
                    <img src="./images/red-ford.png" alt="Premium luxury car">
                </div>
                
                {{-- Animated Mustang inside hero --}}
                <div class="animated-mustang">
                    <img src="./images/mustang.png" alt="Mustang">
                </div>
            </section>
        </div>

        {{-- Features Section --}}
        <section class="features">
            <div class="container" style="grid-column: 1 / -1;">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem;">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-headset"></i></div>
                        <h3>24/7 Support</h3>
                        <p>Round-the-clock customer service to assist you anytime, anywhere during your rental period.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-shield-alt"></i></div>
                        <h3>Full Insurance</h3>
                        <p>Comprehensive coverage included with every rental for your peace of mind and protection.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-bolt"></i></div>
                        <h3>Quick Booking</h3>
                        <p>Reserve your vehicle in minutes with our streamlined online booking system.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Fleet Section --}}
        <section class="fleet-section" id="fleet">
            <div class="container">
                <h2 class="section-title">Our Premium Fleet</h2>
                <p style="text-align: center; color: var(--muted); margin-bottom: 2rem; font-size: 1.1rem;">
                    <i class="fas fa-fire" style="color: var(--accent);"></i> Top 3 Most Rented Vehicles
                </p>
                <div class="fleet-grid">
                    @forelse($topCars as $index => $car)
                        <div class="car-card">
                            @if($car->image)
                                <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->name }}" style="width: 100%; height: 250px; object-fit: cover;">
                            @else
                                <div style="width: 100%; height: 250px; background: linear-gradient(135deg, rgba(164, 30, 52, 0.2), rgba(10, 14, 26, 0.8)); display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-car" style="font-size: 4rem; color: rgba(164, 30, 52, 0.5);"></i>
                                </div>
                            @endif
                            <div class="car-info">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                                    <h4 style="margin: 0;">{{ $car->name }}</h4>
                                    @if($index === 0)
                                        <span style="background: linear-gradient(135deg, #fbbf24, #f59e0b); color: #000; padding: 0.25rem 0.75rem; border-radius: 1rem; font-size: 0.75rem; font-weight: 700;">
                                            <i class="fas fa-crown"></i> #1
                                        </span>
                                    @elseif($index === 1)
                                        <span style="background: linear-gradient(135deg, #94a3b8, #64748b); color: #fff; padding: 0.25rem 0.75rem; border-radius: 1rem; font-size: 0.75rem; font-weight: 700;">
                                            <i class="fas fa-medal"></i> #2
                                        </span>
                                    @elseif($index === 2)
                                        <span style="background: linear-gradient(135deg, #cd7f32, #8b4513); color: #fff; padding: 0.25rem 0.75rem; border-radius: 1rem; font-size: 0.75rem; font-weight: 700;">
                                            <i class="fas fa-award"></i> #3
                                        </span>
                                    @endif
                                </div>
                                <div class="car-specs">
                                    <span><i class="fas fa-users"></i> {{ $car->seats }} Seats</span>
                                    <span><i class="fas fa-cog"></i> {{ $car->transmission }}</span>
                                    <span><i class="fas fa-tag"></i> {{ $car->category }}</span>
                                </div>
                                <p style="color: var(--muted); margin: 0.5rem 0; min-height: 3rem;">
                                    {{ $car->description ?? 'Premium vehicle for your comfort and style.' }}
                                </p>
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 1rem;">
                                    <div class="car-price">${{ number_format($car->price, 2) }}/day</div>
                                    <div style="color: var(--accent); font-size: 0.85rem; font-weight: 600;">
                                        <i class="fas fa-star"></i> {{ $car->rental_count }} {{ $car->rental_count == 1 ? 'rental' : 'rentals' }}
                                    </div>
                                </div>
                                @if($car->available)
                                    <a href="{{ route('cars.show', $car->id) }}" style="display: block; margin-top: 1rem; padding: 0.75rem; background: linear-gradient(135deg, var(--accent), var(--accent-light)); color: white; text-align: center; border-radius: 0.5rem; text-decoration: none; font-weight: 600; transition: all 0.3s ease;">
                                        <i class="fas fa-calendar-check"></i> Book Now
                                    </a>
                                @else
                                    <div style="display: block; margin-top: 1rem; padding: 0.75rem; background: rgba(100, 100, 100, 0.3); color: var(--muted); text-align: center; border-radius: 0.5rem; font-weight: 600;">
                                        <i class="fas fa-ban"></i> Currently Unavailable
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="car-card">
                            <img src="./images/vios.png" alt="Luxury Sedan" style="width: 100%; height: 250px; object-fit: cover;">
                            <div class="car-info">
                                <h4>Toyota Vios</h4>
                                <div class="car-specs">
                                    <span>6 Seats</span>
                                    <span>Auto</span>
                                    <span>AC</span>
                                </div>
                                <p style="color: var(--muted); margin: 0.5rem 0;">Perfect for business travel and comfort.</p>
                                <div class="car-price">₱89/day</div>
                            </div>
                        </div>
                        <div class="car-card">
                            <img src="./images/terra.png" alt="Luxury SUV" style="width: 100%; height: 250px; object-fit: cover;">
                            <div class="car-info">
                                <h4>Nissan Terra</h4>
                                <div class="car-specs">
                                    <span>8 Seats</span>
                                    <span>Auto</span>
                                    <span>AC</span>
                                </div>
                                <p style="color: var(--muted); margin: 0.5rem 0;">Spacious and powerful for family trips.</p>
                                <div class="car-price">₱129/day</div>
                            </div>
                        </div>
                        <div class="car-card">
                            <img src="./images/ford.png" alt="Luxury SUV" style="width: 100%; height: 250px; object-fit: cover;">
                            <div class="car-info">
                                <h4>Ford Raptor</h4>
                                <div class="car-specs">
                                    <span>8 Seats</span>
                                    <span>Manual</span>
                                    <span>Twin Turbo</span>
                                </div>
                                <p style="color: var(--muted); margin: 0.5rem 0;">Experience pure driving excitement.</p>
                                <div class="car-price">₱199/day</div>
                            </div>
                        </div>
                    @endforelse
                </div>
                <div style="text-align: center; margin-top: 3rem;">
                    <a href="{{ route('cars.index') }}" class="btn btn-primary" style="display: inline-block; padding: 1rem 2.5rem; background: linear-gradient(135deg, var(--accent), var(--accent-light)); color: white; border-radius: 0.5rem; text-decoration: none; font-weight: 600; box-shadow: 0 4px 12px rgba(164, 30, 52, 0.3); transition: all 0.3s ease;">
                        <i class="fas fa-car"></i> View All Vehicles
                    </a>
                </div>
            </div>
        </section>


        {{-- Testimonials Section --}}
        <section class="testimonials" id="testimonials">
            <div class="container">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                    <h2 class="section-title" style="margin: 0;">What Our Customers Say</h2>
                    @auth
                        <a href="{{ route('testimonials.create') }}" class="btn btn-primary">
                            <i class="fas fa-comment-dots"></i> Leave a Review
                        </a>
                    @endauth
                </div>
                
                @if($testimonials->isEmpty())
                    <div style="text-align: center; padding: 3rem; color: var(--muted);">
                        <i class="fas fa-comment-slash" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.3;"></i>
                        <p style="font-size: 1.1rem;">No testimonials yet. Be the first to share your experience!</p>
                        @auth
                            <a href="{{ route('testimonials.create') }}" class="btn btn-primary" style="margin-top: 1rem;">
                                <i class="fas fa-pen"></i> Write a Testimonial
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary" style="margin-top: 1rem;">
                                <i class="fas fa-sign-in-alt"></i> Login to Leave a Review
                            </a>
                        @endauth
                    </div>
                @else
                    <div class="testimonial-grid">
                        @foreach($testimonials as $testimonial)
                            <div class="testimonial-card">
                                <div class="stars">
                                    @for($i = 0; $i < $testimonial->rating; $i++)
                                        ★
                                    @endfor
                                </div>
                                <p class="testimonial-text">"{{ $testimonial->message }}"</p>
                                <p class="testimonial-author">— {{ $testimonial->user->name }}</p>
                                <p style="font-size: 0.875rem; color: var(--muted); margin-top: 0.5rem;">
                                    {{ $testimonial->created_at->format('M d, Y') }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>

        {{-- CTA Section --}}
        <section style="padding: 4rem 1rem; text-align: center; background: linear-gradient(135deg, rgba(164, 30, 52, 0.15), rgba(26, 31, 46, 0.5));">
            <div class="container">
                <h2 style="font-size: 2rem; margin: 0 0 1rem 0; color: var(--fg);">Ready to Drive?</h2>
                <p style="color: var(--muted); margin: 0 0 2rem 0; font-size: 1.1rem;">Book your premium vehicle today and experience the difference.</p>
                <a class="btn btn-primary" href="/cars">Reserve Your Car</a>
            </div>
        </section>
    </main>

    {{-- Footer --}}
    <x-footer />
    
    {{-- Chatbot --}}
    <x-chatbot />
</body>
</html>
