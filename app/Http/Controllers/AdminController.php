<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Booking;
use App\Models\Car;
use App\Models\User;

class AdminController extends Controller
{
    // Show login form
    public function showLogin()
    {
        return view('admin.login');
    }

    // Handle login submission
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // For now, using simple hardcoded check
        // Later you can implement proper authentication
        if ($request->email === 'admin@stacygarage.com' && $request->password === 'admin123') {
            // Store admin session
            session(['admin_logged_in' => true, 'admin_email' => $request->email]);
            
            return redirect()->route('admin.home');
        }

        return back()->with('error', 'Invalid credentials. Please try again.');
    }

    // Show admin home/dashboard
    public function home()
    {
        // Check if admin is logged in
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        // Fetch recent pending bookings
        $recentBookings = Booking::with('car')
            ->whereNotIn('status', ['completed', 'cancelled'])
            ->latest()
            ->take(5)
            ->get();

        // Get statistics
        $totalCars = Car::count();
        $availableCars = Car::where('available', true)->count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $confirmedBookings = Booking::where('status', 'confirmed')->count();
        $totalBookings = Booking::count();

        return view('admin.home', compact('recentBookings', 'totalCars', 'availableCars', 'pendingBookings', 'confirmedBookings', 'totalBookings'));
    }

    // Handle logout
    public function logout()
    {
        session()->forget(['admin_logged_in', 'admin_email']);
        return redirect()->route('admin.login')->with('error', 'You have been logged out.');
    }

    // Approve booking and send notification
    public function approveBooking(Booking $booking)
    {
        // Check if admin is logged in
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        // Update booking status to confirmed
        $booking->update(['status' => 'confirmed']);

        // Make the car unavailable (in use)
        $booking->car->update(['available' => false]);

        // Find user by email and send notification
        $user = \App\Models\User::where('email', $booking->customer_email)->first();
        
        if ($user) {
            // Create notification for the user
            \App\Models\Notification::create([
                'user_id' => $user->id,
                'type' => 'booking_approved',
                'title' => 'Booking Confirmed!',
                'message' => "Your booking for {$booking->car->make} {$booking->car->model} has been confirmed! Pickup date: {$booking->start_date->format('M d, Y')}. Total: \${$booking->total_price}",
                'is_read' => false
            ]);
            
            return redirect()->route('admin.home')
                ->with('success', 'Booking approved and notification sent to ' . $booking->customer_name);
        } else {
            // User not registered in system (booked as guest)
            return redirect()->route('admin.home')
                ->with('success', 'Booking approved! Note: Customer ' . $booking->customer_email . ' is not a registered user, so no notification was sent.');
        }
    }

    // Show active rentals (confirmed bookings with cars in use)
    public function activeRentals()
    {
        // Check if admin is logged in
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        // Get all confirmed bookings (cars currently in use)
        $activeRentals = Booking::with('car')
            ->where('status', 'confirmed')
            ->latest()
            ->get();

        return view('admin.rentals.active', compact('activeRentals'));
    }

    // Complete rental and make car available again
    public function completeRental(Booking $booking)
    {
        // Check if admin is logged in
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        // Update booking status to completed
        $booking->update(['status' => 'completed']);

        // Make the car available again
        $booking->car->update(['available' => true]);

        return redirect()->route('admin.rentals.active')
            ->with('success', 'Rental completed! ' . $booking->car->name . ' is now available for booking.');
    }

    // Show rental history (all completed transactions)
    public function rentalHistory()
    {
        // Check if admin is logged in
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        // Get all completed bookings with timestamps
        $completedRentals = Booking::with('car')
            ->where('status', 'completed')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('admin.rentals.history', compact('completedRentals'));
    }

    // Show manage accounts page
    public function manageAccounts()
    {
        // Check if admin is logged in
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        // Get all admin users
        $admins = User::where('is_admin', true)->orderBy('created_at', 'desc')->get();

        return view('admin.accounts.index', compact('admins'));
    }

    // Register a new admin account
    public function registerAdmin(Request $request)
    {
        // Check if admin is logged in
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create new admin user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => true,
        ]);

        return redirect()->route('admin.accounts')
            ->with('success', 'Admin account created successfully!');
    }

    // Delete an admin account
    public function deleteAdmin(User $user)
    {
        // Check if admin is logged in
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        // Prevent deleting yourself
        if ($user->email === session('admin_email')) {
            return redirect()->route('admin.accounts')
                ->with('error', 'You cannot delete your own account!');
        }

        // Delete the admin user
        $user->delete();

        return redirect()->route('admin.accounts')
            ->with('success', 'Admin account deleted successfully!');
    }
}
