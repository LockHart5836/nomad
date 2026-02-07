<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@stacygarage.com',
            'is_admin' => true,
            'password' => Hash::make('admin123'),
        ]);

        echo "Admin user created successfully!\n";
        echo "Email: admin@stacygarage.com\n";
        echo "Password: admin123\n";
    }
}
