<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class WalletFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->create(),
            'type' => $this->faker->randomElement(['debit', 'credit']),
            'amount' => floatval($this->faker->numerify('#####')),
        ];
    }
}
