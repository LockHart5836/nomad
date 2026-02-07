<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add New Car — StacyGarage Admin</title>
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
        .topbar {
            padding: 1.25rem 2rem;
            background: rgba(26, 31, 46, 0.4);
            border-bottom: 1px solid rgba(164, 30, 52, 0.15);
            display: flex;
            align-items: center;
            justify-content: space-between;
            backdrop-filter: blur(8px);
        }
        .topbar-left h1 {
            font-size: 1.75rem;
            margin: 0;
            font-weight: 600;
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
        }
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            display: grid;
            place-items: center;
            font-size: 1.2rem;
        }
        .user-info {
            line-height: 1.3;
        }
        .user-name {
            font-weight: 600;
            font-size: .95rem;
        }
        .user-role {
            font-size: .8rem;
            color: var(--muted);
        }
        
        /* Content Area */
        .content-area {
            flex: 1;
            padding: 2rem;
            overflow-y: auto;
        }
        .form-card {
            background: var(--card);
            border-radius: .75rem;
            border: 1px solid rgba(164, 30, 52, 0.15);
            padding: 2rem;
            max-width: 900px;
            margin: 0 auto;
        }
        .form-card h2 {
            margin-bottom: 1.5rem;
            color: var(--fg);
            font-size: 1.5rem;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        label {
            display: block;
            margin-bottom: .5rem;
            font-weight: 600;
            color: var(--fg);
        }
        input, select, textarea {
            width: 100%;
            padding: .75rem;
            background: rgba(10, 14, 26, 0.5);
            border: 1px solid rgba(164, 30, 52, 0.3);
            border-radius: .5rem;
            font-size: 1rem;
            font-family: inherit;
            color: var(--fg);
        }
        input:focus, select:focus, textarea:focus {
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
        .checkbox-group {
            display: flex;
            align-items: center;
            gap: .5rem;
        }
        .checkbox-group input[type="checkbox"] {
            width: auto;
        }
        .btn {
            padding: .75rem 1.5rem;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            color: #fff;
            border: none;
            border-radius: .5rem;
            font-weight: 600;
            font-size: .9rem;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            transition: transform .06s ease, box-shadow .2s ease;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px var(--ring);
        }
        .btn-secondary {
            background: linear-gradient(135deg, #6c757d, #5a6268);
        }
        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }
        .error {
            color: #f87171;
            font-size: .875rem;
            margin-top: .25rem;
        }
        .help-text {
            font-size: .875rem;
            color: var(--muted);
            margin-top: .25rem;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .main-content {
                margin-left: 0;
            }
            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <x-admin-sidebar />

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Bar -->
        <header class="topbar">
            <div class="topbar-left">
                <h1>Add New Vehicle</h1>
            </div>
            <div class="topbar-right">
                <div class="user-profile">
                    <div class="user-avatar"><i class="fas fa-user-circle"></i></div>
                    <div class="user-info">
                        <div class="user-name">Admin User</div>
                        <div class="user-role">Administrator</div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Content -->
        <div class="content-area">
            <div class="form-card">
                <h2><i class="fas fa-plus-circle"></i> Add New Car</h2>

            <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="name">Car Name *</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="category">Category *</label>
                        <select id="category" name="category" required>
                            <option value="">Select Category</option>
                            <option value="sedan" {{ old('category') == 'sedan' ? 'selected' : '' }}>Sedan</option>
                            <option value="suv" {{ old('category') == 'suv' ? 'selected' : '' }}>SUV</option>
                            <option value="truck" {{ old('category') == 'truck' ? 'selected' : '' }}>Truck</option>
                            <option value="luxury" {{ old('category') == 'luxury' ? 'selected' : '' }}>Luxury</option>
                            <option value="sports" {{ old('category') == 'sports' ? 'selected' : '' }}>Sports</option>
                            <option value="van" {{ old('category') == 'van' ? 'selected' : '' }}>Van</option>
                        </select>
                        @error('category')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="price">Price per Day (₱) *</label>
                        <input type="number" id="price" name="price" step="0.01" min="0" value="{{ old('price') }}" required>
                        @error('price')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="seats">Number of Seats *</label>
                        <input type="number" id="seats" name="seats" min="1" value="{{ old('seats') }}" required>
                        @error('seats')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="transmission">Transmission *</label>
                        <select id="transmission" name="transmission" required>
                            <option value="">Select Transmission</option>
                            <option value="Automatic" {{ old('transmission') == 'Automatic' ? 'selected' : '' }}>Automatic</option>
                            <option value="Manual" {{ old('transmission') == 'Manual' ? 'selected' : '' }}>Manual</option>
                            <option value="CVT" {{ old('transmission') == 'CVT' ? 'selected' : '' }}>CVT</option>
                        </select>
                        @error('transmission')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="features">Features</label>
                    <input type="text" id="features" name="features" value="{{ old('features') }}" placeholder="e.g., AC, GPS, Bluetooth">
                    <p class="help-text">Separate features with commas</p>
                    @error('features')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">Car Image</label>
                    <input type="file" id="image" name="image" accept="image/*">
                    <p class="help-text">Recommended size: 800x600px. Max 5MB</p>
                    @error('image')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="checkbox-group">
                        <input type="checkbox" id="available" name="available" value="1" {{ old('available', true) ? 'checked' : '' }}>
                        <label for="available" style="margin: 0;">Available for Rent</label>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Car
                    </button>
                    <a href="{{ route('admin.cars.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
    </main>
</body>
</html>
