<?php

namespace Database\Factories;

use App\Domain\Catalogue\Enums\ContactMethod;
use App\Domain\Catalogue\Models\CustomRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomRequestFactory extends Factory
{
    protected $model = CustomRequest::class;

    public function definition(): array
    {
        return [
            'product_id' => null,
            'contact_method' => ContactMethod::Discord,
            'contact_value' => 'thea#1234',
            'message' => $this->faker->sentence(),
        ];
    }
}
