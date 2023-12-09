<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            BlogSeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
            TagSeeder::class,
            RoleSeeder::class,  // Dodajemy tu nasz nowy seeder
        ]);
    }
}
