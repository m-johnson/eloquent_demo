<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $products = ['Chips','Pretzels','Popcorn','Granola Bars','Candy','Trail Mix','Soap','Toothbrush','Toothpaste','Deodorant','Shampoo','Conditioner'];

        return [
            'name' => $this->faker->unique()->randomElement($products),
            'description' => $this->faker->paragraph(2),
            'price' => $this->faker->randomFloat(2,.50,5)
        ];
    }
}
