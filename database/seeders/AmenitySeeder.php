<?php

namespace Database\Seeders;

use App\Models\Amenity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $amenities = [
            ['name' => 'Free WiFi', 'type' => 'both'],
            ['name' => 'Swimming Pool', 'type' => 'hotel'],
            ['name' => 'Fitness Center', 'type' => 'hotel'],
            ['name' => 'Spa', 'type' => 'hotel'],
            ['name' => 'Restaurant', 'type' => 'hotel'],
            ['name' => 'Parking', 'type' => 'hotel'],
            ['name' => 'Air Conditioning', 'type' => 'room'],
            ['name' => 'TV', 'type' => 'room'],
            ['name' => 'Mini Bar', 'type' => 'room'],
            ['name' => 'Safe', 'type' => 'room'],
            ['name' => 'Balcony', 'type' => 'room'],
            ['name' => 'Room Service', 'type' => 'room'],
        ];

        foreach ($amenities as $amenity) {
            Amenity::create($amenity);
        }
    }
}
