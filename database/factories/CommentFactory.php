<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'the_comment'=>fake()->sentence(),
            'post_id'=> Post::all()->random()->first()->id,
            'user_id'=> User::all()->random()->first()->id
        ];
    }
}
