<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// database/seeders/ProductsTableSeeder.php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        // Generate test data for products table using Faker
        $faker = \Faker\Factory::create();

        for ($i = 1; $i <= 20; $i++) {
            DB::table('products')->insert([
                'name' => $faker->word,
                'description' => $faker->sentence,
                'inventory' => rand(0, 100),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}