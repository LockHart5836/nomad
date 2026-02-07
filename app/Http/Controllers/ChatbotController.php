<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Car;
use App\Models\Booking;
use App\Models\User;

class ChatbotController extends Controller
{
    private function getWebsiteContext()
    {
        // Get all cars with their details
        $cars = Car::all();
        $availableCars = Car::where('available', true)->get();
        
        // Get statistics
        $totalCars = $cars->count();
        $totalBookings = Booking::count();
        $totalCustomers = User::where('role', 'customer')->count();
        
        // Build comprehensive context
        $context = "StacyGarage Website Information:\n\n";
        
        // Company Info
        $context .= "ABOUT STACYGARAGE:\n";
        $context .= "StacyGarage is a premium car rental service in the Philippines. ";
        $context .= "We started as a small family-owned business with a passion for automobiles and customer service. ";
        $context .= "We provide exceptional car rental experiences through quality vehicles, transparent pricing, and personalized service.\n\n";
        
        // Statistics
        $context .= "COMPANY STATISTICS:\n";
        $context .= "- Total Vehicles: {$totalCars}\n";
        $context .= "- Total Bookings: {$totalBookings}+\n";
        $context .= "- Happy Customers: {$totalCustomers}+\n";
        $context .= "- Operating Hours: 24/7\n\n";
        
        // Contact Information
        $context .= "CONTACT INFORMATION:\n";
        $context .= "- Phone: +63 123 456 7890\n";
        $context .= "- Email: info@stacygarage.com\n";
        $context .= "- Address: 123 Main Street, Manila, Philippines\n";
        $context .= "- Social Media: Facebook, Instagram, Twitter, LinkedIn, YouTube\n\n";
        
        // Car Fleet Details
        $context .= "AVAILABLE VEHICLES (Current Fleet):\n\n";
        
        foreach ($availableCars as $car) {
            $context .= "Car: {$car->name}\n";
            $context .= "- Category: {$car->category}\n";
            $context .= "- Price: ₱" . number_format($car->price, 2) . " per day\n";
            $context .= "- Seats: {$car->seats} passengers\n";
            $context .= "- Transmission: {$car->transmission}\n";
            $context .= "- Features: {$car->features}\n";
            if ($car->description) {
                $context .= "- Description: {$car->description}\n";
            }
            $context .= "- Availability: " . ($car->available ? "Available Now" : "Currently Rented") . "\n\n";
        }
        
        // Pricing Categories
        $economyCars = $cars->where('category', 'Economy');
        $sedanCars = $cars->where('category', 'Sedan');
        $suvCars = $cars->where('category', 'SUV');
        $luxuryCars = $cars->where('category', 'Luxury');
        
        $context .= "PRICING BY CATEGORY:\n";
        if ($economyCars->count() > 0) {
            $avgEconomy = $economyCars->avg('price');
            $context .= "- Economy Cars: From ₱" . number_format($economyCars->min('price'), 2) . " per day\n";
        }
        if ($sedanCars->count() > 0) {
            $context .= "- Sedan Cars: From ₱" . number_format($sedanCars->min('price'), 2) . " per day\n";
        }
        if ($suvCars->count() > 0) {
            $context .= "- SUV Cars: From ₱" . number_format($suvCars->min('price'), 2) . " per day\n";
        }
        if ($luxuryCars->count() > 0) {
            $context .= "- Luxury Cars: From ₱" . number_format($luxuryCars->min('price'), 2) . " per day\n";
        }
        $context .= "\n";
        
        // Rental Requirements
        $context .= "RENTAL REQUIREMENTS:\n";
        $context .= "1. Valid driver's license\n";
        $context .= "2. Government-issued ID\n";
        $context .= "3. Proof of address\n";
        $context .= "4. Credit/debit card for security deposit\n\n";
        
        // Booking Process
        $context .= "HOW TO BOOK:\n";
        $context .= "1. Browse our Cars page to see all available vehicles\n";
        $context .= "2. Select your preferred vehicle\n";
        $context .= "3. Click 'Book Now' button\n";
        $context .= "4. Fill in rental dates (pickup and return)\n";
        $context .= "5. Provide your personal information\n";
        $context .= "6. Submit booking - we'll confirm within 24 hours\n\n";
        
        // Core Values
        $context .= "OUR CORE VALUES:\n";
        $context .= "- Excellence: Highest standards in vehicle quality and service\n";
        $context .= "- Integrity: Transparent pricing and honest communication\n";
        $context .= "- Safety: All vehicles undergo regular maintenance and inspections\n\n";
        
        // Services
        $context .= "SERVICES OFFERED:\n";
        $context .= "- Daily car rentals\n";
        $context .= "- Weekly and monthly rentals (discounted rates)\n";
        $context .= "- Airport pickup/drop-off\n";
        $context .= "- Chauffeur services available\n";
        $context .= "- 24/7 customer support\n";
        $context .= "- Insurance coverage included\n";
        $context .= "- Roadside assistance\n\n";
        
        return $context;
    }
    
    private function getIntelligentLocalResponse($message, $websiteContext)
    {
        $message = strtolower($message);
        
        // Get real-time data
        $cars = Car::all();
        $availableCars = Car::where('available', true)->get();
        $totalCars = $cars->count();
        
        // Greeting responses
        if (preg_match('/\b(hello|hi|hey|greetings)\b/i', $message)) {
            return "Hello! Welcome to StacyGarage. I'm your AI assistant with complete knowledge of our fleet and services. We currently have {$totalCars} vehicles in our fleet with " . $availableCars->count() . " available now. How can I help you today?";
        }
        
        // Check for specific car name mentions (exact matching)
        foreach ($cars as $car) {
            $carNameLower = strtolower($car->name);
            // Check if the specific car name is mentioned
            if (strpos($message, $carNameLower) !== false) {
                $imageUrl = asset('storage/' . $car->image);
                $response = "Here's information about the {$car->name}:\n\n";
                $response .= "Image: {$imageUrl}\n\n";
                $response .= "Price: P" . number_format($car->price, 2) . " per day\n";
                $response .= "Category: {$car->category}\n";
                $response .= "Seats: {$car->seats} passengers\n";
                $response .= "Transmission: {$car->transmission}\n";
                $response .= "Features: {$car->features}\n";
                if ($car->description) {
                    $response .= "Description: {$car->description}\n";
                }
                $response .= "Status: " . ($car->available ? "Available Now - Ready to book!" : "Currently Rented") . "\n\n";
                
                if ($car->available) {
                    $response .= "Ready to book this vehicle? Visit our Cars page or let me know if you need more information!";
                } else {
                    $response .= "This vehicle is currently rented. Would you like to see other available options?";
                }
                
                return $response;
            }
        }
        
        // Brand-specific inquiry with exact matching
        if (preg_match('/\b(ford)\b/i', $message)) {
            $fordCars = $cars->filter(function($car) {
                return stripos($car->name, 'ford') !== false;
            });
            
            if ($fordCars->isEmpty()) {
                return "I don't see any Ford vehicles in our current fleet. We have: " . $cars->pluck('name')->implode(', ') . ". Would you like to know about any of these vehicles?";
            }
            
            $response = "Here are our Ford vehicles:\n\n";
            foreach ($fordCars as $car) {
                $imageUrl = asset('storage/' . $car->image);
                $response .= "Vehicle: {$car->name}\n";
                $response .= "Image: {$imageUrl}\n";
                $response .= "Price: P" . number_format($car->price, 2) . "/day\n";
                $response .= "Seats: {$car->seats} | Transmission: {$car->transmission}\n";
                $response .= "Status: " . ($car->available ? "Available" : "Currently Rented") . "\n\n";
            }
            
            // Check for mustang specifically
            if (preg_match('/\bmustang\b/i', $message)) {
                $hasMustang = $fordCars->filter(function($car) {
                    return stripos($car->name, 'mustang') !== false;
                })->count() > 0;
                
                if (!$hasMustang) {
                    $response .= "Note: We don't have a Ford Mustang in our fleet. ";
                    $raptorExists = $fordCars->filter(function($car) {
                        return stripos($car->name, 'raptor') !== false;
                    })->count() > 0;
                    
                    if ($raptorExists) {
                        $response .= "However, we do have the powerful Ford Raptor listed above!";
                    }
                }
            }
            
            return $response;
        }
        
        // Handle Toyota inquiries
        if (preg_match('/\b(toyota)\b/i', $message)) {
            $toyotaCars = $cars->filter(function($car) {
                return stripos($car->name, 'toyota') !== false;
            });
            
            if ($toyotaCars->isEmpty()) {
                return "We don't have any Toyota vehicles in our current fleet. Our available vehicles include: " . $cars->pluck('name')->implode(', ') . ". Which one would you like to know more about?";
            }
            
            $response = "Here are our Toyota vehicles:\n\n";
            foreach ($toyotaCars as $car) {
                $imageUrl = asset('storage/' . $car->image);
                $response .= "Vehicle: {$car->name}\n";
                $response .= "Image: {$imageUrl}\n";
                $response .= "Price: P" . number_format($car->price, 2) . "/day\n";
                $response .= "Seats: {$car->seats} | Transmission: {$car->transmission}\n";
                $response .= "Status: " . ($car->available ? "Available" : "Currently Rented") . "\n\n";
            }
            return $response;
        }
        
        // Handle Honda inquiries
        if (preg_match('/\b(honda)\b/i', $message)) {
            $hondaCars = $cars->filter(function($car) {
                return stripos($car->name, 'honda') !== false;
            });
            
            if ($hondaCars->isEmpty()) {
                return "We don't have any Honda vehicles at the moment. Our fleet includes: " . $cars->pluck('name')->implode(', ') . ". Would you like details about any of these?";
            }
            
            $response = "Here are our Honda vehicles:\n\n";
            foreach ($hondaCars as $car) {
                $imageUrl = asset('storage/' . $car->image);
                $response .= "Vehicle: {$car->name}\n";
                $response .= "Image: {$imageUrl}\n";
                $response .= "Price: P" . number_format($car->price, 2) . "/day\n";
                $response .= "Seats: {$car->seats} | Transmission: {$car->transmission}\n";
                $response .= "Status: " . ($car->available ? "Available" : "Currently Rented") . "\n\n";
            }
            return $response;
        }
        
        // Car availability and listing with images
        if (preg_match('/\b(available|cars|vehicles|fleet|show me|what cars|list)\b/i', $message)) {
            if ($availableCars->isEmpty()) {
                return "Currently, all our vehicles are rented out. Our fleet includes: " . $cars->pluck('name')->implode(', ') . ". Please check back soon or I can help you with information about specific vehicles for future bookings.";
            }
            
            $response = "We have {$availableCars->count()} vehicle" . ($availableCars->count() > 1 ? 's' : '') . " available right now:\n\n";
            foreach ($availableCars->take(10) as $car) {
                $imageUrl = asset('storage/' . $car->image);
                $response .= "Vehicle: {$car->name}\n";
                $response .= "Image: {$imageUrl}\n";
                $response .= "Category: {$car->category} | Price: P" . number_format($car->price, 2) . "/day\n";
                $response .= "Seats: {$car->seats} | Transmission: {$car->transmission}\n";
                $response .= "Features: {$car->features}\n\n";
            }
            $response .= "Visit our Cars page to see detailed information and book online!";
            return $response;
        }
        
        // Category-specific inquiry with images
        if (preg_match('/\b(economy|sedan|suv|luxury)\b/i', $message, $matches)) {
            $category = ucfirst($matches[0]);
            $categoryCars = $cars->where('category', $category);
            
            if ($categoryCars->isEmpty()) {
                $availableCategories = $cars->pluck('category')->unique()->implode(', ');
                return "We don't have {$category} vehicles at the moment. Our categories include: {$availableCategories}. Which category interests you?";
            }
            
            $response = "{$category} vehicles in our fleet:\n\n";
            foreach ($categoryCars as $car) {
                $imageUrl = asset('storage/' . $car->image);
                $response .= "Vehicle: {$car->name}\n";
                $response .= "Image: {$imageUrl}\n";
                $response .= "Price: P" . number_format($car->price, 2) . "/day\n";
                $response .= "Seats: {$car->seats} | Transmission: {$car->transmission}\n";
                $response .= "Status: " . ($car->available ? "Available" : "Currently rented") . "\n\n";
            }
            return $response;
        }
        
        // Pricing inquiries
        if (preg_match('/\b(price|cost|rate|how much|pricing|expensive|cheap)\b/i', $message)) {
            if ($cars->isEmpty()) {
                return "Please check our Cars page for current pricing information.";
            }
            
            $minPrice = $cars->min('price');
            $maxPrice = $cars->max('price');
            
            $response = "Our rental prices range from P" . number_format($minPrice, 2) . " to P" . number_format($maxPrice, 2) . " per day.\n\n";
            $response .= "Price breakdown by category:\n";
            
            foreach ($cars->groupBy('category') as $category => $categoryCars) {
                $response .= "- {$category}: From P" . number_format($categoryCars->min('price'), 2) . "/day\n";
            }
            
            $response .= "\nLonger rental periods may qualify for discounts! Which vehicle interests you?";
            return $response;
        }
        
        // Cheapest car with image
        if (preg_match('/\b(cheapest|affordable|budget|lowest price|most affordable)\b/i', $message)) {
            $cheapest = $cars->sortBy('price')->first();
            if (!$cheapest) {
                return "Please visit our Cars page to see current pricing.";
            }
            
            $imageUrl = asset('storage/' . $cheapest->image);
            $response = "Our most affordable option is:\n\n";
            $response .= "Vehicle: {$cheapest->name}\n";
            $response .= "Image: {$imageUrl}\n";
            $response .= "Price: P" . number_format($cheapest->price, 2) . " per day\n";
            $response .= "Category: {$cheapest->category}\n";
            $response .= "Seats: {$cheapest->seats}\n";
            $response .= "Transmission: {$cheapest->transmission}\n";
            $response .= "Status: " . ($cheapest->available ? "Available now!" : "Currently rented") . "\n\n";
            
            return $response . ($cheapest->available ? "Ready to book? Visit our Cars page!" : "This vehicle is currently rented. Would you like to see other options?");
        }
        
        // Most expensive/luxury with image
        if (preg_match('/\b(expensive|luxury|premium|best|top|most expensive)\b/i', $message)) {
            $mostExpensive = $cars->sortByDesc('price')->first();
            if (!$mostExpensive) {
                return "Please visit our Cars page to see our premium vehicles.";
            }
            
            $imageUrl = asset('storage/' . $mostExpensive->image);
            $response = "Our premium vehicle is:\n\n";
            $response .= "Vehicle: {$mostExpensive->name}\n";
            $response .= "Image: {$imageUrl}\n";
            $response .= "Price: P" . number_format($mostExpensive->price, 2) . " per day\n";
            $response .= "Category: {$mostExpensive->category}\n";
            $response .= "Seats: {$mostExpensive->seats}\n";
            $response .= "Transmission: {$mostExpensive->transmission}\n";
            $response .= "Features: {$mostExpensive->features}\n";
            $response .= "Status: " . ($mostExpensive->available ? "Available for booking now!" : "Currently rented") . "\n\n";
            
            return $response . ($mostExpensive->available ? "Interested in this premium vehicle?" : "This vehicle is currently rented. Can I help you find another option?");
        }
        
        // Booking process
        if (preg_match('/\b(book|rent|reserve|hire|how to book)\b/i', $message)) {
            return "Booking a car is easy! Here's how:\n\n1. Visit our Cars page\n2. Choose your preferred vehicle\n3. Click 'Book Now'\n4. Enter your rental dates (pickup & return)\n5. Fill in your details\n6. Submit - we'll confirm within 24 hours!\n\nWhat type of vehicle are you interested in?";
        }
        
        // Requirements
        if (preg_match('/\b(requirement|need|document|license|id)\b/i', $message)) {
            return "To rent a car from StacyGarage, you'll need:\n\n- Valid driver's license\n- Government-issued ID\n- Proof of address\n- Credit/debit card for security deposit\n\nThe process is quick and simple. Ready to book?";
        }
        
        // Contact information
        if (preg_match('/\b(contact|phone|email|address|location|where)\b/i', $message)) {
            return "Here's how to reach us:\n\nPhone: +63 123 456 7890\nEmail: info@stacygarage.com\nAddress: 123 Main Street, Manila, Philippines\nHours: 24/7 service\n\nYou can also visit our Contact page for a map and contact form!";
        }
        
        // Hours/availability
        if (preg_match('/\b(hours|open|close|time|when)\b/i', $message)) {
            return "We're open 24/7 for your convenience! You can book online anytime or visit us during business hours. Our customer support team is always available to assist you.";
        }
        
        // Features inquiry
        if (preg_match('/\b(features|amenities|include|what does it have)\b/i', $message)) {
            return "All our rentals include:\n\n- Full insurance coverage\n- 24/7 roadside assistance\n- Free vehicle inspection\n- Clean and sanitized vehicles\n- GPS navigation (select vehicles)\n- Child seats available on request\n- Airport pickup/drop-off services\n\nSpecific features vary by vehicle. Which car are you interested in?";
        }
        
        // Thank you
        if (preg_match('/\b(thank|thanks|appreciate)\b/i', $message)) {
            return "You're very welcome! If you have any other questions about our vehicles, pricing, or booking process, feel free to ask. I'm here to help!";
        }
        
        // Default intelligent response with vehicle list
        $carList = $cars->take(5)->pluck('name')->implode(', ');
        return "I have complete information about our fleet of {$totalCars} vehicles. Our fleet includes: {$carList}" . ($totalCars > 5 ? ", and more" : "") . ".\n\nI can help you with:\n\n- Finding available cars\n- Specific vehicle details and images\n- Comparing prices\n- Booking process\n- Rental requirements\n- Contact information\n\nWhat would you like to know? You can ask about specific cars by name!";
    }
    
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000'
        ]);

        $userMessage = $request->input('message');
        
        // Get comprehensive website context
        $websiteContext = $this->getWebsiteContext();
        
        // Get OpenAI API key from .env
        $apiKey = env('OPENAI_API_KEY');
        
        // If no API key, use intelligent local responses with real data
        if (!$apiKey || $apiKey === 'your-openai-api-key-here') {
            return response()->json([
                'success' => true,
                'response' => $this->getIntelligentLocalResponse($userMessage, $websiteContext)
            ]);
        }

        try {
            // Call OpenAI ChatGPT API with full website context
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30)->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are a highly knowledgeable AI assistant for StacyGarage car rental service. You have complete access to the company database and website information. Be professional, friendly, and provide accurate information from the context provided. Always mention specific car names, prices, and features when relevant. Use Philippine Peso (P) for pricing without the peso sign emoji. Keep responses concise but informative. IMPORTANT: Do NOT use any emojis, emoticons, or special unicode characters in your responses. Use plain text only with clear, professional language. Format with line breaks and bullet points using dashes (-) instead of symbols. Here is the complete website context:\n\n' . $websiteContext
                    ],
                    [
                        'role' => 'user',
                        'content' => $userMessage
                    ]
                ],
                'max_tokens' => 800,
                'temperature' => 0.7,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $botResponse = $data['choices'][0]['message']['content'] ?? null;
                
                if ($botResponse) {
                    return response()->json([
                        'success' => true,
                        'response' => trim($botResponse)
                    ]);
                }
            }
            
            // If API fails, use intelligent local responses with real data
            Log::warning('OpenAI API failed, using intelligent local responses: ' . $response->body());
            return response()->json([
                'success' => true,
                'response' => $this->getIntelligentLocalResponse($userMessage, $websiteContext)
            ]);
            
        } catch (\Exception $e) {
            // If exception occurs, use intelligent local responses with real data
            Log::warning('Chatbot Exception, using intelligent local responses: ' . $e->getMessage());
            return response()->json([
                'success' => true,
                'response' => $this->getIntelligentLocalResponse($userMessage, $websiteContext)
            ]);
        }
    }
}
