<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $merchantIDs = \App\Models\Merchant::pluck('id')->toArray();

        for ($i=0; $i < 200; $i++) { 
            \App\Models\Product::create([
                'name' => $faker->productName,
                'description' => $faker->sentence,
                'price' => $faker->randomFloat(2, 1, 100),
                'merchant_id' => $faker->randomElement($merchantIDs),
            ]);
        }
    }
}
