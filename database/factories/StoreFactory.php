<?php

namespace Database\Factories;

use App\Models\Store;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreFactory extends Factory
{
    protected $model = Store::class;

    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'address' => fake()->address()
        ];
    }
}