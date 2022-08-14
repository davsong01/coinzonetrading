<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'short_description' => $this->faker->words(5, true),
            'amount' => intval($this->faker->numerify('######')),
            'max_amount' => abs( intval($this->faker->numerify('######'))),
            'daily_roi' => intval($this->faker->numerify('##')),
            // 'monthly_roi' => intval($this->faker->numerify('###')),
            'validity_period' => intval($this->faker->numerify('##')),
            'user_id' => User::factory()->create()
        ];
    }
}
