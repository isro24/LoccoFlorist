<?php

namespace Database\Seeders;

use App\Models\Admin;
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

        $user = Admin::factory()->create([
            'name' => 'Locco Florist',
            'email' => 'locco@gmail.com',
            'password' => bcrypt('password'),
        ]);
        
        // $faker = \Faker\Factory::create();

        // $users = Admin::all();
        // $categories = Category::all();
    }
}
