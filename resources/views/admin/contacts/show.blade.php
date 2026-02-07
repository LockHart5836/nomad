<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Message - Admin</title>
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
            max-width: 900px;
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
            font-size: 1.75rem;
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
        .message-card {
            background: rgba(26, 31, 46, 0.6);
            border: 1px solid rgba(164, 30, 52, 0.3);
            border-radius: 1rem;
            padding: 2rem;
            backdrop-filter: blur(10px);
            margin-bottom: 2rem;
        }
        .user-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid rgba(164, 30, 52, 0.2);
        }
        .user-avatar {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            color: white;
            font-weight: bold;
        }
        .user-details h2 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }
        .user-meta {
            color: var(--muted);
            font-size: 0.95rem;
        }
        .message-subject {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--fg);
            margin-bottom: 1rem;
            padding: 1rem;
            background: rgba(164, 30, 52, 0.1);
            border-left: 4px solid var(--accent);
            border-radius: 0.5rem;
        }
        .message-content {
            line-height: 1.8;
            color: var(--muted);
            font-size: 1.05rem;
            margin-bottom: 1.5rem;
            white-space: pre-wrap;
        }
        .reply-section {
            background: rgba(26, 31, 46, 0.6);
            border: 1px solid rgba(164, 30, 52, 0.3);
            border-radius: 1rem;
            padding: 2rem;
            backdrop-filter: blur(10px);
        }
        .reply-header {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            font-size: 1.25rem;
            font-weight: 600;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--fg);
            font-weight: 600;
        }
        textarea {
            width: 100%;
            padding: 1rem;
            background: rgba(10, 14, 26, 0.8);
            border: 1.5px solid rgba(164, 30, 52, 0.3);
            border-radius: 0.5rem;
            color: var(--fg);
            font-size: 1rem;
            resize: vertical;
            min-height: 200px;
            font-family: inherit;
            line-height: 1.6;
        }
        textarea:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(164, 30, 52, 0.35);
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            color: white;
            width: 100%;
            justify-content: center;
            padding: 1rem;
            font-size: 1rem;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(164, 30, 52, 0.4);
        }
        .existing-reply {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        .existing-reply-header {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
            color: #34d399;
            font-weight: 600;
        }
        .existing-reply-content {
            color: var(--muted);
            line-height: 1.6;
            white-space: pre-wrap;
        }
        .char-count {
            text-align: right;
            color: var(--muted);
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-envelope-open"></i> Message Details</h1>
            <a href="{{ route('admin.contacts.index') }}" class="btn btn-back">
                <i class="fas fa-arrow-left"></i> Back to Messages
            </a>
        </div>

        <!-- Message Card -->
        <div class="message-card">
            <div class="user-header">
                <div class="user-avatar">
                    {{ strtoupper(substr($contact->user->name, 0, 1)) }}
                </div>
                <div class="user-details">
                    <h2>{{ $contact->user->name }}</h2>
                    <div class="user-meta">
                        <i class="fas fa-envelope"></i> {{ $contact->user->email }} | 
                        <i class="fas fa-clock"></i> Sent {{ $contact->created_at->format('M d, Y \a\t h:i A') }}
                    </div>
                </div>
            </div>

            <div class="message-subject">
                <i class="fas fa-tag"></i> {{ $contact->subject }}
            </div>

            <div class="message-content">{{ $contact->message }}</div>
        </div>

        <!-- Reply Section -->
        <div class="reply-section">
            @if($contact->admin_reply)
                <div class="existing-reply">
                    <div class="existing-reply-header">
                        <i class="fas fa-check-circle"></i> Your Reply (sent {{ $contact->replied_at->diffForHumans() }})
                    </div>
                    <div class="existing-reply-content">{{ $contact->admin_reply }}</div>
                </div>
                <p style="color: var(--muted); text-align: center; margin-bottom: 1.5rem;">
                    <i class="fas fa-info-circle"></i> You can update your reply by submitting a new one below.
                </p>
            @else
                <div class="reply-header">
                    <i class="fas fa-reply"></i> Send Reply
                </div>
            @endif

            <form action="{{ route('admin.contacts.reply', $contact->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="admin_reply">Your Reply *</label>
                    <textarea 
                        name="admin_reply" 
                        id="admin_reply" 
                        required 
                        placeholder="Type your reply here..."
                        maxlength="1000"
                        oninput="updateCharCount()"
                    >{{ old('admin_reply', $contact->admin_reply) }}</textarea>
                    <div class="char-count">
                        <span id="charCount">0</span>/1000 characters
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane"></i> {{ $contact->admin_reply ? 'Update Reply' : 'Send Reply' }}
                </button>
            </form>
        </div>
    </div>

    <script>
        function updateCharCount() {
            const textarea = document.getElementById('admin_reply');
            const charCount = document.getElementById('charCount');
            charCount.textContent = textarea.value.length;
        }

        // Initialize character count
        updateCharCount();
    </script>
</body>
</html>
