<?php

use App\Domain\Catalogue\Enums\ContactMethod;
use App\Domain\Catalogue\Models\CustomRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can be created with a contact method and message', function () {
    $customRequest = CustomRequest::factory()->create([
        'contact_method' => ContactMethod::Discord,
        'contact_value' => 'thea#1234',
        'message' => 'Un carnet en cuir marron, format A5',
    ]);

    expect($customRequest->contact_method)->toBe(ContactMethod::Discord)
        ->and($customRequest->product_id)->toBeNull(); // produit de référence optionnel
});
