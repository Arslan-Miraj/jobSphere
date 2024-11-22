<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Job_category;
use App\Models\Job_type;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Job_category::factory()->count(5)->create();
        Job_type::factory()->count(5)->create();
    }
}
