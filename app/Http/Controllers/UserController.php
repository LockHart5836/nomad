<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Contact;
use App\Models\Booking;

class UserController extends Controller
{
    // Show user profile
    public function profile()
    {
        return view('user.profile');
    }

    // Update user profile
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        
        if ($request->filled('phone')) {
            $user->phone = $request->phone;
        }
        
        if ($request->filled('address')) {
            $user->address = $request->address;
        }

        // Update password if provided
        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect']);
            }
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully!');
    }

    // Show user's contact messages (with admin replies)
    public function myMessages()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $contacts = $user->contacts()->orderBy('created_at', 'desc')->paginate(10);
        
        return view('user.messages', compact('contacts'));
    }

    // Show user's bookings
    public function myBookings()
    {
        $user = Auth::user();
        $bookings = Booking::where('customer_email', $user->email)
            ->with('car')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('user.bookings', compact('bookings'));
    }
}
