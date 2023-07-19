<?php

// database/factories/MerchantFactory.php

namespace Database\Factories;

use App\Models\Merchant;
use Illuminate\Database\Eloquent\Factories\Factory;

class MerchantFactory extends Factory
{
    protected $model = Merchant::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'location' => [
                'latitude' => $this->faker->latitude,
                'longitude' => $this->faker->longitude,
            ],
        ];
    }
}

