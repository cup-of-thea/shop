<?php

namespace App\Domain\Catalogue\Models;

use App\Domain\Catalogue\Enums\ProductStatus;
use App\Domain\Catalogue\Enums\ProductType;
use App\Domain\Shared\Casts\MoneyCast;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('order');
    }

    protected function casts(): array
    {
        return [
            'price' => MoneyCast::class,
            'type' => ProductType::class,
            'status' => ProductStatus::class,
        ];
    }

    protected static function newFactory(): ProductFactory
    {
        return ProductFactory::new();
    }
}
