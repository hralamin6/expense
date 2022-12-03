<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
         'name' => $this->faker->sentence(1),
         'date' => $this->faker->dateTimeBetween('-1 week', '+1 week'),
         'category_id' => rand(1, 10),
         'storage_id' => rand(1, 10),
         'amount' => rand(100, 100000),
        ];
    }
}
