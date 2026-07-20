<?php

use App\Domain\Shared\Casts\MoneyCast;
use App\Domain\Shared\ValueObjects\Money;
use Illuminate\Database\Eloquent\Model;

it('casts a raw value to Money via get()', function () {
    $cast = new MoneyCast;
    $model = new class extends Model {};

    $result = $cast->get($model, 'price', 1050, []);

    expect($result)->toBeInstanceOf(Money::class)
        ->and($result->cents())->toBe(1050);
});

it('casts a Money instance to a raw int viaa set()', function () {
    $cast = new MoneyCast;
    $model = new class extends Model {};

    $result = $cast->set($model, 'price', Money::fromCents(1050), []);

    expect($result)->toBe(1050);
});
