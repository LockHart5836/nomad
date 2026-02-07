<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>All Notifications - StacyGarage</title>
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
            display: flex;
            flex-direction: column;
        }
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.25rem;
        }
        main {
            flex: 1;
            padding: 2rem 0;
        }
        .page-header {
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
        .btn-secondary {
            background: rgba(164, 30, 52, 0.1);
            border: 1.5px solid rgba(164, 30, 52, 0.5);
            color: var(--fg);
        }
        .btn-secondary:hover {
            background: rgba(164, 30, 52, 0.2);
        }
        .notifications-container {
            background: rgba(26, 31, 46, 0.6);
            border: 1px solid rgba(164, 30, 52, 0.3);
            border-radius: 1rem;
            backdrop-filter: blur(10px);
            overflow: hidden;
        }
        .notification-item {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(164, 30, 52, 0.2);
            transition: all 0.2s;
            cursor: pointer;
        }
        .notification-item:last-child {
            border-bottom: none;
        }
        .notification-item:hover {
            background: rgba(164, 30, 52, 0.1);
        }
        .notification-item.unread {
            background: rgba(164, 30, 52, 0.05);
        }
        .notification-content {
            display: flex;
            gap: 1rem;
        }
        .notification-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .icon-reply {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
        }
        .icon-approved {
            background: linear-gradient(135deg, #10b981, #059669);
        }
        .icon-default {
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
        }
        .notification-body {
            flex: 1;
            min-width: 0;
        }
        .notification-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 0.5rem;
        }
        .notification-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--fg);
            margin-bottom: 0.5rem;
        }
        .notification-message {
            color: var(--muted);
            line-height: 1.6;
            margin-bottom: 0.75rem;
        }
        .notification-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.875rem;
            color: var(--muted);
        }
        .notification-actions {
            display: flex;
            gap: 0.5rem;
        }
        .btn-sm {
            padding: 0.4rem 0.75rem;
            font-size: 0.8rem;
        }
        .btn-delete {
            background: transparent;
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }
        .btn-delete:hover {
            background: rgba(239, 68, 68, 0.1);
        }
        .unread-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(239, 68, 68, 0.2);
            color: #f87171;
            padding: 0.25rem 0.75rem;
            border-radius: 0.5rem;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .unread-dot {
            width: 8px;
            height: 8px;
            background: #ef4444;
            border-radius: 50%;
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
        
        /* Admin Reply Box Styles */
        .admin-reply-box {
            margin-top: 1rem;
            padding: 1.25rem;
            background: linear-gradient(135deg, rgba(164, 30, 52, 0.05), rgba(164, 30, 52, 0.02));
            border-left: 4px solid var(--accent);
            border-radius: 0.75rem;
            backdrop-filter: blur(5px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }
        .admin-reply-header {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--accent-light);
            font-size: 0.95rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }
        .admin-reply-header i {
            font-size: 1rem;
        }
        .admin-reply-content {
            color: var(--fg);
            line-height: 1.6;
            padding: 0.75rem;
            background: rgba(0, 0, 0, 0.2);
            border-radius: 0.5rem;
            margin-bottom: 0.75rem;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        .admin-reply-footer {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .admin-reply-footer small {
            color: var(--muted);
            font-size: 0.8rem;
        }
        .admin-reply-footer i {
            font-size: 0.75rem;
            opacity: 0.7;
        }
    </style>
</head>
<body>
 

    <main>
        <div class="container">
            <div class="page-header">
                <h1><i class="fas fa-bell"></i> All Notifications</h1>
                <div style="display: flex; gap: 0.5rem;">
                    @if($notifications->where('is_read', false)->count() > 0)
                        <button onclick="markAllAsRead()" class="btn btn-secondary">
                            <i class="fas fa-check-double"></i> Mark All as Read
                        </button>
                    @endif
                    <a href="/" class="btn btn-secondary">
                        <i class="fas fa-home"></i> Back to Home
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @if($notifications->isEmpty())
                <div class="notifications-container">
                    <div class="empty-state">
                        <i class="fas fa-bell-slash"></i>
                        <h3>No notifications yet</h3>
                        <p>You'll see notifications here when there's activity on your account.</p>
                    </div>
                </div>
            @else
                <div class="notifications-container">
                    @foreach($notifications as $notification)
                        <div class="notification-item {{ $notification->is_read ? '' : 'unread' }}" onclick="markAsRead({{ $notification->id }})">
                            <div class="notification-content">
                                <div class="notification-icon {{ 
                                    $notification->type === 'contact_reply' ? 'icon-reply' : 
                                    ($notification->type === 'booking_approved' ? 'icon-approved' : 'icon-default')
                                }}">
                                    @if($notification->type === 'contact_reply')
                                        <i class="fas fa-reply" style="color: white; font-size: 1.25rem;"></i>
                                    @elseif($notification->type === 'booking_approved')
                                        <i class="fas fa-check-circle" style="color: white; font-size: 1.25rem;"></i>
                                    @else
                                        <i class="fas fa-info-circle" style="color: white; font-size: 1.25rem;"></i>
                                    @endif
                                </div>
                                <div class="notification-body">
                                    <div class="notification-header">
                                        <div>
                                            <div class="notification-title">{{ $notification->title }}</div>
                                            @if(!$notification->is_read)
                                                <span class="unread-badge">
                                                    <span class="unread-dot"></span>
                                                    New
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <p class="notification-message">{{ $notification->message }}</p>
                                    
                                    @if($notification->type === 'contact_reply' && $notification->contact && $notification->contact->admin_reply)
                                        <div class="admin-reply-box">
                                            <div class="admin-reply-header">
                                                <i class="fas fa-reply"></i>
                                                <strong>Admin's Reply:</strong>
                                            </div>
                                            <div class="admin-reply-content">
                                                {{ $notification->contact->admin_reply }}
                                            </div>
                                            <div class="admin-reply-footer">
                                                <small class="text-muted">
                                                    <i class="fas fa-calendar-alt"></i> 
                                                    Replied on {{ $notification->contact->replied_at->format('M d, Y \a\t h:i A') }}
                                                </small>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    <div class="notification-meta">
                                        <span>
                                            <i class="fas fa-clock"></i> {{ $notification->created_at->format('M d, Y \a\t h:i A') }}
                                            ({{ $notification->created_at->diffForHumans() }})
                                        </span>
                                        <div class="notification-actions">
                                            <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" onsubmit="return confirm('Delete this notification?')" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-delete" onclick="event.stopPropagation();">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div style="margin-top: 2rem;">
                    {{ $notifications->links() }}
                </div>
            @endif
        </div>
    </main>

    
    <script>
        function markAsRead(notificationId) {
            fetch(`/notifications/${notificationId}/read`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function markAllAsRead() {
            fetch('/notifications/mark-all-read', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</body>
</html>
