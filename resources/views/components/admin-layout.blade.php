<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Admin' }} — StacyGarage</title>
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
            --sidebar-width: 260px;
        }
        * { box-sizing: border-box; }
        html, body { height: 100%; margin: 0; }
        body {
            font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif;
            color: var(--fg);
            background: var(--bg);
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, rgba(26, 31, 46, 0.95), rgba(10, 14, 26, 0.95));
            border-right: 1px solid rgba(164, 30, 52, 0.2);
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }
        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(164, 30, 52, 0.2);
        }
        .brand {
            display: flex;
            align-items: center;
            gap: .75rem;
            font-size: 1.3rem;
            font-weight: 700;
            text-decoration: none;
            color: var(--fg);
        }
        .brand-badge {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            display: grid;
            place-items: center;
            font-size: 1.2rem;
            box-shadow: 0 4px 12px var(--ring);
        }
        .sidebar-nav {
            flex: 1;
            padding: 1rem 0;
        }
        .nav-section {
            margin-bottom: 1.5rem;
        }
        .nav-section-title {
            padding: 0 1.5rem;
            font-size: .75rem;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: .5rem;
            letter-spacing: .05em;
        }
        .nav-item {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .75rem 1.5rem;
            color: var(--muted);
            text-decoration: none;
            transition: all .2s ease;
            border-left: 3px solid transparent;
        }
        .nav-item:hover {
            color: var(--fg);
            background: rgba(164, 30, 52, 0.1);
        }
        .nav-item.active {
            color: var(--accent-light);
            background: rgba(164, 30, 52, 0.15);
            border-left-color: var(--accent);
        }
        .nav-icon {
            font-size: 1.2rem;
            width: 1.5rem;
            text-align: center;
        }
        .sidebar-footer {
            padding: 1rem 0;
            border-top: 1px solid rgba(164, 30, 52, 0.2);
        }
        
        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            display: flex;
            flex-direction: column;
        }
        
        /* Top Bar */
        .topbar {
            height: 70px;
            background: linear-gradient(90deg, rgba(26, 31, 46, 0.8), rgba(10, 14, 26, 0.9));
            border-bottom: 1px solid rgba(164, 30, 52, 0.2);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            backdrop-filter: blur(10px);
        }
        .topbar-left h1 {
            margin: 0;
            font-size: 1.5rem;
            color: var(--fg);
        }
        .topbar-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        .user-profile {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .5rem 1rem;
            background: rgba(164, 30, 52, 0.1);
            border-radius: .75rem;
            border: 1px solid rgba(164, 30, 52, 0.2);
        }
        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            display: grid;
            place-items: center;
            font-size: 1rem;
        }
        .user-info {
            display: flex;
            flex-direction: column;
        }
        .user-name {
            font-weight: 600;
            font-size: .95rem;
            color: var(--fg);
        }
        .user-role {
            font-size: .75rem;
            color: var(--muted);
        }
        
        /* Content Area */
        .content-area {
            flex: 1;
            padding: 2rem;
            overflow-y: auto;
        }
        
        /* Alert */
        .alert {
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            border-radius: .5rem;
            background: rgba(34, 197, 94, 0.15);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #4ade80;
            display: flex;
            align-items: center;
            gap: .75rem;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
    
    {{ $styles ?? '' }}
</head>
<body>
    <!-- Sidebar -->
    <x-admin-sidebar />

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Bar -->
        <header class="topbar">
            <div class="topbar-left">
                <h1>{{ $pageTitle ?? 'Dashboard' }}</h1>
            </div>
       
        </header>

        <!-- Content -->
        <div class="content-area">
            {{ $slot }}
        </div>
    </main>
</body>
</html>
