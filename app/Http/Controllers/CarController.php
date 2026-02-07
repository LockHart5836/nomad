<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    // Public page - display all cars with filtering
    public function index(Request $request)
    {
        $category = $request->get('category');
        $availability = $request->get('availability');

        $cars = Car::query()
            ->when($category, function ($query) use ($category) {
                return $query->byCategory($category);
            })
            ->when($availability === 'available', function ($query) {
                return $query->available();
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $categories = Car::distinct()->pluck('category');

        return view('cars.index', compact('cars', 'categories', 'category'));
    }

    // Show single car details
    public function show(Car $car)
    {
        return view('cars.show', compact('car'));
    }

    // Admin - list all cars
    public function adminIndex()
    {
        $cars = Car::orderBy('created_at', 'desc')->get();
        return view('admin.cars.index', compact('cars'));
    }

    // Admin - show create form
    public function create()
    {
        return view('admin.cars.create');
    }

    // Admin - store new car
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'seats' => 'required|integer|min:1',
            'transmission' => 'required|string|max:255',
            'features' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'available' => 'boolean',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('cars', 'public');
            $validated['image'] = $imagePath;
        }

        Car::create($validated);

        return redirect()->route('admin.cars.index')
            ->with('success', 'Car added successfully!');
    }

    // Admin - show edit form
    public function edit(Car $car)
    {
        return view('admin.cars.edit', compact('car'));
    }

    // Admin - update car
    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'seats' => 'required|integer|min:1',
            'transmission' => 'required|string|max:255',
            'features' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'available' => 'boolean',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($car->image && Storage::disk('public')->exists($car->image)) {
                Storage::disk('public')->delete($car->image);
            }
            $imagePath = $request->file('image')->store('cars', 'public');
            $validated['image'] = $imagePath;
        }

        $car->update($validated);

        return redirect()->route('admin.cars.index')
            ->with('success', 'Car updated successfully!');
    }

    // Admin - delete car
    public function destroy(Car $car)
    {
        // Delete image if exists
        if ($car->image && Storage::disk('public')->exists($car->image)) {
            Storage::disk('public')->delete($car->image);
        }

        $car->delete();

        return redirect()->route('admin.cars.index')
            ->with('success', 'Car deleted successfully!');
    }

    // Admin - toggle availability
    public function toggleAvailability(Car $car)
    {
        $car->update(['available' => !$car->available]);

        return back()->with('success', 'Car availability updated!');
    }
}
