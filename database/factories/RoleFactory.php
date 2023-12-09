<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Role;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

        protected $model = Role::class;

        public function definition()
        {
            // Tutaj możesz dodać więcej ról, jeśli potrzebujesz
            $roles = ['admin', 'user', 'editor'];
    
            return [
                'name' => $this->faker->unique()->randomElement($roles),
            ];
        }
    
}
