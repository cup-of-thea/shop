<?php

use App\Domain\Catalogue\Models\Product;
use App\Domain\Shared\ValueObjects\Money;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('stores and retrieves the price as Money', function () {
    $product = Product::factory()->create(['price' => Money::fromCents(1050)]);
    $fresh = $product->fresh();

    expect($fresh->price)->toBeInstanceOf(Money::class)
        ->and($fresh->price->cents())->toBe(1050);
});
