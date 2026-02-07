<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Testimonial - StacyGarage</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --bg: #0a0e1a;
            --fg: #f5f5f5;
            --muted: #b0b0b0;
            --accent: #a41e34;
            --accent-light: #d63447;
            --accent-dark: #7a1628;
            --ring: rgba(164, 30, 52, 0.35);
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif;
            color: var(--fg);
            background: radial-gradient(1200px 600px at 70% -10%, rgba(164, 30, 52, 0.08), transparent 60%),
                        radial-gradient(800px 400px at 10% 10%, rgba(26, 31, 46, 0.5), transparent 60%),
                        var(--bg);
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
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--fg);
        }
        main {
            flex: 1;
            padding: 4rem 1rem;
        }
        .testimonial-form-container {
            max-width: 700px;
            margin: 0 auto;
            background: rgba(26, 31, 46, 0.6);
            border: 1px solid rgba(164, 30, 52, 0.3);
            border-radius: 1rem;
            padding: 2.5rem;
            backdrop-filter: blur(10px);
        }
        h1 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            color: var(--fg);
            text-align: center;
        }
        .subtitle {
            color: var(--muted);
            text-align: center;
            margin-bottom: 2rem;
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
        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #f87171;
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
        .rating-select {
            display: flex;
            gap: 0.5rem;
            flex-direction: row-reverse;
            justify-content: flex-end;
        }
        .rating-select input {
            display: none;
        }
        .rating-select label {
            font-size: 2rem;
            cursor: pointer;
            color: #4b5563;
            transition: all 0.2s;
        }
        .rating-select label:hover,
        .rating-select label:hover ~ label,
        .rating-select input:checked ~ label {
            color: #fbbf24;
        }
        textarea {
            width: 100%;
            padding: 0.875rem;
            background: rgba(10, 14, 26, 0.8);
            border: 1.5px solid rgba(164, 30, 52, 0.3);
            border-radius: 0.5rem;
            color: var(--fg);
            font-size: 1rem;
            resize: vertical;
            min-height: 150px;
            font-family: inherit;
        }
        textarea:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--ring);
        }
        .char-count {
            text-align: right;
            color: var(--muted);
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        .btn {
            padding: 0.875rem 2rem;
            border-radius: 0.5rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            color: white;
            box-shadow: 0 4px 12px rgba(164, 30, 52, 0.3);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(164, 30, 52, 0.4);
        }
        .btn-secondary {
            background: transparent;
            border: 1.5px solid rgba(164, 30, 52, 0.5);
            color: var(--fg);
        }
        .btn-secondary:hover {
            background: rgba(164, 30, 52, 0.1);
        }
        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }
        .form-actions button,
        .form-actions a {
            flex: 1;
            justify-content: center;
        }
    </style>
</head>
<body>
 
    <main>
        <div class="container">
            <div class="testimonial-form-container">
                <h1> Share Your Experience</h1>
                <p class="subtitle">Tell us about your experience with StacyGarage</p>

                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-error">
                        <ul style="list-style: none; padding: 0;">
                            @foreach($errors->all() as $error)
                                <li><i class="fas fa-exclamation-circle"></i> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('testimonials.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="rating">Your Rating</label>
                        <div class="rating-select">
                            <input type="radio" name="rating" id="star5" value="5" required>
                            <label for="star5" title="5 stars"><i class="fas fa-star"></i></label>
                            
                            <input type="radio" name="rating" id="star4" value="4">
                            <label for="star4" title="4 stars"><i class="fas fa-star"></i></label>
                            
                            <input type="radio" name="rating" id="star3" value="3">
                            <label for="star3" title="3 stars"><i class="fas fa-star"></i></label>
                            
                            <input type="radio" name="rating" id="star2" value="2">
                            <label for="star2" title="2 stars"><i class="fas fa-star"></i></label>
                            
                            <input type="radio" name="rating" id="star1" value="1">
                            <label for="star1" title="1 star"><i class="fas fa-star"></i></label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message">Your Testimonial</label>
                        <textarea 
                            name="message" 
                            id="message" 
                            maxlength="500" 
                            placeholder="Share your experience with us..." 
                            required
                            oninput="updateCharCount()"
                        >{{ old('message') }}</textarea>
                        <div class="char-count">
                            <span id="charCount">0</span>/500 characters
                        </div>
                    </div>

                    <div class="form-actions">
                        <a href="/" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i> Submit Testimonial
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        function updateCharCount() {
            const textarea = document.getElementById('message');
            const charCount = document.getElementById('charCount');
            charCount.textContent = textarea.value.length;
        }

        // Initialize character count
        updateCharCount();
    </script>
</body>
</html>
