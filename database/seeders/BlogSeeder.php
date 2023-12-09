<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Blog;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Zakładając, że każdy użytkownik ma jeden blog
        User::all()->each(function ($user) {
            Blog::factory()->create(['user_id' => $user->id]);
        });
    }
}
