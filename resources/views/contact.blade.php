<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Contact Us — StacyGarage</title>
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
            padding: 3rem 1rem 2rem;
            background: linear-gradient(135deg, rgba(164, 30, 52, 0.1), transparent);
        }
        .page-hero h1 {
            margin: 0 0 0.75rem 0;
            font-size: clamp(2rem, 4vw, 3rem);
            line-height: 1.1;
        }
        .page-hero p {
            margin: 0 auto;
            max-width: 60ch;
            color: var(--muted);
            font-size: 1rem;
            line-height: 1.6;
        }
        .contact-section {
            padding: 2.5rem 1rem;
        }
        .contact-wrapper {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 2rem;
            margin-bottom: 3rem;
        }
        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }
        .info-card {
            background: linear-gradient(135deg, rgba(26, 31, 46, 0.8), rgba(26, 31, 46, 0.5));
            border: 1px solid rgba(164, 30, 52, 0.2);
            padding: 1.25rem;
            border-radius: 0.75rem;
            transition: transform .3s ease, border-color .3s ease, box-shadow .3s ease;
            cursor: pointer;
        }
        .info-card:hover {
            transform: translateY(-4px);
            border-color: var(--accent);
            box-shadow: 0 8px 20px rgba(164, 30, 52, 0.3);
        }
        .info-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            border-radius: .5rem;
            display: grid;
            place-items: center;
            font-size: 1.2rem;
            margin-bottom: 0.75rem;
            transition: transform .3s ease;
        }
        .info-card:hover .info-icon {
            transform: scale(1.1) rotate(5deg);
        }
        .info-card h3 {
            margin: 0 0 .5rem 0;
            font-size: 1.1rem;
            color: var(--fg);
        }
        .info-card p, .info-card a {
            color: var(--muted);
            margin: 0.35rem 0;
            line-height: 1.5;
            font-size: 0.9rem;
        }
        .info-card a {
            text-decoration: none;
            transition: color .2s ease, transform .2s ease;
            display: block;
        }
        .info-card a:hover {
            color: var(--accent-light);
            transform: translateX(4px);
        }
        .contact-form-wrapper {
            background: linear-gradient(135deg, rgba(26, 31, 46, 0.8), rgba(26, 31, 46, 0.5));
            border: 1px solid rgba(164, 30, 52, 0.2);
            padding: 1.75rem;
            border-radius: 0.75rem;
            transition: border-color .3s ease;
        }
        .contact-form-wrapper:hover {
            border-color: var(--accent);
        }
        .contact-form-wrapper h2 {
            margin: 0 0 1.25rem 0;
            font-size: 1.5rem;
            color: var(--fg);
        }
        .form-group {
            margin-bottom: 1.25rem;
        }
        .form-group label {
            display: block;
            margin-bottom: .4rem;
            color: var(--fg);
            font-weight: 500;
            font-size: 0.9rem;
        }
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: .75rem 0.9rem;
            background: rgba(10, 14, 26, 0.6);
            border: 1px solid rgba(164, 30, 52, 0.3);
            border-radius: .5rem;
            color: var(--fg);
            font-family: inherit;
            font-size: 0.95rem;
            transition: border-color .2s ease, box-shadow .2s ease, transform .2s ease;
        }
        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--ring);
            transform: translateY(-2px);
        }
        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        .btn {
            appearance: none;
            border: 0;
            outline: 0;
            cursor: pointer;
            padding: .85rem 1.25rem;
            border-radius: .5rem;
            font-weight: 600;
            transition: transform .06s ease, box-shadow .2s ease;
            text-decoration: none;
            display: inline-block;
            font-size: 0.95rem;
            font-family: inherit;
            width: 100%;
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
        .map-section {
            padding: 2.5rem 1rem;
            background: rgba(26, 31, 46, 0.2);
        }
        .section-title {
            text-align: center;
            font-size: 2rem;
            margin: 0 0 2rem 0;
            color: var(--fg);
        }
        .map-wrapper {
            background: linear-gradient(135deg, rgba(26, 31, 46, 0.8), rgba(26, 31, 46, 0.5));
            border: 1px solid rgba(164, 30, 52, 0.2);
            border-radius: 1rem;
            overflow: hidden;
            height: 350px;
            display: grid;
            place-items: center;
            font-size: 3rem;
            color: rgba(164, 30, 52, 0.3);
            transition: border-color .3s ease, box-shadow .3s ease;
        }
        .map-wrapper:hover {
            border-color: var(--accent);
            box-shadow: 0 8px 20px rgba(164, 30, 52, 0.3);
        }
        .faq-section {
            padding: 2.5rem 1rem;
        }
        .faq-grid {
            display: grid;
            gap: 1.5rem;
            max-width: 900px;
            margin: 0 auto;
        }
        .faq-item {
            background: linear-gradient(135deg, rgba(26, 31, 46, 0.8), rgba(26, 31, 46, 0.5));
            border: 1px solid rgba(164, 30, 52, 0.2);
            border-radius: 1rem;
            padding: 1.5rem 2rem;
            transition: border-color .3s ease;
        }
        .faq-item:hover {
            border-color: var(--accent);
        }
        .faq-question {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--fg);
            margin: 0 0 .75rem 0;
        }
        .faq-answer {
            color: var(--muted);
            line-height: 1.6;
            margin: 0;
        }
        .social-section {
            padding: 2.5rem 1rem;
            text-align: center;
            background: linear-gradient(135deg, rgba(164, 30, 52, 0.1), transparent);
        }
        .social-section h3 {
            font-size: 1.5rem;
            margin: 0 0 1.25rem 0;
            color: var(--fg);
        }
        .social-links {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        .social-link {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            border-radius: 50%;
            display: grid;
            place-items: center;
            font-size: 1.3rem;
            text-decoration: none;
            color: white;
            transition: transform .2s ease, box-shadow .2s ease;
        }
        .social-link:hover {
            transform: translateY(-4px) scale(1.05);
            box-shadow: 0 8px 20px var(--ring);
        }
        /* Individual Social Media Colors */
        .social-link.facebook {
            background: linear-gradient(135deg, #1877f2, #4267B2);
        }
        .social-link.facebook:hover {
            box-shadow: 0 8px 20px rgba(24, 119, 242, 0.4);
        }
        .social-link.instagram {
            background: linear-gradient(135deg, #f09433, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888);
        }
        .social-link.instagram:hover {
            box-shadow: 0 8px 20px rgba(225, 48, 108, 0.4);
        }
        .social-link.twitter {
            background: linear-gradient(135deg, #1DA1F2, #0d8bd9);
        }
        .social-link.twitter:hover {
            box-shadow: 0 8px 20px rgba(29, 161, 242, 0.4);
        }
        .social-link.linkedin {
            background: linear-gradient(135deg, #0077b5, #005582);
        }
        .social-link.linkedin:hover {
            box-shadow: 0 8px 20px rgba(0, 119, 181, 0.4);
        }
        .social-link.youtube {
            background: linear-gradient(135deg, #FF0000, #cc0000);
        }
        .social-link.youtube:hover {
            box-shadow: 0 8px 20px rgba(255, 0, 0, 0.4);
        }
        
        /* Social links inside form */
        .form-social-section {
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(164, 30, 52, 0.2);
        }
        .form-social-section h3 {
            font-size: 1.2rem;
            margin: 0 0 1rem 0;
            color: var(--fg);
            text-align: center;
        }
        .form-social-links {
            display: flex;
            gap: 0.75rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        .form-social-link {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            border-radius: 50%;
            display: grid;
            place-items: center;
            font-size: 1.1rem;
            text-decoration: none;
            color: white;
            transition: transform .2s ease, box-shadow .2s ease;
        }
        .form-social-link:hover {
            transform: translateY(-4px) scale(1.1);
            box-shadow: 0 8px 20px var(--ring);
        }
        /* Individual Social Media Colors for form */
        .form-social-link.facebook {
            background: linear-gradient(135deg, #1877f2, #4267B2);
        }
        .form-social-link.facebook:hover {
            box-shadow: 0 8px 20px rgba(24, 119, 242, 0.4);
        }
        .form-social-link.instagram {
            background: linear-gradient(135deg, #f09433, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888);
        }
        .form-social-link.instagram:hover {
            box-shadow: 0 8px 20px rgba(225, 48, 108, 0.4);
        }
        .form-social-link.twitter {
            background: linear-gradient(135deg, #1DA1F2, #0d8bd9);
        }
        .form-social-link.twitter:hover {
            box-shadow: 0 8px 20px rgba(29, 161, 242, 0.4);
        }
        .form-social-link.linkedin {
            background: linear-gradient(135deg, #0077b5, #005582);
        }
        .form-social-link.linkedin:hover {
            box-shadow: 0 8px 20px rgba(0, 119, 181, 0.4);
        }
        .form-social-link.youtube {
            background: linear-gradient(135deg, #FF0000, #cc0000);
        }
        .form-social-link.youtube:hover {
            box-shadow: 0 8px 20px rgba(255, 0, 0, 0.4);
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
                font-size: clamp(1.75rem, 4vw, 2.5rem);
            }
            .contact-wrapper {
                gap: 1.5rem;
            }
            .section-title {
                font-size: 1.75rem;
            }
        }
        
        @media (max-width: 768px) {
            nav { display: none; }
            
            .page-hero {
                padding: 2rem 1rem 1.5rem;
            }
            .page-hero h1 {
                margin-bottom: 0.5rem;
                font-size: clamp(1.5rem, 3.5vw, 2rem);
            }
            .page-hero p {
                font-size: 0.95rem;
            }
            
            .contact-section {
                padding: 2rem 1rem;
            }
            .contact-wrapper {
                grid-template-columns: 1fr;
                gap: 1.5rem;
                margin-bottom: 2rem;
            }
            
            .contact-info {
                gap: 1rem;
            }
            .info-card {
                padding: 1rem;
            }
            .info-icon {
                width: 35px;
                height: 35px;
                font-size: 1rem;
            }
            .info-card h3 {
                font-size: 1rem;
            }
            .info-card p, .info-card a {
                font-size: 0.85rem;
            }
            
            .contact-form-wrapper {
                padding: 1.5rem;
            }
            .contact-form-wrapper h2 {
                font-size: 1.25rem;
                margin-bottom: 1rem;
            }
            
            .form-group {
                margin-bottom: 1rem;
            }
            .form-group label {
                font-size: 0.85rem;
                margin-bottom: 0.35rem;
            }
            .form-group input,
            .form-group textarea,
            .form-group select {
                padding: 0.65rem 0.8rem;
                font-size: 0.9rem;
            }
            .form-group textarea {
                min-height: 90px;
            }
            
            .form-row {
                grid-template-columns: 1fr;
                gap: 0.75rem;
            }
            
            .btn {
                padding: 0.75rem 1rem;
                font-size: 0.9rem;
            }
            
            .form-social-section {
                margin-top: 1.5rem;
                padding-top: 1.5rem;
            }
            .form-social-section h3 {
                font-size: 1.1rem;
                margin-bottom: 0.85rem;
            }
            .form-social-link {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }
            
            .map-section {
                padding: 2rem 1rem;
            }
            .section-title {
                font-size: 1.5rem;
                margin-bottom: 1.5rem;
            }
            .map-wrapper {
                height: 300px;
            }
        }
        
        @media (max-width: 480px) {
            .container {
                padding: 0 0.85rem;
            }
            
            .page-hero {
                padding: 1.5rem 0.85rem 1rem;
            }
            .page-hero h1 {
                font-size: clamp(1.35rem, 3vw, 1.75rem);
                margin-bottom: 0.5rem;
            }
            .page-hero p {
                font-size: 0.9rem;
                line-height: 1.5;
            }
            
            .contact-section {
                padding: 1.5rem 0.85rem;
            }
            .contact-wrapper {
                gap: 1rem;
                margin-bottom: 1.5rem;
            }
            
            .info-card {
                padding: 0.85rem;
                border-radius: 0.6rem;
            }
            .info-icon {
                width: 32px;
                height: 32px;
                font-size: 0.95rem;
                margin-bottom: 0.6rem;
            }
            .info-card h3 {
                font-size: 0.95rem;
                margin-bottom: 0.4rem;
            }
            .info-card p, .info-card a {
                font-size: 0.8rem;
                margin: 0.25rem 0;
            }
            
            .contact-form-wrapper {
                padding: 1.25rem;
                border-radius: 0.6rem;
            }
            .contact-form-wrapper h2 {
                font-size: 1.15rem;
                margin-bottom: 0.85rem;
            }
            
            .form-group {
                margin-bottom: 0.85rem;
            }
            .form-group label {
                font-size: 0.8rem;
                margin-bottom: 0.3rem;
            }
            .form-group input,
            .form-group textarea,
            .form-group select {
                padding: 0.6rem 0.75rem;
                font-size: 0.85rem;
                border-radius: 0.4rem;
            }
            .form-group textarea {
                min-height: 80px;
            }
            
            .btn {
                padding: 0.7rem 0.95rem;
                font-size: 0.85rem;
                border-radius: 0.4rem;
            }
            
            .form-social-section {
                margin-top: 1.25rem;
                padding-top: 1.25rem;
            }
            .form-social-section h3 {
                font-size: 1rem;
                margin-bottom: 0.75rem;
            }
            .form-social-links {
                gap: 0.6rem;
            }
            .form-social-link {
                width: 38px;
                height: 38px;
                font-size: 0.95rem;
            }
            
            .map-section {
                padding: 1.5rem 0.85rem;
            }
            .section-title {
                font-size: 1.35rem;
                margin-bottom: 1.25rem;
            }
            .map-wrapper {
                height: 250px;
                border-radius: 0.75rem;
            }
        }
        
        @media (max-width: 360px) {
            .container {
                padding: 0 0.75rem;
            }
            
            .page-hero {
                padding: 1.25rem 0.75rem 0.85rem;
            }
            .page-hero h1 {
                font-size: 1.25rem;
            }
            .page-hero p {
                font-size: 0.85rem;
            }
            
            .contact-section {
                padding: 1.25rem 0.75rem;
            }
            
            .info-card {
                padding: 0.75rem;
            }
            .info-icon {
                width: 30px;
                height: 30px;
                font-size: 0.9rem;
            }
            .info-card h3 {
                font-size: 0.9rem;
            }
            .info-card p, .info-card a {
                font-size: 0.75rem;
            }
            
            .contact-form-wrapper {
                padding: 1rem;
            }
            .contact-form-wrapper h2 {
                font-size: 1.05rem;
            }
            
            .form-group input,
            .form-group textarea,
            .form-group select {
                padding: 0.55rem 0.7rem;
                font-size: 0.8rem;
            }
            
            .btn {
                padding: 0.65rem 0.85rem;
                font-size: 0.8rem;
            }
            
            .form-social-link {
                width: 36px;
                height: 36px;
                font-size: 0.9rem;
            }
            
            .section-title {
                font-size: 1.2rem;
            }
            .map-wrapper {
                height: 220px;
            }
        }
    </style>
</head>
<body>
    {{-- Header --}}
    <x-header />

    {{-- Page Hero --}}
    <section class="page-hero">
        <div class="container">
            <h1>Get in Touch</h1>
            <p>Have questions? We're here to help. Reach out to our team and we'll get back to you as soon as possible.</p>
        </div>
    </section>

    {{-- Contact Section --}}
    <section class="contact-section">
        <div class="container">
            <div class="contact-wrapper">
                {{-- Contact Information --}}
                <div class="contact-info">
                    <div class="info-card">
                        <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <h3>Visit Us</h3>
                        <p>Olongapo City<br>Philippines</p>
                    </div>

                    <div class="info-card">
                        <div class="info-icon"><i class="fas fa-phone-alt"></i></div>
                        <h3>Call Us</h3>
                        <a href="tel:+1234567890">+1 (234) 567-890</a>
                        <a href="tel:+1234567891">+1 (234) 567-891 (Support)</a>
                        <p style="margin-top: 1rem; font-size: 0.9rem;">Mon-Fri: 8AM - 8PM<br>Sat-Sun: 9AM - 6PM</p>
                    </div>

                    <div class="info-card">
                        <div class="info-icon"><i class="fas fa-envelope"></i></div>
                        <h3>Email Us</h3>
                        <a href="mailto:info@driveelite.com">stacygarage.com</a>
                        <a href="mailto:support@driveelite.com">support@stacygarage.com</a>
                        <a href="mailto:reservations@driveelite.com">reservations@stacygarage.com</a>
                    </div>

                 
                </div>

                {{-- Contact Form --}}
                <div class="contact-form-wrapper">
                    <h2>Send Us a Message</h2>
                    
                    @guest
                        <div style="text-align: center; padding: 2rem; background: rgba(164, 30, 52, 0.1); border: 1px solid rgba(164, 30, 52, 0.3); border-radius: 0.75rem; margin-bottom: 1.5rem;">
                            <i class="fas fa-lock" style="font-size: 2.5rem; color: var(--accent); margin-bottom: 1rem;"></i>
                            <h3 style="margin-bottom: 0.5rem; color: var(--fg);">Login Required</h3>
                            <p style="color: var(--muted); margin-bottom: 1.5rem;">You need to be logged in to send us a message.</p>
                            <a href="{{ route('login') }}" class="btn btn-primary">
                                <i class="fas fa-sign-in-alt"></i> Login to Continue
                            </a>
                            <p style="color: var(--muted); margin-top: 1rem; font-size: 0.9rem;">
                                Don't have an account? <a href="{{ route('register') }}" style="color: var(--accent-light); text-decoration: none;">Register here</a>
                            </p>
                        </div>
                    @else
                        @if(session('success'))
                            <div style="padding: 1rem; background: rgba(34, 197, 94, 0.1); border: 1px solid rgba(34, 197, 94, 0.3); border-radius: 0.5rem; margin-bottom: 1.5rem; color: #4ade80;">
                                <i class="fas fa-check-circle"></i> {{ session('success') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div style="padding: 1rem; background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.3); border-radius: 0.5rem; margin-bottom: 1.5rem; color: #f87171;">
                                <ul style="list-style: none; padding: 0; margin: 0;">
                                    @foreach($errors->all() as $error)
                                        <li><i class="fas fa-exclamation-circle"></i> {{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('contacts.store') }}" method="POST">
                            @csrf
                            
                            <div style="padding: 1rem; background: rgba(164, 30, 52, 0.1); border-radius: 0.5rem; margin-bottom: 1.5rem;">
                                <p style="margin: 0; color: var(--muted); font-size: 0.95rem;">
                                    <i class="fas fa-user-circle"></i> Logged in as: <strong style="color: var(--fg);">{{ Auth::user()->name }}</strong>
                                </p>
                            </div>

                            <div class="form-group">
                                <label for="subject">Subject *</label>
                                <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required placeholder="What is your message about?">
                            </div>

                            <div class="form-group">
                                <label for="message">Message *</label>
                                <textarea id="message" name="message" required placeholder="Tell us how we can help you..." maxlength="1000">{{ old('message') }}</textarea>
                                <div style="text-align: right; color: var(--muted); font-size: 0.875rem; margin-top: 0.25rem;">
                                    Max 1000 characters
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i> Send Message
                            </button>
                        </form>
                    @endguest
                    
                    {{-- Social Links Inside Form --}}
                    <div class="form-social-section">
                        <h3>Connect With Us</h3>
                        <div class="form-social-links">
                            <a href="#" class="form-social-link facebook" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="form-social-link instagram" title="Instagram"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="form-social-link twitter" title="Twitter"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="form-social-link linkedin" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="form-social-link youtube" title="YouTube"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Map Section --}}
    <section class="map-section">
        <div class="container">
            <h2 class="section-title">Find Us</h2>
            <div class="map-wrapper">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d2293.400356537028!2d120.27924558269478!3d14.823895536520263!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sph!4v1760713260320!5m2!1sen!2sph" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <x-footer />
    
    <x-chatbot />
</body>
</html>
