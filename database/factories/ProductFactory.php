<?php

namespace Database\Factories;

use App\Domain\Catalogue\Models\Product;
use App\Domain\Shared\ValueObjects\Money;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(),
            'materials' => $this->faker->words(2, true),
            'price' => Money::fromCents($this->faker->numberBetween(500, 10000)),
            'type' => 'standard',
            'status' => 'active',
        ];
    }
}
