<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MerchantsTableSeeder extends Seeder
{
    public function run()
    {
        // Generate test data for merchants table using Faker
        $faker = \Faker\Factory::create();

        for ($i = 1; $i <= 10; $i++) {
            DB::table('merchants')->insert([
                'name' => $faker->company,
                'address' => $faker->address,
                'latitude' => $faker->latitude,
                'longitude' => $faker->longitude,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

