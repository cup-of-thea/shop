<?php

use App\Domain\Catalogue\Models\Product;
use App\Domain\Shared\ValueObjects\Money;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('computes the price with selected option modifiers applied', function () {
    $product = Product::factory()->create(['price' => Money::fromCents(2000)]);

    $option = $product->options()->create(['name' => 'Couleur du fil']);
    $option->values()->create(['value' => 'Rouge', 'price_modifier' => Money::fromCents(0)]);
    $gold = $option->values()->create(['value' => 'Doré', 'price_modifier' => Money::fromCents(500)]);

    expect($product->priceWithOptions([$gold->id])->cents())->toBe(2500);
});

it('floors the price at zero when modifiers would make it negative', function () {
    $product = Product::factory()->create(['price' => Money::fromCents(2000)]);

    $option = $product->options()->create(['name' => 'Réduction']);
    $bigDiscount = $option->values()->create(['value' => 'Promo', 'price_modifier' => Money::fromCents(-3000)]);

    expect($product->priceWithOptions([$bigDiscount->id])->cents())->toBe(0);
});
