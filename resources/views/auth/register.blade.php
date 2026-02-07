<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - StacyGarage</title>
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
            background: radial-gradient(1200px 600px at 50% 0%, rgba(164, 30, 52, 0.15), transparent 70%),
                        var(--bg);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 2rem;
        }
        .register-container {
            width: 100%;
            max-width: 500px;
        }
        .register-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .brand-logo {
            display: inline-flex;
            align-items: center;
            gap: .75rem;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-decoration: none;
            color: var(--fg);
        }
        .brand-badge {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            display: grid;
            place-items: center;
            font-size: 1.8rem;
            box-shadow: 0 8px 24px var(--ring);
        }
        .register-subtitle {
            color: var(--muted);
            font-size: 1.1rem;
        }
        .register-card {
            background: linear-gradient(135deg, rgba(26, 31, 46, 0.9), rgba(26, 31, 46, 0.7));
            border: 1px solid rgba(164, 30, 52, 0.3);
            border-radius: 1.5rem;
            padding: 3rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        }
        .register-card h2 {
            margin: 0 0 .5rem 0;
            font-size: 1.75rem;
            color: var(--fg);
        }
        .register-card p {
            margin: 0 0 2rem 0;
            color: var(--muted);
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            margin-bottom: .5rem;
            color: var(--fg);
            font-weight: 500;
            font-size: .95rem;
        }
        .form-group input {
            width: 100%;
            padding: .95rem 1.1rem;
            background: rgba(10, 14, 26, 0.7);
            border: 1px solid rgba(164, 30, 52, 0.3);
            border-radius: .75rem;
            color: var(--fg);
            font-family: inherit;
            font-size: 1rem;
            transition: border-color .2s ease, box-shadow .2s ease;
        }
        .form-group input:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--ring);
        }
        .form-group input::placeholder {
            color: rgba(176, 176, 176, 0.5);
        }
        .btn {
            width: 100%;
            padding: 1rem 1.5rem;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            color: #fff;
            border: none;
            border-radius: .75rem;
            font-weight: 600;
            font-size: 1rem;
            font-family: inherit;
            cursor: pointer;
            transition: transform .06s ease, box-shadow .2s ease;
            box-shadow: 0 8px 24px var(--ring);
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px var(--ring);
        }
        .btn:active {
            transform: translateY(0);
        }
        .login-link {
            text-align: center;
            margin-top: 1.5rem;
        }
        .login-link a {
            color: var(--accent-light);
            text-decoration: none;
            font-size: .95rem;
            transition: color .2s ease;
        }
        .login-link a:hover {
            color: var(--accent);
            text-decoration: underline;
        }
        .back-home {
            text-align: center;
            margin-top: 2rem;
        }
        .back-home a {
            color: var(--muted);
            text-decoration: none;
            font-size: .95rem;
            transition: color .2s ease;
        }
        .back-home a:hover {
            color: var(--fg);
        }
        .error {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            padding: .75rem 1rem;
            border-radius: .5rem;
            margin-bottom: 1rem;
            color: #ef4444;
            font-size: .9rem;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-card">
            <h2>Create Account</h2>
            <p>Join StacyGarage today</p>

            <form action="{{ route('register.submit') }}" method="POST">
                @csrf

                @if($errors->any())
                    <div class="error">
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        placeholder="John Doe"
                        value="{{ old('name') }}"
                        required 
                        autofocus
                    >
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        placeholder="you@example.com"
                        value="{{ old('email') }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="Minimum 8 characters"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        placeholder="Re-enter your password"
                        required
                    >
                </div>

                <button type="submit" class="btn">Create Account</button>

                <div class="login-link">
                    Already have an account? <a href="{{ route('login') }}">Sign in</a>
                </div>
            </form>
        </div>

        <div class="back-home">
            <a href="/">← Back to Homepage</a>
        </div>
    </div>
</body>
</html>
