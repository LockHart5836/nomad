<header>
    <div class="container">
        <nav class="nav">
            <a href="/" class="brand" style="pointer-events: auto; text-decoration: none;">
                <span><span style="color: #a41e34;">Stacy</span>Garage</span>
            </a>

            <!-- Mobile Menu Toggle -->
            <button class="mobile-menu-toggle" onclick="toggleMobileMenu()" style="display: none; background: none; border: none; color: var(--fg); font-size: 1.5rem; cursor: pointer; padding: 0.5rem;">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Desktop Navigation -->
            <div class="nav-links" id="navLinks" style="display: flex; align-items: center; gap: 1rem;">
                <a href="/" class="nav-link">Home</a>
                <a href="{{ route('cars.index') }}" class="nav-link">Cars</a>
              
                <a href="/#testimonials" class="nav-link">Reviews</a>
                <a href="/contact" class="nav-link">Contact</a>
                <a href="/about" class="nav-link">About</a>

                @auth
                    <!-- Notification Bell -->
                    <div class="notification-menu" style="position: relative; display: inline-block; margin-left: 1rem;">
                        <button onclick="toggleNotifications()" class="notification-btn" style="position: relative; background: rgba(164, 30, 52, 0.1); border: 1px solid rgba(164, 30, 52, 0.3); padding: 0.5rem 0.75rem; border-radius: 0.5rem; cursor: pointer; color: var(--fg);">
                            <i class="fas fa-bell" style="font-size: 1.2rem;"></i>
                            @if(Auth::user()->notifications()->where('is_read', false)->count() > 0)
                                <span class="notification-badge" style="position: absolute; top: -5px; right: -5px; background: #ef4444; color: white; padding: 0.15rem 0.4rem; border-radius: 50%; font-size: 0.7rem; font-weight: 700; min-width: 18px; text-align: center;">
                                    {{ Auth::user()->notifications()->where('is_read', false)->count() }}
                                </span>
                            @endif
                        </button>
                        <div id="notificationDropdown" class="notification-dropdown" style="display: none; position: absolute; right: 0; top: 100%; margin-top: 0.5rem; background: rgba(26, 31, 46, 0.98); border: 1px solid rgba(164, 30, 52, 0.3); border-radius: 0.75rem; width: 380px; max-width: 90vw; max-height: 500px; overflow-y: auto; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5); z-index: 100;">
                            <div style="padding: 1rem; border-bottom: 1px solid rgba(164, 30, 52, 0.3); display: flex; justify-content: space-between; align-items: center;">
                                <h3 style="margin: 0; font-size: 1rem; color: var(--fg);">
                                    <i class="fas fa-bell"></i> Notifications
                                </h3>
                                @if(Auth::user()->notifications()->where('is_read', false)->count() > 0)
                                    <button onclick="markAllAsRead()" style="background: transparent; border: none; color: var(--accent); cursor: pointer; font-size: 0.85rem; text-decoration: underline;">
                                        Mark all read
                                    </button>
                                @endif
                            </div>
                            
                            @php
                                $userNotifications = Auth::user()->notifications()->latest()->take(5)->get();
                            @endphp
                            
                            @if($userNotifications->isEmpty())
                                <div style="padding: 2rem; text-align: center; color: var(--muted);">
                                    <i class="fas fa-bell-slash" style="font-size: 2rem; opacity: 0.3; margin-bottom: 0.5rem;"></i>
                                    <p style="margin: 0;">No notifications yet</p>
                                </div>
                            @else
                                @foreach($userNotifications as $notification)
                                    <div class="notification-item" onclick="markNotificationAsRead({{ $notification->id }})" style="padding: 1rem; border-bottom: 1px solid rgba(164, 30, 52, 0.2); cursor: pointer; {{ $notification->is_read ? 'opacity: 0.6;' : 'background: rgba(164, 30, 52, 0.05);' }} transition: all 0.2s;">
                                        <div style="display: flex; gap: 0.75rem;">
                                            <div style="flex-shrink: 0;">
                                                @if($notification->type === 'contact_reply')
                                                    <div style="width: 36px; height: 36px; background: linear-gradient(135deg, #3b82f6, #2563eb); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                        <i class="fas fa-reply" style="color: white; font-size: 0.9rem;"></i>
                                                    </div>
                                                @elseif($notification->type === 'booking_approved')
                                                    <div style="width: 36px; height: 36px; background: linear-gradient(135deg, #10b981, #059669); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                        <i class="fas fa-check-circle" style="color: white; font-size: 0.9rem;"></i>
                                                    </div>
                                                @else
                                                    <div style="width: 36px; height: 36px; background: linear-gradient(135deg, var(--accent), var(--accent-light)); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                        <i class="fas fa-info-circle" style="color: white; font-size: 0.9rem;"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div style="flex: 1; min-width: 0;">
                                                <h4 style="margin: 0 0 0.25rem 0; font-size: 0.9rem; color: var(--fg); font-weight: 600;">
                                                    {{ $notification->title }}
                                                </h4>
                                                <p style="margin: 0 0 0.5rem 0; font-size: 0.85rem; color: var(--muted); line-height: 1.4;">
                                                    {{ Str::limit($notification->message, 80) }}
                                                </p>
                                                <span style="font-size: 0.75rem; color: var(--muted);">
                                                    <i class="fas fa-clock"></i> {{ $notification->created_at->diffForHumans() }}
                                                </span>
                                            </div>
                                            @if(!$notification->is_read)
                                                <div style="flex-shrink: 0;">
                                                    <span style="width: 8px; height: 8px; background: #ef4444; border-radius: 50%; display: block;"></span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                                
                                <a href="{{ route('notifications.all') }}" style="display: block; padding: 0.75rem; text-align: center; color: var(--accent); text-decoration: none; font-weight: 600; font-size: 0.9rem; border-top: 1px solid rgba(164, 30, 52, 0.2);">
                                    View All Notifications
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- User Menu -->
                    <div class="user-menu" style="position: relative; display: inline-block; margin-left: 0.5rem;">
                        <button onclick="toggleUserMenu()" class="user-btn" style="display: flex; align-items: center; gap: 0.5rem; background: rgba(164, 30, 52, 0.1); border: 1px solid rgba(164, 30, 52, 0.3); padding: 0.5rem 1rem; border-radius: 0.5rem; cursor: pointer; color: var(--fg); font-weight: 600;">
                            <i class="fas fa-user-circle" style="font-size: 1.2rem;"></i>
                            <span class="user-name-desktop">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down" style="font-size: 0.8rem;"></i>
                        </button>
                        <div id="userDropdown" class="user-dropdown" style="display: none; position: absolute; right: 0; top: 100%; margin-top: 0.5rem; background: rgba(26, 31, 46, 0.95); border: 1px solid rgba(164, 30, 52, 0.3); border-radius: 0.5rem; min-width: 200px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5); z-index: 100;">
                            <a href="{{ route('user.profile') }}" style="display: block; padding: 0.75rem 1rem; color: var(--muted); text-decoration: none; border-bottom: 1px solid rgba(164, 30, 52, 0.2);">
                                <i class="fas fa-user me-2"></i>ㅤMy Profile
                            </a>
                            <a href="{{ route('user.bookings') }}" style="display: block; padding: 0.75rem 1rem; color: var(--muted); text-decoration: none; border-bottom: 1px solid rgba(164, 30, 52, 0.2);">
                                <i class="fas fa-calendar me-2"></i>ㅤMy Bookings
                            </a>
                            <a href="{{ route('user.messages') }}" style="display: block; padding: 0.75rem 1rem; color: var(--muted); text-decoration: none; border-bottom: 1px solid rgba(164, 30, 52, 0.2);">
                                <i class="fas fa-envelope me-2"></i>ㅤMy Messages
                            </a>
                            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" style="width: 100%; text-align: center; padding: 0.75rem 1rem; background: none; border: none; color: #ef4444; cursor: pointer; font-size: 1rem;">
                                    <i class="fas fa-sign-out-alt me-2"></i>ㅤLogout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn-login" style="margin-left: 1rem; padding: 0.5rem 1.25rem; background: transparent; border: 1.5px solid #a41e34; color: var(--fg); border-radius: 0.5rem; text-decoration: none; font-weight: 600; transition: all 0.3s ease;">
                        <i class="fas fa-sign-in-alt me-1"></i><span class="login-text">   Login</span>
                    </a>
                    <a href="{{ route('register') }}" class="btn-register" style="padding: 0.5rem 1.25rem; background: linear-gradient(135deg, #a41e34, #d63447); color: white; border-radius: 0.5rem; text-decoration: none; font-weight: 600; box-shadow: 0 4px 12px rgba(164, 30, 52, 0.3); transition: all 0.3s ease;">
                        <i class="fas fa-user-plus me-1"></i><span class="register-text">   Register</span>
                    </a>
                @endauth
            </div>
        </nav>
    </div>
</header>

<script>
    function toggleMobileMenu() {
        const navLinks = document.getElementById('navLinks');
        const menuToggle = document.querySelector('.mobile-menu-toggle i');
        
        if (navLinks.style.display === 'flex' || navLinks.style.display === '') {
            navLinks.style.display = 'none';
            menuToggle.classList.remove('fa-times');
            menuToggle.classList.add('fa-bars');
        } else {
            navLinks.style.display = 'flex';
            menuToggle.classList.remove('fa-bars');
            menuToggle.classList.add('fa-times');
        }
    }

    function toggleUserMenu() {
        const dropdown = document.getElementById('userDropdown');
        const notifDropdown = document.getElementById('notificationDropdown');
        
        // Close notifications if open
        if (notifDropdown) {
            notifDropdown.style.display = 'none';
        }
        
        dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
    }

    function toggleNotifications() {
        const dropdown = document.getElementById('notificationDropdown');
        const userDropdown = document.getElementById('userDropdown');
        
        // Close user menu if open
        if (userDropdown) {
            userDropdown.style.display = 'none';
        }
        
        dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
    }

    function markNotificationAsRead(notificationId) {
        fetch(`/notifications/${notificationId}/read`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Reload page to update notification badge
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
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}'
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

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(event) {
        const userMenu = document.querySelector('.user-menu');
        const notificationMenu = document.querySelector('.notification-menu');
        const mobileToggle = document.querySelector('.mobile-menu-toggle');
        const navLinks = document.getElementById('navLinks');
        
        if (userMenu && !userMenu.contains(event.target)) {
            document.getElementById('userDropdown').style.display = 'none';
        }
        
        if (notificationMenu && !notificationMenu.contains(event.target)) {
            const notifDropdown = document.getElementById('notificationDropdown');
            if (notifDropdown) {
                notifDropdown.style.display = 'none';
            }
        }

        // Close mobile menu when clicking outside
        if (window.innerWidth <= 768 && 
            !navLinks.contains(event.target) && 
            !mobileToggle.contains(event.target) &&
            navLinks.style.display === 'flex') {
            navLinks.style.display = 'none';
            document.querySelector('.mobile-menu-toggle i').classList.remove('fa-times');
            document.querySelector('.mobile-menu-toggle i').classList.add('fa-bars');
        }
    });

    // Handle window resize
    window.addEventListener('resize', function() {
        const navLinks = document.getElementById('navLinks');
        if (window.innerWidth > 768) {
            navLinks.style.display = 'flex';
            document.querySelector('.mobile-menu-toggle i').classList.remove('fa-times');
            document.querySelector('.mobile-menu-toggle i').classList.add('fa-bars');
        } else if (navLinks.style.display === 'flex') {
            navLinks.style.display = 'none';
        }
    });
</script>
  
</script>

<style>
    .btn-login:hover {
        background: rgba(164, 30, 52, 0.1);
        transform: translateY(-2px);
    }

    .btn-register:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(164, 30, 52, 0.4);
    }

    .notification-btn:hover {
        background: rgba(164, 30, 52, 0.2);
        transform: scale(1.05);
    }

    .user-btn:hover {
        background: rgba(164, 30, 52, 0.2);
    }

    .user-dropdown a:hover {
        background: rgba(164, 30, 52, 0.1);
        color: var(--accent-light);
    }

    .user-dropdown button:hover {
        background: rgba(239, 68, 68, 0.1);
    }

    .notification-item:hover {
        background: rgba(164, 30, 52, 0.1) !important;
    }

    .notification-dropdown::-webkit-scrollbar {
        width: 8px;
    }

    .notification-dropdown::-webkit-scrollbar-track {
        background: rgba(10, 14, 26, 0.5);
        border-radius: 4px;
    }

    .notification-dropdown::-webkit-scrollbar-thumb {
        background: rgba(164, 30, 52, 0.5);
        border-radius: 4px;
    }

    .notification-dropdown::-webkit-scrollbar-thumb:hover {
        background: rgba(164, 30, 52, 0.7);
    }

    /* Mobile Responsive Styles */
    @media (max-width: 768px) {
        .mobile-menu-toggle {
            display: block !important;
        }

        .nav-links {
            display: none !important;
            position: fixed;
            top: 64px;
            left: 0;
            right: 0;
            flex-direction: column !important;
            background: rgba(10, 14, 26, 0.98);
            border-bottom: 2px solid rgba(164, 30, 52, 0.3);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            padding: 1rem 0;
            gap: 0 !important;
            z-index: 99;
            max-height: calc(100vh - 64px);
            overflow-y: auto;
        }

        .nav-links a.nav-link {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid rgba(164, 30, 52, 0.1);
            width: 100%;
            text-align: left;
        }

        .nav-links a.nav-link:hover {
            background: rgba(164, 30, 52, 0.1);
        }

        .notification-menu, 
        .user-menu {
            width: 100%;
            margin: 0 !important;
            padding: 0.5rem 1.5rem;
        }

        .notification-btn,
        .user-btn {
            width: 100%;
            justify-content: flex-start;
        }

        .notification-dropdown,
        .user-dropdown {
            position: static !important;
            width: 100% !important;
            margin-top: 0.5rem !important;
            border-radius: 0.5rem;
        }

        .user-name-desktop {
            display: inline !important;
        }

        .login-text,
        .register-text {
            display: inline !important;
        }
    }

    @media (max-width: 480px) {
        header .container {
            padding: 0 1rem;
        }

        .brand span {
            font-size: 1.2rem;
        }

        .notification-dropdown {
            max-width: 95vw !important;
        }

        .notification-item {
            padding: 0.75rem !important;
        }

        .notification-item h4 {
            font-size: 0.85rem !important;
        }

        .notification-item p {
            font-size: 0.8rem !important;
        }
    }

    @media (min-width: 769px) {
        .nav-links {
            display: flex !important;
        }
    }
</style>

