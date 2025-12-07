<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user (only if doesn't exist)
        if (!User::where('email', 'admin@suite.in')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@suite.in',
                'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
                'role' => 'admin',
            ]);
        }

        // Create hotel owner user (only if doesn't exist)
        if (!User::where('email', 'owner@suite.in')->exists()) {
            User::create([
                'name' => 'Hotel Owner',
                'email' => 'owner@suite.in',
                'password' => \Illuminate\Support\Facades\Hash::make('owner123'),
                'role' => 'hotel_owner',
            ]);
        }

        // Create test user (only if doesn't exist)
        if (!User::where('email', 'test@example.com')->exists()) {
            User::create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'customer',
            ]);
        }

        // Seed in order
        $this->call([
            AmenitySeeder::class,
            RoomTypeSeeder::class,
            HotelSeeder::class,
        ]);
    }
}
