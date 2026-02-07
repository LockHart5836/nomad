<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestimonialController extends Controller
{
    // Show testimonial submission form
    public function create()
    {
        return view('testimonials.create');
    }

    // Store testimonial
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:500',
            'rating' => 'required|integer|min:1|max:5'
        ]);

        Testimonial::create([
            'user_id' => Auth::id(),
            'message' => $request->message,
            'rating' => $request->rating,
            'status' => 'pending'
        ]);

        return redirect()->back()->with('success', 'Thank you! Your testimonial has been submitted and is pending approval.');
    }

    // Show all testimonials for admin
    public function index()
    {
        $pending = Testimonial::with('user')->where('status', 'pending')->latest()->get();
        $approved = Testimonial::with('user')->where('status', 'approved')->latest()->get();
        
        return view('admin.testimonials.index', compact('pending', 'approved'));
    }

    // Approve testimonial
    public function approve($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'Testimonial approved successfully!');
    }

    // Reject testimonial
    public function reject($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Testimonial rejected.');
    }

    // Delete testimonial
    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();

        return redirect()->back()->with('success', 'Testimonial deleted successfully!');
    }
}
