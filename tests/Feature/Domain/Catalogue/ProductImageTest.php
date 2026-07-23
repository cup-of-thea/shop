<?php

use App\Domain\Catalogue\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('orders images by their order column, not insertion order', function () {
    $product = Product::factory()->create();

    $product->images()->create(['path' => 'second.jpg', 'alt' => 'Deuxième image', 'order' => 1]);
    $product->images()->create(['path' => 'first.jpg', 'alt' => 'Première image', 'order' => 0]);

    expect($product->fresh()->images->pluck('path')->all())
        ->toBe(['first.jpg', 'second.jpg']);
});
