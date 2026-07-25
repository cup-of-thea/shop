<?php

namespace App\Domain\Catalogue\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductVariant extends Model
{
    protected $guarded = [];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
