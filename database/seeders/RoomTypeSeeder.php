<?php

namespace Database\Seeders;

use App\Models\RoomType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roomTypes = [
            [
                'name' => 'Standard Room',
                'description' => 'Comfortable room with essential amenities',
                'max_occupancy' => 2,
                'bed_count' => 1,
                'bed_type' => 'Queen',
                'size_sqm' => 25,
            ],
            [
                'name' => 'Deluxe Room',
                'description' => 'Spacious room with premium amenities',
                'max_occupancy' => 2,
                'bed_count' => 1,
                'bed_type' => 'King',
                'size_sqm' => 35,
            ],
            [
                'name' => 'Suite',
                'description' => 'Luxurious suite with separate living area',
                'max_occupancy' => 4,
                'bed_count' => 1,
                'bed_type' => 'King',
                'size_sqm' => 60,
            ],
            [
                'name' => 'Executive Room',
                'description' => 'Business-friendly room with work desk',
                'max_occupancy' => 2,
                'bed_count' => 1,
                'bed_type' => 'King',
                'size_sqm' => 40,
            ],
        ];

        foreach ($roomTypes as $roomType) {
            RoomType::create($roomType);
        }
    }
}
