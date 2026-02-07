<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Testimonials - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --bg: #0a0e1a;
            --fg: #f5f5f5;
            --muted: #b0b0b0;
            --accent: #a41e34;
            --accent-light: #d63447;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto;
            background: radial-gradient(1200px 600px at 70% -10%, rgba(164, 30, 52, 0.08), transparent 60%),
                        radial-gradient(800px 400px at 10% 10%, rgba(26, 31, 46, 0.5), transparent 60%),
                        var(--bg);
            color: var(--fg);
            min-height: 100vh;
            padding: 2rem;
        }
        .container {
            max-width: 1400px;
            margin: 0 auto;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(164, 30, 52, 0.3);
        }
        h1 {
            font-size: 2rem;
            color: var(--fg);
        }
        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-back {
            background: rgba(164, 30, 52, 0.1);
            border: 1.5px solid rgba(164, 30, 52, 0.5);
            color: var(--fg);
        }
        .btn-back:hover {
            background: rgba(164, 30, 52, 0.2);
        }
        .alert {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
        }
        .alert-success {
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #4ade80;
        }
        .tabs {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            border-bottom: 2px solid rgba(164, 30, 52, 0.2);
        }
        .tab {
            padding: 1rem 2rem;
            cursor: pointer;
            border: none;
            background: transparent;
            color: var(--muted);
            font-size: 1rem;
            font-weight: 600;
            border-bottom: 3px solid transparent;
            transition: all 0.3s;
        }
        .tab.active {
            color: var(--accent);
            border-bottom-color: var(--accent);
        }
        .tab:hover {
            color: var(--accent-light);
        }
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
        }
        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
            gap: 1.5rem;
        }
        .testimonial-card {
            background: rgba(26, 31, 46, 0.6);
            border: 1px solid rgba(164, 30, 52, 0.3);
            border-radius: 1rem;
            padding: 1.5rem;
            backdrop-filter: blur(10px);
        }
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 1rem;
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .user-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            color: white;
            font-weight: bold;
        }
        .user-details h3 {
            font-size: 1rem;
            margin-bottom: 0.25rem;
        }
        .user-details p {
            font-size: 0.875rem;
            color: var(--muted);
        }
        .stars {
            color: #fbbf24;
            font-size: 1.25rem;
        }
        .message {
            color: var(--muted);
            line-height: 1.6;
            margin-bottom: 1rem;
        }
        .card-actions {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
        }
        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }
        .btn-approve {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }
        .btn-reject {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }
        .btn-delete {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }
        .btn-approve:hover, .btn-reject:hover, .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }
        .badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 0.5rem;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .badge-pending {
            background: rgba(245, 158, 11, 0.2);
            color: #fbbf24;
            border: 1px solid rgba(245, 158, 11, 0.4);
        }
        .badge-approved {
            background: rgba(16, 185, 129, 0.2);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.4);
        }
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--muted);
        }
        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1> Manage Testimonials</h1>
            <a href="{{ route('admin.home') }}" class="btn btn-back">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <div class="tabs">
            <button class="tab active" onclick="switchTab('pending')">
                <i class="fas fa-clock"></i> Pending ({{ $pending->count() }})
            </button>
            <button class="tab" onclick="switchTab('approved')">
                <i class="fas fa-check-circle"></i> Approved ({{ $approved->count() }})
            </button>
        </div>

        <!-- Pending Testimonials -->
        <div class="tab-content active" id="pending-content">
            @if($pending->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <h3>No pending testimonials</h3>
                    <p>All testimonials have been reviewed.</p>
                </div>
            @else
                <div class="testimonial-grid">
                    @foreach($pending as $testimonial)
                        <div class="testimonial-card">
                            <div class="card-header">
                                <div class="user-info">
                                    <div class="user-avatar">
                                        {{ strtoupper(substr($testimonial->user->name, 0, 1)) }}
                                    </div>
                                    <div class="user-details">
                                        <h3>{{ $testimonial->user->name }}</h3>
                                        <p>{{ $testimonial->created_at->format('M d, Y') }}</p>
                                    </div>
                                </div>
                                <span class="badge badge-pending">Pending</span>
                            </div>
                            
                            <div class="stars">
                                @for($i = 0; $i < $testimonial->rating; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                            </div>
                            
                            <p class="message">{{ $testimonial->message }}</p>
                            
                            <div class="card-actions">
                                <form action="{{ route('admin.testimonials.approve', $testimonial->id) }}" method="POST" style="flex: 1;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-approve" style="width: 100%;">
                                        <i class="fas fa-check"></i> Approve
                                    </button>
                                </form>
                                <form action="{{ route('admin.testimonials.reject', $testimonial->id) }}" method="POST" style="flex: 1;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-reject" style="width: 100%;">
                                        <i class="fas fa-times"></i> Reject
                                    </button>
                                </form>
                                <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this testimonial?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Approved Testimonials -->
        <div class="tab-content" id="approved-content">
            @if($approved->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-check-circle"></i>
                    <h3>No approved testimonials yet</h3>
                    <p>Approved testimonials will appear here.</p>
                </div>
            @else
                <div class="testimonial-grid">
                    @foreach($approved as $testimonial)
                        <div class="testimonial-card">
                            <div class="card-header">
                                <div class="user-info">
                                    <div class="user-avatar">
                                        {{ strtoupper(substr($testimonial->user->name, 0, 1)) }}
                                    </div>
                                    <div class="user-details">
                                        <h3>{{ $testimonial->user->name }}</h3>
                                        <p>{{ $testimonial->created_at->format('M d, Y') }}</p>
                                    </div>
                                </div>
                                <span class="badge badge-approved">Approved</span>
                            </div>
                            
                            <div class="stars">
                                @for($i = 0; $i < $testimonial->rating; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                            </div>
                            
                            <p class="message">{{ $testimonial->message }}</p>
                            
                            <div class="card-actions">
                                <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this testimonial?')" style="width: 100%;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-delete" style="width: 100%;">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <script>
        function switchTab(tab) {
            // Update tab buttons
            document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
            event.target.closest('.tab').classList.add('active');
            
            // Update content
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
            document.getElementById(tab + '-content').classList.add('active');
        }
    </script>
</body>
</html>
