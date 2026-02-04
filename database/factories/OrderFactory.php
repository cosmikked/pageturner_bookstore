<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = [
            'pending', 'processing', 'completed', 'cancelled'
        ];
        return [
            'user_id' => User::factory(),
            'total_amount' => fake()->randomFloat(2),
            'status' => fake()->randomElement($status)
        ];
    }
}
