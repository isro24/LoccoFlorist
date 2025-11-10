<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Locco Florist',
            'email' => 'locco@gmail.com',
            'password' => bcrypt('password'),
        ]);
        // $userId = $user->id;

        // DB::table('categories')->insert([
        //     ['name' => 'Bunga Segar', 'created_at' => now(), 'updated_at' => now()],
        //     ['name' => 'Bunga Papan', 'created_at' => now(), 'updated_at' => now()],
        //     ['name' => 'Rangkaian Bunga', 'created_at' => now(), 'updated_at' => now()],
        //     ['name' => 'Buket Wisuda', 'created_at' => now(), 'updated_at' => now()],
        // ]);

        // DB::table('products')->insert([
        //     [
        //         'name' => 'Buket Mawar Merah',
        //         'description' => 'Buket bunga mawar merah segar cocok untuk hadiah romantis.',
        //         'price' => 150000,
        //         'image' => 'products/mawar-merah.jpg',
        //         'status' => true,
        //         'user_id' => $userId,
        //         'category_id' => 1,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'name' => 'Buket Wisuda Elegan',
        //         'description' => 'Buket bunga campuran untuk ucapan selamat wisuda.',
        //         'price' => 120000,
        //         'image' => 'products/wisuda-elegan.jpg',
        //         'status' => true,
        //         'user_id' => $userId,
        //         'category_id' => 4,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'name' => 'Bunga Papan Duka Cita',
        //         'description' => 'Bunga papan dengan desain profesional untuk ucapan duka cita.',
        //         'price' => 500000,
        //         'image' => 'products/papan-duka.jpg',
        //         'status' => true,
        //         'user_id' => $userId,
        //         'category_id' => 2,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'name' => 'Rangkaian Bunga Meja',
        //         'description' => 'Dekorasi meja dengan bunga segar pilihan untuk acara spesial.',
        //         'price' => 200000,
        //         'image' => 'products/bunga-meja.jpg',
        //         'status' => true,
        //         'user_id' => $userId,
        //         'category_id' => 3,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        // ]);

        $faker = \Faker\Factory::create();

        $users = User::all();
        $categories = Category::all();

        // Jika tidak ada user atau category, buat default
        // if ($users->isEmpty()) {
        //     $users = \App\Models\User::factory(5)->create();
        // }

        // if ($categories->isEmpty()) {
        //     $categories = \App\Models\Category::factory(5)->create();
        // }

        // for ($i = 0; $i < 15; $i++) {
        //     Product::create([
        //         'name' => $faker->words(3, true),
        //         'description' => substr($faker->paragraph, 0, 255),
        //         'price' => $faker->numberBetween(10000, 500000),
        //         'image' => 'products/default.jpg', 
        //         'status' => $faker->boolean(80), 
        //         'user_id' => $users->random()->id,
        //         'category_id' => $categories->random()->id,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        // }

    }
}
