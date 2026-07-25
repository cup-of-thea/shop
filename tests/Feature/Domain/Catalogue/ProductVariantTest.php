<?php

use App\Domain\Catalogue\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('associates multiple variants to a product', function () {
    $product = Product::factory()->create();

    $product->variants()->createMany([
        ['name' => 'Blank pages', 'stock' => 4],
        ['name' => 'Lined Pages', 'stock' => 6],
    ]);

    expect($product->variants)->toHaveCount(2);
});
