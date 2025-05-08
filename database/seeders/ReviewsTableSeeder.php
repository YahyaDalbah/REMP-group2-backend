<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Review;
use App\Models\Property;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $properties = Property::all();
        $users = User::all();
    
        foreach ($properties as $property) {
            Review::factory(3)->create([
                'property_id' => $property->id,
                'user_id' => $users->random()->id,
                'rating' => rand(1, 5),
            ]);
        }
    }
}
