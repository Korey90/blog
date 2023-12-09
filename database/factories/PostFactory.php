<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

        protected $model = Post::class;

        public function definition()
        {
            return [
                'title' => $this->faker->sentence,
                'content' => $this->faker->paragraph(5),
                'author' => $this->faker->name,
                'created_at' => $this->faker->dateTimeThisYear,
                // 'blog_id' zostanie wypełniony w Seederze
            ];
        }
}
