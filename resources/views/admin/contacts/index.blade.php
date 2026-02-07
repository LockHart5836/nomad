<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Contacts - Admin</title>
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
        .contact-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        .contact-card {
            background: rgba(26, 31, 46, 0.6);
            border: 1px solid rgba(164, 30, 52, 0.3);
            border-radius: 1rem;
            padding: 1.5rem;
            backdrop-filter: blur(10px);
            transition: all 0.3s;
        }
        .contact-card:hover {
            border-color: var(--accent);
            transform: translateX(4px);
        }
        .contact-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 1rem;
        }
        .contact-info {
            flex: 1;
        }
        .contact-user {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.5rem;
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
        .contact-user-details h3 {
            font-size: 1.1rem;
            margin-bottom: 0.25rem;
        }
        .contact-meta {
            font-size: 0.875rem;
            color: var(--muted);
        }
        .contact-subject {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--fg);
            margin-bottom: 0.75rem;
        }
        .contact-preview {
            color: var(--muted);
            margin-bottom: 1rem;
            line-height: 1.6;
        }
        .contact-actions {
            display: flex;
            gap: 0.5rem;
        }
        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            color: white;
        }
        .btn-delete {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }
        .btn-primary:hover, .btn-delete:hover {
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
        .badge-unread {
            background: rgba(239, 68, 68, 0.2);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.4);
        }
        .badge-replied {
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
            <h1> Manage Contact Messages</h1>
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
            <button class="tab active" onclick="switchTab('unread')">
                <i class="fas fa-envelope"></i> Unread ({{ $unread->count() }})
            </button>
            <button class="tab" onclick="switchTab('read')">
                <i class="fas fa-envelope-open"></i> Read ({{ $read->count() }})
            </button>
        </div>

        <!-- Unread Messages -->
        <div class="tab-content active" id="unread-content">
            @if($unread->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <h3>No unread messages</h3>
                    <p>All messages have been reviewed.</p>
                </div>
            @else
                <div class="contact-list">
                    @foreach($unread as $contact)
                        <div class="contact-card">
                            <div class="contact-header">
                                <div class="contact-info">
                                    <div class="contact-user">
                                        <div class="user-avatar">
                                            {{ strtoupper(substr($contact->user->name, 0, 1)) }}
                                        </div>
                                        <div class="contact-user-details">
                                            <h3>{{ $contact->user->name }}</h3>
                                            <div class="contact-meta">
                                                <i class="fas fa-envelope"></i> {{ $contact->user->email }} | 
                                                <i class="fas fa-clock"></i> {{ $contact->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="contact-subject">
                                        <i class="fas fa-tag"></i> {{ $contact->subject }}
                                    </div>
                                    <div class="contact-preview">
                                        {{ Str::limit($contact->message, 200) }}
                                    </div>
                                </div>
                                <span class="badge badge-unread">Unread</span>
                            </div>
                            <div class="contact-actions">
                                <a href="{{ route('admin.contacts.show', $contact->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-reply"></i> View & Reply
                                </a>
                                <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?')">
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

        <!-- Read Messages -->
        <div class="tab-content" id="read-content">
            @if($read->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-envelope-open"></i>
                    <h3>No read messages yet</h3>
                    <p>Read messages will appear here.</p>
                </div>
            @else
                <div class="contact-list">
                    @foreach($read as $contact)
                        <div class="contact-card">
                            <div class="contact-header">
                                <div class="contact-info">
                                    <div class="contact-user">
                                        <div class="user-avatar">
                                            {{ strtoupper(substr($contact->user->name, 0, 1)) }}
                                        </div>
                                        <div class="contact-user-details">
                                            <h3>{{ $contact->user->name }}</h3>
                                            <div class="contact-meta">
                                                <i class="fas fa-envelope"></i> {{ $contact->user->email }} | 
                                                <i class="fas fa-clock"></i> {{ $contact->created_at->diffForHumans() }}
                                                @if($contact->replied_at)
                                                    | <i class="fas fa-reply"></i> Replied {{ $contact->replied_at->diffForHumans() }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="contact-subject">
                                        <i class="fas fa-tag"></i> {{ $contact->subject }}
                                    </div>
                                    <div class="contact-preview">
                                        {{ Str::limit($contact->message, 200) }}
                                    </div>
                                </div>
                                @if($contact->replied_at)
                                    <span class="badge badge-replied">Replied</span>
                                @endif
                            </div>
                            <div class="contact-actions">
                                <a href="{{ route('admin.contacts.show', $contact->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i> View Details
                                </a>
                                <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?')">
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
