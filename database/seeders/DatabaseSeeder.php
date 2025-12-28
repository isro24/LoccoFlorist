<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = AuthUser::factory()->create([
            'name' => 'Locco Florist',
            'email' => 'locco@gmail.com',
            'password' => bcrypt('password'),
        ]);
        
        // $faker = \Faker\Factory::create();

        // $users = Admin::all();
        // $categories = Category::all();
    }
}
