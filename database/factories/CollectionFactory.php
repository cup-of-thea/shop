<?php

namespace Database\Factories;

use App\Domain\Catalogue\Models\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;

class CollectionFactory extends Factory
{
    protected $model = Collection::class;

    public function definition(): array
    {
        return [
            'name' => fake()->words(2, true),
        ];
    }
}
