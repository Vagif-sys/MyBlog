<?php

namespace Database\Factories;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=> fake()->word(),
            'slug'=> fake()->unique()->slug(),
            'user_id'=> User::all()->random()->id
        ];
    }
}
