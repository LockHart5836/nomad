<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Messages - StacyGarage</title>
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

        a[href*="contacts.create"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(164, 30, 52, 0.4);
        }
    </style>
</head>
<body>
    @include('components.header')

    <main style="padding-top: 80px; min-height: 100vh; background: var(--bg);">
        <div class="container" style="max-width: 1000px; margin: 0 auto; padding: 2rem 1rem;">
            <div style="margin-bottom: 2rem;">
                <h1 style="color: var(--fg); margin: 0; font-size: 2rem; display: flex; align-items: center; gap: 0.75rem;">
                    <i class="fas fa-envelope" style="color: var(--accent);"></i>
                    My Messages
                </h1>
                <p style="color: var(--muted); margin: 0.5rem 0 0 0;">View your contact messages and admin replies</p>
            </div>

            @if($contacts->isEmpty())
                <div style="background: rgba(26, 31, 46, 0.95); border: 1px solid rgba(164, 30, 52, 0.3); border-radius: 1rem; padding: 3rem; text-align: center;">
                    <i class="fas fa-inbox" style="font-size: 4rem; color: rgba(164, 30, 52, 0.3); margin-bottom: 1rem;"></i>
                    <h3 style="color: var(--fg); margin: 0 0 0.5rem 0;">No Messages Yet</h3>
                    <p style="color: var(--muted); margin: 0 0 1.5rem 0;">You haven't sent any contact messages yet.</p>
                    <a href="{{ route('contacts.create') }}" style="display: inline-block; padding: 0.75rem 2rem; background: linear-gradient(135deg, #a41e34, #d63447); color: white; border-radius: 0.5rem; text-decoration: none; font-weight: 600;">
                        <i class="fas fa-paper-plane"></i> Send a Message
                    </a>
                </div>
            @else
                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    @foreach($contacts as $contact)
                        <div style="background: rgba(26, 31, 46, 0.95); border: 1px solid rgba(164, 30, 52, 0.3); border-radius: 1rem; padding: 1.5rem; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);">
                            <!-- Message Header -->
                            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px solid rgba(164, 30, 52, 0.2);">
                                <div style="flex: 1;">
                                    <h3 style="color: var(--fg); margin: 0 0 0.5rem 0; font-size: 1.2rem; display: flex; align-items: center; gap: 0.5rem;">
                                        <i class="fas fa-comment-dots" style="color: var(--accent);"></i>
                                        {{ $contact->subject }}
                                    </h3>
                                    <p style="color: var(--muted); margin: 0; font-size: 0.9rem;">
                                        <i class="fas fa-clock"></i> Sent {{ $contact->created_at->format('M d, Y \a\t h:i A') }}
                                    </p>
                                </div>
                                @if($contact->admin_reply)
                                    <span style="background: rgba(16, 185, 129, 0.1); color: #10b981; padding: 0.375rem 0.75rem; border-radius: 0.5rem; font-size: 0.85rem; font-weight: 600;">
                                        <i class="fas fa-check-circle"></i> Replied
                                    </span>
                                @else
                                    <span style="background: rgba(251, 191, 36, 0.1); color: #fbbf24; padding: 0.375rem 0.75rem; border-radius: 0.5rem; font-size: 0.85rem; font-weight: 600;">
                                        <i class="fas fa-clock"></i> Pending
                                    </span>
                                @endif
                            </div>

                            <!-- Your Message -->
                            <div style="margin-bottom: 1.5rem;">
                                <div style="background: rgba(10, 14, 26, 0.6); border-left: 3px solid rgba(164, 30, 52, 0.5); padding: 1rem; border-radius: 0.5rem;">
                                    <p style="color: var(--muted); margin: 0 0 0.5rem 0; font-size: 0.85rem; font-weight: 600;">
                                        <i class="fas fa-user"></i> Your Message:
                                    </p>
                                    <p style="color: var(--fg); margin: 0; line-height: 1.6; white-space: pre-wrap;">{{ $contact->message }}</p>
                                </div>
                            </div>

                            <!-- Admin Reply -->
                            @if($contact->admin_reply)
                                <div style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(5, 150, 105, 0.1)); border-left: 3px solid #10b981; padding: 1rem; border-radius: 0.5rem;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                                        <p style="color: #10b981; margin: 0; font-size: 0.85rem; font-weight: 600;">
                                            <i class="fas fa-reply"></i> Admin Reply:
                                        </p>
                                        <p style="color: var(--muted); margin: 0; font-size: 0.8rem;">
                                            <i class="fas fa-clock"></i> {{ $contact->replied_at->format('M d, Y \a\t h:i A') }}
                                        </p>
                                    </div>
                                    <p style="color: var(--fg); margin: 0; line-height: 1.6; white-space: pre-wrap;">{{ $contact->admin_reply }}</p>
                                </div>
                            @else
                                <div style="background: rgba(251, 191, 36, 0.1); border-left: 3px solid #fbbf24; padding: 1rem; border-radius: 0.5rem; text-align: center;">
                                    <p style="color: #fbbf24; margin: 0;">
                                        <i class="fas fa-hourglass-half"></i> Waiting for admin reply...
                                    </p>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($contacts->hasPages())
                    <div style="margin-top: 2rem;">
                        {{ $contacts->links() }}
                    </div>
                @endif
            @endif

            <!-- Send New Message Button -->
            <div style="margin-top: 2rem; text-align: center;">
                <a href="{{ route('contacts.create') }}" style="display: inline-block; padding: 0.875rem 2rem; background: linear-gradient(135deg, #a41e34, #d63447); color: white; border-radius: 0.5rem; text-decoration: none; font-weight: 600; box-shadow: 0 4px 12px rgba(164, 30, 52, 0.3); transition: all 0.3s ease;">
                    <i class="fas fa-paper-plane"></i> Send New Message
                </a>
            </div>
        </div>
    </main>

    @include('components.footer')
    
    <x-chatbot />
</body>
</html>
