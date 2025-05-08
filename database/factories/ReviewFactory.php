<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Property;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'property_id' => Property::factory(),
            'user_id' => User::factory(),
            'rating' => rand(1, 5),
            'comment' => $this->faker->paragraph(),
        ];
    }
}
