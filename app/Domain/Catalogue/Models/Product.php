<?php

namespace App\Domain\Catalogue\Models;

use App\Domain\Catalogue\Enums\ProductStatus;
use App\Domain\Catalogue\Enums\ProductType;
use App\Domain\Shared\Casts\MoneyCast;
use App\Domain\Shared\ValueObjects\Money;
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

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function defaultVariant(): ?ProductVariant
    {
        return $this->variants->firstWhere('is_default') ?? $this->variants->first();
    }

    public function options(): HasMany
    {
        return $this->hasMany(ProductOption::class);
    }

    public function priceWithOptions(array $selectedValuesIds): Money
    {
        $selectedValues = $this->options->flatMap->values->whereIn('id', $selectedValuesIds);

        return $selectedValues
            ->reduce(fn (Money $total, ProductOptionValue $value) => $total->add($value->price_modifier), $this->price)->flooredAtZero();
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
