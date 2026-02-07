<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    // Show booking form
    public function create(Car $car)
    {
        if (!$car->available) {
            return redirect()->route('cars.show', $car)
                ->with('error', 'This car is currently not available for booking.');
        }

        return view('bookings.create', compact('car'));
    }

    // Store booking
    public function store(Request $request, Car $car)
    {
        if (!$car->available) {
            return redirect()->route('cars.show', $car)
                ->with('error', 'This car is currently not available for booking.');
        }

        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'notes' => 'nullable|string|max:500',
        ]);

        // Calculate total days and price
        $startDate = Carbon::parse($validated['start_date']);
        $endDate = Carbon::parse($validated['end_date']);
        $totalDays = $startDate->diffInDays($endDate);
        $totalPrice = $totalDays * $car->price;

        // Create booking
        $booking = Booking::create([
            'car_id' => $car->id,
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'total_days' => $totalDays,
            'total_price' => $totalPrice,
            'notes' => $validated['notes'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('bookings.confirmation', $booking)
            ->with('success', 'Your booking request has been submitted successfully!');
    }

    // Show booking confirmation
    public function confirmation(Booking $booking)
    {
        return view('bookings.confirmation', compact('booking'));
    }

    // Admin - view all bookings
    public function adminIndex()
    {
        $bookings = Booking::with('car')->orderBy('created_at', 'desc')->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    // Admin - update booking status
    public function updateStatus(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        $booking->update(['status' => $validated['status']]);

        return back()->with('success', 'Booking status updated successfully!');
    }
}
