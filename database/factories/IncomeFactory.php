<?php

namespace Database\Factories;
use App\Models\Storage;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Income>
 */
class IncomeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $storage_id = rand(1, 10);
        $amount = rand(1000, 100000);
        $storage = Storage::find($storage_id);
        $storage->increment('amount', $amount);
        return [
         'name' => $this->faker->sentence(1),
         'date' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
         'source_id' => rand(1, 10),
         'storage_id' => $storage_id,
         'amount' => $amount,
        ];


    }
}
