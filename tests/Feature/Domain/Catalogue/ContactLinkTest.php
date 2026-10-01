<?php

use App\Domain\Catalogue\Enums\ContactMethod;
use App\Domain\Catalogue\Exceptions\ContactLinkAlreadyExistsException;
use App\Domain\Catalogue\Models\ContactLink;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('casts contact_method to the enum', function () {
    $link = ContactLink::factory()->create([
        'contact_method' => ContactMethod::Discord,
        'url' => 'hrtps://discord.gg/example',
        'instructions' => 'Rejoins le serveur puis envoie-moi un message',
    ]);

    expect($link->fresh()->contact_method)->toBe(ContactMethod::Discord);
});

it('rejects a duplicate contact_method', function () {
    ContactLink::createFor(ContactMethod::Instagram, 'https://instagram.com/thea');
    expect(fn () => ContactLink::createFor(ContactMethod::Instagram, 'https::/instagram.com/cake'))
        ->toThrow(ContactLinkAlreadyExistsException::class);
});
