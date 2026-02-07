<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>About Us — StacyGarage</title>
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
            color: var(--fg);
            font-size: 1.3rem;
        }
        .brand-badge {
            width: 32px; height: 32px;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            display: grid; place-items: center;
            color: #fff;
            font-size: 1rem; font-weight: 900;
            box-shadow: 0 6px 20px var(--ring);
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
        .page-hero {
            text-align: center;
            padding: 4rem 1rem 3rem;
            background: linear-gradient(135deg, rgba(164, 30, 52, 0.1), transparent);
        }
        .page-hero h1 {
            margin: 0 0 1rem 0;
            font-size: clamp(2.5rem, 5vw, 4rem);
            line-height: 1.1;
        }
        .page-hero p {
            margin: 0 auto;
            max-width: 60ch;
            color: var(--muted);
            font-size: 1.2rem;
            line-height: 1.6;
        }
        .content-section {
            padding: 3rem 1rem;
        }
        .content-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
            margin-bottom: 4rem;
        }
        .content-text {
            background: linear-gradient(135deg, rgba(26, 31, 46, 0.8), rgba(26, 31, 46, 0.5));
            border: 1px solid rgba(164, 30, 52, 0.2);
            padding: 2.5rem;
            border-radius: 1rem;
            transition: all .3s ease;
            position: relative;
            overflow: hidden;
        }
        .content-text::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--accent), var(--accent-light));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform .3s ease;
        }
        .content-text:hover::before {
            transform: scaleX(1);
        }
        .content-text:hover {
            transform: translateY(-8px);
            border-color: var(--accent);
            box-shadow: 0 12px 40px rgba(164, 30, 52, 0.3);
        }
        .content-text h2 {
            font-size: 2rem;
            margin: 0 0 1rem 0;
            color: var(--fg);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .content-text h2::before {
            content: '';
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            border-radius: 50%;
            display: grid;
            place-items: center;
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: 1.1rem;
            color: #fff;
            flex-shrink: 0;
            transition: transform .3s ease;
        }
        .content-text:first-child h2::before {
            content: '\f02d'; /* fa-book */
        }
        .content-text:last-child h2::before {
            content: '\f140'; /* fa-rocket */
        }
        .content-text:hover h2::before {
            transform: rotate(360deg) scale(1.1);
        }
        .content-text p {
            color: var(--muted);
            line-height: 1.7;
            margin-bottom: 1rem;
        }
        .content-text p:last-child {
            margin-bottom: 0;
        }
        .content-image {
            height: 350px;
            background: linear-gradient(135deg, rgba(164, 30, 52, 0.1), rgba(26, 31, 46, 0.8));
            border-radius: 1rem;
            display: grid;
            place-items: center;
            border: 1px solid rgba(164, 30, 52, 0.3);
            transition: all .3s ease;
            position: relative;
            overflow: hidden;
        }
        .content-image::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(164, 30, 52, 0.2), transparent);
            z-index: 1;
            transition: opacity .3s ease;
        }
        .content-image:hover::before {
            opacity: 0.5;
        }
        .content-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .3s ease;
        }
        .content-image:hover img {
            transform: scale(1.05);
        }
        .stats-section {
            background: rgba(26, 31, 46, 0.3);
            padding: 4rem 1rem;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            text-align: center;
        }
        .stat-card {
            padding: 2rem;
            transition: transform .3s ease;
        }
        .stat-card:hover {
            transform: translateY(-8px);
        }
        .stat-card:hover .stat-number {
            color: var(--accent);
            text-shadow: 0 0 20px var(--ring);
        }
        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            color: var(--accent-light);
            margin: 0 0 0.5rem 0;
        }
        .stat-label {
            color: var(--muted);
            font-size: 1.1rem;
        }
        .values-section {
            padding: 4rem 1rem;
        }
        .section-title {
            text-align: center;
            font-size: 2.5rem;
            margin: 0 0 3rem 0;
            color: var(--fg);
        }
        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }
        .value-card {
            background: linear-gradient(135deg, rgba(26, 31, 46, 0.8), rgba(26, 31, 46, 0.5));
            border: 1px solid rgba(164, 30, 52, 0.2);
            padding: 2rem;
            border-radius: 1rem;
            text-align: center;
            transition: transform .3s ease, border-color .3s ease;
        }
        .value-card:hover {
            transform: translateY(-4px);
            border-color: var(--accent);
        }
        .value-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            border-radius: 50%;
            display: grid;
            place-items: center;
            font-size: 2rem;
            margin: 0 auto 1rem;
            transition: all .3s ease;
            box-shadow: 0 4px 15px var(--ring);
        }
        .value-card:hover .value-icon {
            transform: rotate(360deg) scale(1.1);
            box-shadow: 0 8px 25px var(--ring);
        }
        .value-card h3 {
            margin: 0 0 1rem 0;
            font-size: 1.5rem;
            color: var(--fg);
        }
        .value-card p {
            margin: 0;
            color: var(--muted);
            line-height: 1.6;
        }
        .team-section {
            padding: 4rem 1rem;
            background: rgba(26, 31, 46, 0.2);
        }
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }
        .team-card {
            background: linear-gradient(135deg, rgba(26, 31, 46, 0.8), rgba(26, 31, 46, 0.5));
            border: 1px solid rgba(164, 30, 52, 0.2);
            border-radius: 1rem;
            overflow: hidden;
            text-align: center;
            transition: transform .3s ease;
        }
        .team-card:hover {
            transform: translateY(-6px);
        }
        .team-avatar {
            width: 100%;
            height: 250px;
            background: linear-gradient(135deg, rgba(164, 30, 52, 0.2), rgba(26, 31, 46, 0.8));
            display: grid;
            place-items: center;
            font-size: 5rem;
            color: var(--accent-light);
            transition: all .3s ease;
        }
        .team-card:hover .team-avatar {
            background: linear-gradient(135deg, var(--accent-dark), var(--accent));
            color: #fff;
        }
        .team-card:hover .team-avatar i {
            transform: scale(1.15);
        }
        .team-info {
            padding: 1.5rem;
        }
        .team-info h4 {
            margin: 0 0 0.5rem 0;
            font-size: 1.3rem;
            color: var(--fg);
        }
        .team-role {
            color: var(--accent-light);
            font-size: 0.95rem;
            margin-bottom: 0.75rem;
        }
        .team-bio {
            color: var(--muted);
            font-size: 0.9rem;
            line-height: 1.5;
        }
        .cta-section {
            padding: 4rem 1rem;
            text-align: center;
            background: linear-gradient(135deg, rgba(164, 30, 52, 0.15), rgba(26, 31, 46, 0.5));
        }
        .cta-section h2 {
            font-size: 2.5rem;
            margin: 0 0 1rem 0;
            color: var(--fg);
        }
        .cta-section p {
            color: var(--muted);
            margin: 0 0 2rem 0;
            font-size: 1.2rem;
        }
        .btn {
            appearance: none;
            border: 0;
            outline: 0;
            cursor: pointer;
            padding: .95rem 1.5rem;
            border-radius: .75rem;
            font-weight: 600;
            transition: transform .06s ease, box-shadow .2s ease;
            text-decoration: none;
            display: inline-block;
            font-size: 1rem;
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            color: #fff;
            box-shadow: 0 8px 24px var(--ring);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px var(--ring);
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
        
        /* Comprehensive Mobile Responsive Media Queries */
        @media (max-width: 1024px) {
            .container {
                padding: 0 1rem;
            }
            .page-hero h1 {
                font-size: clamp(2rem, 4vw, 3rem);
            }
            .page-hero p {
                font-size: 1.1rem;
            }
            .content-grid {
                gap: 2rem;
            }
            .content-image {
                height: 300px;
            }
            .section-title {
                font-size: 2.25rem;
            }
            .stats-section {
                padding: 3rem 1rem;
            }
        }
        
        @media (max-width: 768px) {
            nav { display: none; }
            
            .page-hero {
                padding: 3rem 1rem 2rem;
            }
            .page-hero h1 {
                font-size: clamp(1.75rem, 4vw, 2.5rem);
                margin-bottom: 0.75rem;
            }
            .page-hero p {
                font-size: 1rem;
                line-height: 1.5;
            }
            
            .content-section {
                padding: 2rem 1rem;
            }
            .content-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
                margin-bottom: 2.5rem;
            }
            .content-grid.reverse {
                direction: rtl;
            }
            .content-grid.reverse > * {
                direction: ltr;
            }
            
            .content-text h2 {
                font-size: 1.5rem;
                margin-bottom: 0.85rem;
            }
            .content-text h2::before {
                width: 35px;
                height: 35px;
                font-size: 1rem;
            }
            .content-text {
                padding: 1.75rem;
            }
            .content-text p {
                font-size: 0.95rem;
                margin-bottom: 0.85rem;
            }
            
            .content-image {
                height: 280px;
                border-radius: 0.75rem;
            }
            
            .stats-section {
                padding: 2.5rem 1rem;
            }
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.5rem;
            }
            .stat-card {
                padding: 1.5rem;
            }
            .stat-number {
                font-size: 2.5rem;
                margin-bottom: 0.35rem;
            }
            .stat-label {
                font-size: 1rem;
            }
            
            .values-section {
                padding: 2.5rem 1rem;
            }
            .section-title {
                font-size: 1.85rem;
                margin-bottom: 2rem;
            }
            .values-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            .value-card {
                padding: 1.75rem;
            }
            .value-icon {
                width: 60px;
                height: 60px;
                font-size: 1.75rem;
                margin-bottom: 0.85rem;
            }
            .value-card h3 {
                font-size: 1.35rem;
                margin-bottom: 0.85rem;
            }
            .value-card p {
                font-size: 0.95rem;
            }
            
            .team-section {
                padding: 2.5rem 1rem;
            }
            .team-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            .team-avatar {
                height: 220px;
                font-size: 4rem;
            }
            .team-info {
                padding: 1.25rem;
            }
            .team-info h4 {
                font-size: 1.15rem;
            }
            .team-role {
                font-size: 0.9rem;
            }
            .team-bio {
                font-size: 0.85rem;
            }
            
            .cta-section {
                padding: 2.5rem 1rem;
            }
            .cta-section h2 {
                font-size: 2rem;
                margin-bottom: 0.85rem;
            }
            .cta-section p {
                font-size: 1.05rem;
                margin-bottom: 1.5rem;
            }
            .btn {
                padding: 0.85rem 1.35rem;
                font-size: 0.95rem;
            }
        }
        
        @media (max-width: 480px) {
            .container {
                padding: 0 0.85rem;
            }
            
            .page-hero {
                padding: 2rem 0.85rem 1.5rem;
            }
            .page-hero h1 {
                font-size: clamp(1.5rem, 3.5vw, 2rem);
                margin-bottom: 0.65rem;
            }
            .page-hero p {
                font-size: 0.9rem;
                line-height: 1.5;
            }
            
            .content-section {
                padding: 1.5rem 0.85rem;
            }
            .content-grid {
                gap: 1.5rem;
                margin-bottom: 2rem;
            }
            
            .content-text h2 {
                font-size: 1.3rem;
                margin-bottom: 0.75rem;
            }
            .content-text h2::before {
                width: 32px;
                height: 32px;
                font-size: 0.95rem;
            }
            .content-text {
                padding: 1.5rem;
            }
            .content-text p {
                font-size: 0.9rem;
                margin-bottom: 0.75rem;
                line-height: 1.6;
            }
            
            .content-image {
                height: 240px;
                border-radius: 0.65rem;
            }
            
            .stats-section {
                padding: 2rem 0.85rem;
            }
            .stats-grid {
                gap: 1rem;
            }
            .stat-card {
                padding: 1.25rem 0.85rem;
            }
            .stat-number {
                font-size: 2rem;
                margin-bottom: 0.25rem;
            }
            .stat-label {
                font-size: 0.9rem;
            }
            
            .values-section {
                padding: 2rem 0.85rem;
            }
            .section-title {
                font-size: 1.6rem;
                margin-bottom: 1.5rem;
            }
            .values-grid {
                gap: 1.25rem;
            }
            .value-card {
                padding: 1.5rem;
                border-radius: 0.75rem;
            }
            .value-icon {
                width: 55px;
                height: 55px;
                font-size: 1.6rem;
                margin-bottom: 0.75rem;
            }
            .value-card h3 {
                font-size: 1.2rem;
                margin-bottom: 0.75rem;
            }
            .value-card p {
                font-size: 0.9rem;
                line-height: 1.5;
            }
            
            .team-section {
                padding: 2rem 0.85rem;
            }
            .team-grid {
                gap: 1.25rem;
            }
            .team-card {
                border-radius: 0.75rem;
            }
            .team-avatar {
                height: 200px;
                font-size: 3.5rem;
            }
            .team-info {
                padding: 1.15rem;
            }
            .team-info h4 {
                font-size: 1.1rem;
                margin-bottom: 0.35rem;
            }
            .team-role {
                font-size: 0.85rem;
                margin-bottom: 0.65rem;
            }
            .team-bio {
                font-size: 0.8rem;
                line-height: 1.5;
            }
            
            .cta-section {
                padding: 2rem 0.85rem;
            }
            .cta-section h2 {
                font-size: 1.75rem;
                margin-bottom: 0.75rem;
            }
            .cta-section p {
                font-size: 0.95rem;
                margin-bottom: 1.25rem;
                line-height: 1.5;
            }
            .btn {
                padding: 0.8rem 1.2rem;
                font-size: 0.9rem;
                border-radius: 0.6rem;
            }
        }
        
        @media (max-width: 360px) {
            .container {
                padding: 0 0.75rem;
            }
            
            .page-hero {
                padding: 1.5rem 0.75rem 1.25rem;
            }
            .page-hero h1 {
                font-size: 1.4rem;
                margin-bottom: 0.5rem;
            }
            .page-hero p {
                font-size: 0.85rem;
            }
            
            .content-section {
                padding: 1.25rem 0.75rem;
            }
            .content-grid {
                gap: 1.25rem;
                margin-bottom: 1.75rem;
            }
            
            .content-text h2 {
                font-size: 1.2rem;
                margin-bottom: 0.65rem;
            }
            .content-text h2::before {
                width: 30px;
                height: 30px;
                font-size: 0.9rem;
            }
            .content-text {
                padding: 1.25rem;
            }
            .content-text p {
                font-size: 0.85rem;
                margin-bottom: 0.65rem;
            }
            
            .content-image {
                height: 220px;
            }
            
            .stats-section {
                padding: 1.75rem 0.75rem;
            }
            .stats-grid {
                gap: 0.85rem;
                grid-template-columns: repeat(2, 1fr);
            }
            .stat-card {
                padding: 1rem 0.75rem;
            }
            .stat-number {
                font-size: 1.75rem;
            }
            .stat-label {
                font-size: 0.85rem;
            }
            
            .values-section {
                padding: 1.75rem 0.75rem;
            }
            .section-title {
                font-size: 1.45rem;
                margin-bottom: 1.25rem;
            }
            .values-grid {
                gap: 1rem;
            }
            .value-card {
                padding: 1.25rem;
            }
            .value-icon {
                width: 50px;
                height: 50px;
                font-size: 1.5rem;
                margin-bottom: 0.65rem;
            }
            .value-card h3 {
                font-size: 1.1rem;
                margin-bottom: 0.65rem;
            }
            .value-card p {
                font-size: 0.85rem;
            }
            
            .team-section {
                padding: 1.75rem 0.75rem;
            }
            .team-grid {
                gap: 1rem;
            }
            .team-avatar {
                height: 180px;
                font-size: 3rem;
            }
            .team-info {
                padding: 1rem;
            }
            .team-info h4 {
                font-size: 1rem;
            }
            .team-role {
                font-size: 0.8rem;
            }
            .team-bio {
                font-size: 0.75rem;
            }
            
            .cta-section {
                padding: 1.75rem 0.75rem;
            }
            .cta-section h2 {
                font-size: 1.6rem;
                margin-bottom: 0.65rem;
            }
            .cta-section p {
                font-size: 0.9rem;
                margin-bottom: 1rem;
            }
            .btn {
                padding: 0.75rem 1.1rem;
                font-size: 0.85rem;
            }
        }
        
        /* Scroll animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .content-text, .content-image, .value-card, .stat-card {
            animation: fadeInUp 0.6s ease-out forwards;
            opacity: 0;
        }
        
        .content-text { animation-delay: 0.1s; }
        .content-image { animation-delay: 0.3s; }
        .value-card:nth-child(1) { animation-delay: 0.1s; }
        .value-card:nth-child(2) { animation-delay: 0.2s; }
        .value-card:nth-child(3) { animation-delay: 0.3s; }
        .value-card:nth-child(4) { animation-delay: 0.4s; }
        .stat-card:nth-child(1) { animation-delay: 0.1s; }
        .stat-card:nth-child(2) { animation-delay: 0.2s; }
        .stat-card:nth-child(3) { animation-delay: 0.3s; }
        .stat-card:nth-child(4) { animation-delay: 0.4s; }
    </style>
</head>
<body>
    {{-- Header --}}
    <x-header />

    {{-- Page Hero --}}
    <section class="page-hero">
        <div class="container">
            <h1>About StacyGarage</h1>
            <p>Your trusted partner in premium car rental services. Delivering excellence, comfort, and reliability with every journey.</p>
        </div>
    </section>

    {{-- Our Story & Mission --}}
    <section class="content-section">
        <div class="container">
            <div class="content-grid">
                <div class="content-text">
                    <h2>Our Story</h2>
                    <p>StacyGarage was founded with a vision to transform the car rental experience in the Philippines. We started as a small family-owned business with a passion for automobiles and customer service.</p>
                    <p>Over the years, we've grown into a trusted name in the industry, known for our diverse fleet of well-maintained vehicles and commitment to customer satisfaction.</p>
                    <p>Today, we proudly serve individuals, families, and businesses across the region, making every journey comfortable, safe, and memorable.</p>
                </div>
                <div class="content-text">
                    <h2>Our Mission</h2>
                    <p>At StacyGarage, our mission is to provide exceptional car rental experiences through quality vehicles, transparent pricing, and personalized service that exceeds expectations.</p>
                    <p>We believe in building lasting relationships with our customers by offering reliable transportation solutions that fit their needs and budget.</p>
                    <p>Whether it's a business trip, family vacation, or special occasion, we're committed to making your journey smooth and enjoyable from start to finish.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats Section --}}
    <section class="stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">{{ $stats['customers'] }}+</div>
                    <div class="stat-label">Happy Customers</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $stats['vehicles'] }}+</div>
                    <div class="stat-label">Quality Vehicles</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $stats['bookings'] }}+</div>
                    <div class="stat-label">Total Bookings</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $stats['testimonials'] }}+</div>
                    <div class="stat-label">5-Star Reviews</div>
                </div>
            </div>
        </div>
    </section>

    {{-- Our Values --}}
    <section class="values-section">
        <div class="container">
            <h2 class="section-title">Our Core Values</h2>
            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3>Excellence</h3>
                    <p>We maintain the highest standards in vehicle quality, cleanliness, and service delivery to ensure your complete satisfaction with every rental.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h3>Integrity</h3>
                    <p>Transparent pricing, honest communication, and ethical business practices form the foundation of our relationship with every customer.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Safety</h3>
                    <p>Your safety is our priority. All our vehicles undergo regular maintenance and thorough inspections to ensure they meet the highest safety standards.</p>
                </div>
            </div>
        </div>
    </section>

   

    {{-- CTA Section --}}
    <section class="cta-section">
        <div class="container">
            <h2>Ready to Hit the Road?</h2>
            <p>Join thousands of satisfied customers who trust StacyGarage for their car rental needs.</p>
            <a class="btn btn-primary" href="/cars">Explore Our Fleet</a>
        </div>
    </section>

    {{-- Footer --}}
    <x-footer />
    
    <x-chatbot />

    {{-- Counter Animation Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stats = document.querySelectorAll('.stat-number');
            const statsSection = document.querySelector('.stats-section');
            let animated = false;

            function animateCounter(element) {
                const text = element.textContent;
                const target = parseInt(text.replace(/\D/g, ''));
                const suffix = text.replace(/[0-9]/g, '');
                const duration = 2000; // 2 seconds
                const increment = target / (duration / 16); // 60fps
                let current = 0;

                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        element.textContent = target + suffix;
                        clearInterval(timer);
                    } else {
                        element.textContent = Math.floor(current) + suffix;
                    }
                }, 16);
            }

            // Intersection Observer to trigger animation when stats section is visible
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && !animated) {
                        animated = true;
                        stats.forEach(stat => {
                            animateCounter(stat);
                        });
                    }
                });
            }, { threshold: 0.5 });

            if (statsSection) {
                observer.observe(statsSection);
            }
        });
    </script>
</body>
</html>
