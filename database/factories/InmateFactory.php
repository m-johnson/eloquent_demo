<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InmateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'jail_id' => null,
            'xref_id' => $this->faker->unique()->randomNumber(5,true)
        ];
    }
}
