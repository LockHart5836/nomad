<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login — StacyGarage</title>
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
        .login-container {
            width: 100%;
            max-width: 450px;
        }
        .login-header {
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
        .login-subtitle {
            color: var(--muted);
            font-size: 1.1rem;
        }
        .login-card {
            background: linear-gradient(135deg, rgba(26, 31, 46, 0.9), rgba(26, 31, 46, 0.7));
            border: 1px solid rgba(164, 30, 52, 0.3);
            border-radius: 1.5rem;
            padding: 3rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        }
        .login-card h2 {
            margin: 0 0 .5rem 0;
            font-size: 1.75rem;
            color: var(--fg);
        }
        .login-card p {
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
        .password-wrapper {
            position: relative;
        }
        .toggle-password {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--muted);
            cursor: pointer;
            font-size: 1.2rem;
            transition: color .2s ease;
        }
        .toggle-password:hover {
            color: var(--accent-light);
        }
        .checkbox-group {
            display: flex;
            align-items: center;
            gap: .5rem;
            margin-bottom: 1.5rem;
        }
        .checkbox-group input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: var(--accent);
        }
        .checkbox-group label {
            color: var(--muted);
            font-size: .95rem;
            cursor: pointer;
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
        .forgot-link {
            text-align: center;
            margin-top: 1.5rem;
        }
        .forgot-link a {
            color: var(--accent-light);
            text-decoration: none;
            font-size: .95rem;
            transition: color .2s ease;
        }
        .forgot-link a:hover {
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
        @media (max-width: 480px) {
            .login-card {
                padding: 2rem 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
      

        <div class="login-card">
            <h2>Welcome Back</h2>
            <p>Sign in to access the admin dashboard</p>

            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf

                @if(session('error'))
                    <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.3); padding: .75rem 1rem; border-radius: .5rem; margin-bottom: 1rem; color: #ef4444;">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        placeholder="admin@stacygarage.com"
                        value="{{ old('email') }}"
                        required 
                        autofocus
                    >
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-wrapper">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            placeholder="Enter your password"
                            required
                        >
                        <button type="button" class="toggle-password" onclick="togglePassword()">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember me for 30 days</label>
                </div>

                <button type="submit" class="btn">Sign In</button>

                <div class="forgot-link">
                    <a href="#">Forgot your password?</a>
                </div>
            </form>
        </div>

        <div class="back-home">
            <a href="/">← Back to Homepage</a>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.className = 'fas fa-eye-slash';
            } else {
                passwordInput.type = 'password';
                toggleIcon.className = 'fas fa-eye';
            }
        }
    </script>
</body>
</html>
