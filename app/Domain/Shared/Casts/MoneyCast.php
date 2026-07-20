<?php

namespace App\Domain\Shared\Casts;

use App\Domain\Shared\ValueObjects\Money;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class MoneyCast implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes)
    {
        return Money::fromCents((int) $value);
    }

    public function set(Model $model, string $key, mixed $value, array $attributes)
    {
        return $value->cents();
    }
}
