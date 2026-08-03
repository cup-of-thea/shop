<?php

use App\Domain\Catalogue\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('associates multiple variants to a product', function () {
    $product = Product::factory()->create();

    $product->variants()->createMany([
        ['name' => 'Blank pages', 'stock' => 4],
        ['name' => 'Lined pages', 'stock' => 6],
    ]);

    expect($product->variants)->toHaveCount(2);
});

it('exposes the default variant among several', function () {
    $product = Product::factory()->create();

    $product->variants()->createMany([
        ['name' => 'Blank pages', 'stock' => 4],
        ['name' => 'Lined pages', 'stock' => 6, 'is_default' => true],
    ]);

    expect($product->defaultVariant()->name)->toBe('Lined pages');
});

it('falls back to the first variant when no default', function () {
    $product = Product::factory()->create();

    $product->variants()->createMany([
        ['name' => 'Blank pages', 'stock' => 4],
        ['name' => 'Lined pages', 'stock' => 6],
    ]);

    expect($product->defaultVariant()->name)->toBe('Blank pages');
});
