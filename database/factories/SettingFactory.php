<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'api_key' => null,
            'minimum_withdrawal_amount' => 10.56,
            'maximum_withdrawal_amount' => 56.04,
        ];
    }
}
