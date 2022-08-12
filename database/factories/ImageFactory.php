<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=>fake()->word(),
            'extension'=>'jpg',
            'path'=>'/public/image/'.fake()->word().'.'.'jpg',
            'image_id'=> 1,
            'image_type'=>'App\Models\Post'
        ];
    }
}
