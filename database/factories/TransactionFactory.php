<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Property;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   public function definition()
{
    return [
        'transaction_type' => $this->faker->randomElement(['sale', 'rent']),
        'amount' => $this->faker->randomFloat(2, 1000, 100000),
        'start_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
        'end_date' => $this->faker->dateTimeBetween('now', '+1 year'),
        'status' => $this->faker->randomElement(['pending', 'completed', 'cancelled']),
    ];
}

}
