<aside class="sidebar">
    <div class="sidebar-header">
        <a href="/" class="brand">
          
            <span><span style="color: #a41e34;">Stacy</span>Garage</span>
        </a>
    </div>
    
    <nav class="sidebar-nav">
        <div class="nav-section">
            <div class="nav-section-title">Main</div>
            <a href="{{ route('admin.home') }}" class="nav-item {{ Request::is('admin/home') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-chart-line"></i></span>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.cars.index') }}" class="nav-item {{ Request::is('admin/cars*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-car"></i></span>
                <span>Vehicles</span>
            </a>
            <a href="{{ route('admin.rentals.active') }}" class="nav-item {{ Request::is('admin/rentals/active') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-car-side"></i></span>
                <span>Active Rentals</span>
            </a>
            <a href="{{ route('admin.rentals.history') }}" class="nav-item {{ Request::is('admin/rentals/history') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-history"></i></span>
                <span>Rental History</span>
            </a>
            <a href="{{ route('admin.testimonials.index') }}" class="nav-item {{ Request::is('admin/testimonials*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-comment-dots"></i></span>
                <span>Testimonials</span>
            </a>
            <a href="{{ route('admin.contacts.index') }}" class="nav-item {{ Request::is('admin/contacts*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-envelope"></i></span>
                <span>Contact Messages</span>
            </a>
            <a href="{{ route('admin.accounts') }}" class="nav-item {{ Request::is('admin/accounts*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-user-shield"></i></span>
                <span>Manage Accounts</span>
            </a>
        </div>
    </nav>
    
    <div class="sidebar-footer">
        <a href="{{ route('admin.logout') }}" class="nav-item" style="color: #ef4444;">
            <span class="nav-icon"><i class="fas fa-sign-out-alt"></i></span>
            <span>Logout</span>
        </a>
    </div>
</aside>
