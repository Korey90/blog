<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Blog;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Blog::all()->each(function ($blog) {
            // Zakładając, że każdy blog ma trzy posty
            Post::factory()->count(3)->create(['blog_id' => $blog->id]);
        });
    }
}
