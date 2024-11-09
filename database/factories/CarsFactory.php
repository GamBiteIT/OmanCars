<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CarsFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => 'Haval Jolion',
            'registration_number' => '4545 TH',
            'color' => 'white',
        ];
    }
}
