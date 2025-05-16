<?php

namespace Database\Factories;

use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'owner_id' => User::factory()->state(["type" => "seller"]),
            'title' => $this->faker->sentence(),
            'image' => $this->faker->randomElement(['home1.avif', 'home2.avif', 'home3.jpg', 'home4.jpg', 'home5.avif', 'home6.webp']),
            'images' => [$this->faker->randomElement(['home1.avif', 'home2.avif', 'home3.jpg', 'home4.jpg', 'home5.avif', 'home6.webp']), $this->faker->randomElement(['home1.avif', 'home2.avif', 'home3.jpg', 'home4.jpg', 'home5.avif', 'home6.webp'])],
            'location' => $this->faker->address(),
            'description' => $this->faker->paragraph(3),
            'bedrooms' => rand(1, 5),
            'bathrooms' => rand(1, 3),
            'price' => $this->faker->randomFloat(2, 50000, 1000000),
            'isForRent' => $this->faker->boolean(),
            'isForSale' => $this->faker->boolean(),
            'status' => $this->faker->randomElement(['available', 'rented', 'sold']),
        ];
    }
}
