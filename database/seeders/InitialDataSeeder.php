<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Car;
use Illuminate\Support\Facades\Hash;

class InitialDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@stacygarage.com',
            'password' => Hash::make('admin123'),
            'is_admin' => true,
            'phone' => '1234567890',
            'address' => '123 Admin Street',
        ]);

        // Create regular user
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
            'phone' => '9876543210',
            'address' => '456 User Avenue',
        ]);

        // Create sample cars
        $cars = [
            [
                'name' => 'Toyota Camry 2024',
                'category' => 'Sedan',
                'price' => 50.00,
                'seats' => 5,
                'transmission' => 'Automatic',
                'features' => json_encode(['Air Conditioning', 'Bluetooth', 'GPS', 'USB Ports']),
                'image' => 'cars/camry.png',
                'available' => true,
                'description' => 'Comfortable and reliable sedan perfect for family trips.',
            ],
            [
                'name' => 'Honda CR-V 2024',
                'category' => 'SUV',
                'price' => 75.00,
                'seats' => 7,
                'transmission' => 'Automatic',
                'features' => json_encode(['Air Conditioning', 'GPS', 'Bluetooth', 'Backup Camera', '4WD']),
                'image' => 'cars/crv.png',
                'available' => true,
                'description' => 'Spacious SUV with advanced safety features.',
            ],
            [
                'name' => 'BMW 3 Series 2024',
                'category' => 'Luxury',
                'price' => 120.00,
                'seats' => 5,
                'transmission' => 'Automatic',
                'features' => json_encode(['Leather Seats', 'Sunroof', 'Premium Sound', 'GPS', 'Heated Seats']),
                'image' => 'cars/bmw.png',
                'available' => true,
                'description' => 'Luxury sedan with premium features and performance.',
            ],
            [
                'name' => 'Ford Mustang 2024',
                'category' => 'Sports',
                'price' => 150.00,
                'seats' => 4,
                'transmission' => 'Manual',
                'features' => json_encode(['Sport Mode', 'Premium Sound', 'GPS', 'Performance Tires']),
                'image' => 'cars/mustang.png',
                'available' => true,
                'description' => 'Iconic sports car with powerful performance.',
            ],
            [
                'name' => 'Tesla Model 3 2024',
                'category' => 'Electric',
                'price' => 100.00,
                'seats' => 5,
                'transmission' => 'Automatic',
                'features' => json_encode(['Autopilot', 'Premium Interior', 'GPS', 'Supercharging', 'Glass Roof']),
                'image' => 'cars/tesla.png',
                'available' => true,
                'description' => 'Electric sedan with cutting-edge technology.',
            ],
        ];

        foreach ($cars as $car) {
            Car::create($car);
        }

        $this->command->info('Initial data seeded successfully!');
    }
}
