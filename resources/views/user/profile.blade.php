<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Profile - StacyGarage</title>
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

        button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(164, 30, 52, 0.4);
        }
        
        a[href*="home"]:hover {
            background: rgba(164, 30, 52, 0.1);
            color: var(--accent);
        }
    </style>
</head>
<body>
    @include('components.header')

    <main style="padding-top: 80px; min-height: 100vh; background: var(--bg);">
        <div class="container" style="max-width: 800px; margin: 0 auto; padding: 2rem 1rem;">
            <div style="background: rgba(26, 31, 46, 0.95); border: 1px solid rgba(164, 30, 52, 0.3); border-radius: 1rem; padding: 2rem; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);">
                <div style="border-bottom: 2px solid rgba(164, 30, 52, 0.3); padding-bottom: 1rem; margin-bottom: 2rem;">
                    <h1 style="color: var(--fg); margin: 0; font-size: 2rem; display: flex; align-items: center; gap: 0.75rem;">
                        <i class="fas fa-user-circle" style="color: var(--accent);"></i>
                        My Profile
                    </h1>
                    <p style="color: var(--muted); margin: 0.5rem 0 0 0;">Manage your account information</p>
                </div>

                @if(session('success'))
                    <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: #10b981; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem;">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.3); color: #ef4444; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem;">
                        <ul style="margin: 0; padding-left: 1.5rem;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('user.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div style="margin-bottom: 1.5rem;">
                        <label style="display: block; color: var(--fg); font-weight: 600; margin-bottom: 0.5rem;">
                            <i class="fas fa-user"></i> Full Name *
                        </label>
                        <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required
                               style="width: 100%; padding: 0.75rem; background: rgba(10, 14, 26, 0.8); border: 1px solid rgba(164, 30, 52, 0.3); border-radius: 0.5rem; color: var(--fg); font-size: 1rem;">
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label style="display: block; color: var(--fg); font-weight: 600; margin-bottom: 0.5rem;">
                            <i class="fas fa-envelope"></i> Email Address *
                        </label>
                        <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required
                               style="width: 100%; padding: 0.75rem; background: rgba(10, 14, 26, 0.8); border: 1px solid rgba(164, 30, 52, 0.3); border-radius: 0.5rem; color: var(--fg); font-size: 1rem;">
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label style="display: block; color: var(--fg); font-weight: 600; margin-bottom: 0.5rem;">
                            <i class="fas fa-phone"></i> Phone Number
                        </label>
                        <input type="text" name="phone" value="{{ old('phone', Auth::user()->phone ?? '') }}"
                               style="width: 100%; padding: 0.75rem; background: rgba(10, 14, 26, 0.8); border: 1px solid rgba(164, 30, 52, 0.3); border-radius: 0.5rem; color: var(--fg); font-size: 1rem;">
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label style="display: block; color: var(--fg); font-weight: 600; margin-bottom: 0.5rem;">
                            <i class="fas fa-map-marker-alt"></i> Address
                        </label>
                        <textarea name="address" rows="3"
                                  style="width: 100%; padding: 0.75rem; background: rgba(10, 14, 26, 0.8); border: 1px solid rgba(164, 30, 52, 0.3); border-radius: 0.5rem; color: var(--fg); font-size: 1rem; resize: vertical;">{{ old('address', Auth::user()->address ?? '') }}</textarea>
                    </div>

                    <div style="border-top: 2px solid rgba(164, 30, 52, 0.2); padding-top: 1.5rem; margin-top: 2rem;">
                        <h3 style="color: var(--fg); margin: 0 0 1rem 0; font-size: 1.2rem;">
                            <i class="fas fa-lock"></i> Change Password
                        </h3>
                        <p style="color: var(--muted); margin-bottom: 1rem; font-size: 0.9rem;">Leave blank if you don't want to change your password</p>

                        <div style="margin-bottom: 1.5rem;">
                            <label style="display: block; color: var(--fg); font-weight: 600; margin-bottom: 0.5rem;">
                                <i class="fas fa-key"></i> Current Password
                            </label>
                            <input type="password" name="current_password"
                                   style="width: 100%; padding: 0.75rem; background: rgba(10, 14, 26, 0.8); border: 1px solid rgba(164, 30, 52, 0.3); border-radius: 0.5rem; color: var(--fg); font-size: 1rem;">
                        </div>

                        <div style="margin-bottom: 1.5rem;">
                            <label style="display: block; color: var(--fg); font-weight: 600; margin-bottom: 0.5rem;">
                                <i class="fas fa-key"></i> New Password
                            </label>
                            <input type="password" name="new_password"
                                   style="width: 100%; padding: 0.75rem; background: rgba(10, 14, 26, 0.8); border: 1px solid rgba(164, 30, 52, 0.3); border-radius: 0.5rem; color: var(--fg); font-size: 1rem;">
                        </div>

                        <div style="margin-bottom: 1.5rem;">
                            <label style="display: block; color: var(--fg); font-weight: 600; margin-bottom: 0.5rem;">
                                <i class="fas fa-key"></i> Confirm New Password
                            </label>
                            <input type="password" name="new_password_confirmation"
                                   style="width: 100%; padding: 0.75rem; background: rgba(10, 14, 26, 0.8); border: 1px solid rgba(164, 30, 52, 0.3); border-radius: 0.5rem; color: var(--fg); font-size: 1rem;">
                        </div>
                    </div>

                    <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                        <button type="submit" style="flex: 1; padding: 0.875rem 2rem; background: linear-gradient(135deg, #a41e34, #d63447); color: white; border: none; border-radius: 0.5rem; font-weight: 600; font-size: 1rem; cursor: pointer; box-shadow: 0 4px 12px rgba(164, 30, 52, 0.3); transition: all 0.3s ease;">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                        <a href="{{ route('home') }}" style="padding: 0.875rem 2rem; background: transparent; color: var(--muted); border: 1px solid rgba(164, 30, 52, 0.3); border-radius: 0.5rem; font-weight: 600; text-decoration: none; text-align: center; transition: all 0.3s ease;">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    @include('components.footer')
    
    <x-chatbot />
</body>
</html>
