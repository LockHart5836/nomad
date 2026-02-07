<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Car;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cars = [
            [
                'name' => 'Toyota Vios',
                'category' => 'sedan',
                'price' => 89.00,
                'seats' => 5,
                'transmission' => 'Automatic',
                'features' => 'AC, Bluetooth, USB Port',
                'image' => null,
                'available' => true,
                'description' => 'Perfect for business travel and comfort. Fuel-efficient and reliable.',
            ],
            [
                'name' => 'Nissan Terra',
                'category' => 'suv',
                'price' => 129.00,
                'seats' => 7,
                'transmission' => 'Automatic',
                'features' => 'AC, 4WD, Leather Seats, Cruise Control',
                'image' => null,
                'available' => true,
                'description' => 'Spacious and powerful for family trips. Great for long journeys and rough terrain.',
            ],
            [
                'name' => 'Ford Raptor',
                'category' => 'truck',
                'price' => 199.00,
                'seats' => 5,
                'transmission' => 'Manual',
                'features' => 'Twin Turbo, 4WD, Off-road Package',
                'image' => null,
                'available' => true,
                'description' => 'Experience pure driving excitement. Built for adventure and performance.',
            ],
            [
                'name' => 'Honda Civic',
                'category' => 'sedan',
                'price' => 79.00,
                'seats' => 5,
                'transmission' => 'Automatic',
                'features' => 'AC, Apple CarPlay, Backup Camera',
                'image' => null,
                'available' => true,
                'description' => 'Reliable and stylish sedan perfect for city driving.',
            ],
            [
                'name' => 'Toyota Fortuner',
                'category' => 'suv',
                'price' => 139.00,
                'seats' => 7,
                'transmission' => 'Automatic',
                'features' => 'AC, 4WD, Premium Audio, Sunroof',
                'image' => null,
                'available' => true,
                'description' => 'Premium SUV with exceptional comfort and capability.',
            ],
            [
                'name' => 'Mitsubishi Montero',
                'category' => 'suv',
                'price' => 149.00,
                'seats' => 7,
                'transmission' => 'Automatic',
                'features' => 'AC, 4WD, Navigation, Leather Interior',
                'image' => null,
                'available' => false,
                'description' => 'Luxury SUV perfect for family adventures.',
            ],
            [
                'name' => 'Toyota Hiace',
                'category' => 'van',
                'price' => 159.00,
                'seats' => 12,
                'transmission' => 'Manual',
                'features' => 'AC, Spacious Cargo, USB Charging',
                'image' => null,
                'available' => true,
                'description' => 'Ideal for group travel and commercial use.',
            ],
            [
                'name' => 'BMW 5 Series',
                'category' => 'luxury',
                'price' => 249.00,
                'seats' => 5,
                'transmission' => 'Automatic',
                'features' => 'Premium Audio, Leather Seats, Navigation, Sunroof',
                'image' => null,
                'available' => true,
                'description' => 'Ultimate luxury sedan with cutting-edge technology.',
            ],
        ];

        foreach ($cars as $car) {
            Car::create($car);
        }
    }
}
