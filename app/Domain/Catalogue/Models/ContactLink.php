<?php

namespace App\Domain\Catalogue\Models;

use App\Domain\Catalogue\Enums\ContactMethod;
use App\Domain\Catalogue\Exceptions\ContactLinkAlreadyExistsException;
use Database\Factories\ContactLinkFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactLink extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'contact_method' => ContactMethod::class,
        ];
    }

    public static function newFactory(): ContactLinkFactory
    {
        return ContactLinkFactory::new();
    }

    public static function createFor(ContactMethod $contactMethod, string $url, ?string $instructions = null): self
    {
        if (static::where('contact_method', $contactMethod)->exists()) {
            throw ContactLinkAlreadyExistsException::for($contactMethod);
        }

        return static::create([
            'contact_method' => $contactMethod,
            'url' => $url,
            'instructions' => $instructions,
        ]);
    }
}
