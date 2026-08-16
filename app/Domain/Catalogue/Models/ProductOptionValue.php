<?php

namespace App\Domain\Catalogue\Models;

use App\Domain\Shared\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductOptionValue extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'price_modifier' => MoneyCast::class,
        ];
    }

    public function option(): BelongsTo
    {
        return $this->belongsTo(ProductOption::class);
    }
}
