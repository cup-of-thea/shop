<?php

use App\Domain\Catalogue\Models\Collection;
use App\Domain\Catalogue\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('associates multiple products to a collection', function () {
    $collection = Collection::factory()->create();

    $collection->products()->attach(
        Product::factory()->count(2)->create()
    );

    expect($collection->products)->toHaveCount(2);
});
