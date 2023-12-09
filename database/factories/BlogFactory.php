<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Blog;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    protected $model = Blog::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            // 'user_id' zostanie wypełniony w Seederze
        ];
    }
}
