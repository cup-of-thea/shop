<?php

namespace App\Domain\Catalogue\Models;

use App\Domain\Catalogue\Enums\ContactMethod;
use Database\Factories\CustomRequestFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomRequest extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'contact_method' => ContactMethod::class,
        ];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    protected static function newFactory(): CustomRequestFactory
    {
        return CustomRequestFactory::new();
    }
}
