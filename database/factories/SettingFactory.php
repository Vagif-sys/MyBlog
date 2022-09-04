<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_text'=> fake()->paragraph(),
            'second_text'=> fake()->paragraph(),
            'first_image'=> 'blog_template/images/about-img-1.jpg',
            'second_image'=> 'blog_template/images/about-img-2.jpg',
            'about_our_mission'=> fake()->paragraph(),
            'about_our_vision'=> fake()->paragraph(),
            'about_services'=> fake()->paragraph(),
        ];
   }
}