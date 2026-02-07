<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChatbotController;
use App\Models\Testimonial;
use App\Models\Car;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    $testimonials = Testimonial::with('user')
        ->where('status', 'approved')
        ->latest()
        ->take(6)
        ->get();
    
    // Get top 3 most rented cars
    $topCars = Car::select(
            'cars.id',
            'cars.name',
            'cars.category',
            'cars.image',
            'cars.seats',
            'cars.transmission',
            'cars.features',
            'cars.description',
            'cars.price',
            'cars.available',
            DB::raw('COUNT(bookings.id) as rental_count')
        )
        ->leftJoin('bookings', 'cars.id', '=', 'bookings.car_id')
        ->groupBy(
            'cars.id',
            'cars.name',
            'cars.category',
            'cars.image',
            'cars.seats',
            'cars.transmission',
            'cars.features',
            'cars.description',
            'cars.price',
            'cars.available'
        )
        ->orderBy('rental_count', 'desc')
        ->take(3)
        ->get();
    
    return view('index', compact('testimonials', 'topCars'));
})->name('home');

Route::get('/about', function () {
    // Calculate real statistics
    $stats = [
        'customers' => \App\Models\User::where('is_admin', false)->count(),
        'vehicles' => \App\Models\Car::count(),
        'bookings' => \App\Models\Booking::count(),
        'testimonials' => \App\Models\Testimonial::where('status', 'approved')->count(),
    ];
    
    return view('about', compact('stats'));
});

// User Authentication Routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Public Car Routes
Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.show');

// Booking Routes
Route::get('/cars/{car}/book', [BookingController::class, 'create'])->name('bookings.create');
Route::post('/cars/{car}/book', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/bookings/{booking}/confirmation', [BookingController::class, 'confirmation'])->name('bookings.confirmation');

// Admin Routes
Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::get('/admin/home', [AdminController::class, 'home'])->name('admin.home');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Admin Booking Management Routes
Route::patch('/admin/bookings/{booking}/approve', [AdminController::class, 'approveBooking'])->name('admin.bookings.approve');

// Admin Rentals Management Routes
Route::get('/admin/rentals/active', [AdminController::class, 'activeRentals'])->name('admin.rentals.active');
Route::get('/admin/rentals/history', [AdminController::class, 'rentalHistory'])->name('admin.rentals.history');
Route::patch('/admin/rentals/{booking}/complete', [AdminController::class, 'completeRental'])->name('admin.rentals.complete');

// Testimonial Routes (User)
Route::middleware(['auth'])->group(function () {
    Route::get('/testimonials/create', [TestimonialController::class, 'create'])->name('testimonials.create');
    Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');
});

// Contact Routes (User)
Route::get('/contact', [ContactController::class, 'create'])->name('contacts.create');
Route::middleware(['auth'])->group(function () {
    Route::post('/contact', [ContactController::class, 'store'])->name('contacts.store');
});

// Notification Routes (User)
Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', [NotificationController::class, 'all'])->name('notifications.all');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllRead');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
});

// User Profile & Account Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('user.profile.update');
    Route::get('/my-messages', [UserController::class, 'myMessages'])->name('user.messages');
    Route::get('/my-bookings', [UserController::class, 'myBookings'])->name('user.bookings');
});

// Chatbot Routes
Route::post('/chatbot/message', [ChatbotController::class, 'sendMessage'])->name('chatbot.message');

// Admin Testimonial Management Routes
Route::prefix('admin/testimonials')->name('admin.testimonials.')->group(function () {
    Route::get('/', [TestimonialController::class, 'index'])->name('index');
    Route::post('/{id}/approve', [TestimonialController::class, 'approve'])->name('approve');
    Route::post('/{id}/reject', [TestimonialController::class, 'reject'])->name('reject');
    Route::delete('/{id}', [TestimonialController::class, 'destroy'])->name('destroy');
});

// Admin Contact Management Routes
Route::prefix('admin/contacts')->name('admin.contacts.')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('index');
    Route::get('/{id}', [ContactController::class, 'show'])->name('show');
    Route::post('/{id}/reply', [ContactController::class, 'reply'])->name('reply');
    Route::delete('/{id}', [ContactController::class, 'destroy'])->name('destroy');
});

// Admin Account Management Routes
Route::get('/admin/accounts', [AdminController::class, 'manageAccounts'])->name('admin.accounts');
Route::post('/admin/accounts/register', [AdminController::class, 'registerAdmin'])->name('admin.accounts.register');
Route::delete('/admin/accounts/{user}', [AdminController::class, 'deleteAdmin'])->name('admin.accounts.delete');

// Admin Car Management Routes
Route::prefix('admin/cars')->name('admin.cars.')->group(function () {
    Route::get('/', [CarController::class, 'adminIndex'])->name('index');
    Route::get('/create', [CarController::class, 'create'])->name('create');
    Route::post('/', [CarController::class, 'store'])->name('store');
    Route::get('/{car}/edit', [CarController::class, 'edit'])->name('edit');
    Route::put('/{car}', [CarController::class, 'update'])->name('update');
    Route::delete('/{car}', [CarController::class, 'destroy'])->name('destroy');
    Route::patch('/{car}/toggle', [CarController::class, 'toggleAvailability'])->name('toggle');
});
