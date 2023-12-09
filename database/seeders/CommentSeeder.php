<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Post::all()->each(function ($post) {
            // Zakładając, że każdy post ma dwa komentarze
            Comment::factory()->count(2)->create(['post_id' => $post->id]);
        });
    }
}
