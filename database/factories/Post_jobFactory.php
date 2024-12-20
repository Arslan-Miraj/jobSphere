<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class Post_jobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->name,
            'user_id' => rand(1, 3),
            'job_type_id' => rand(1, 3),
            'category_id' => rand(1, 3),
            'vacancy' => rand(1, 3),
            'location' => fake()->city,
            'description' => fake()->text,
            'experience' => rand(1, 10),
            'company_name' => fake()->name,
        ];
    }
}
