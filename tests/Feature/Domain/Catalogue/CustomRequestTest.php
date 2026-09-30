<?php

use App\Domain\Catalogue\Enums\ContactMethod;
use App\Domain\Catalogue\Enums\CustomRequestStatus;
use App\Domain\Catalogue\Models\CustomRequest;
use App\Domain\Shared\ValueObjects\Money;
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

it('starts as a draft with no contact info and can be submitted with a snapshot', function () {
    $customRequest = CustomRequest::factory()->create([
        'status' => CustomRequestStatus::Draft,
        'contact_method' => null,
        'contact_value' => null,
        'message' => null,
        'last_step_reached' => 1,
    ]);

    expect($customRequest->status)->toBe(CustomRequestStatus::Draft)
        ->and($customRequest->contact_method)->toBeNull();

    $customRequest->update([
        'status' => CustomRequestStatus::Submitted,
        'contact_method' => ContactMethod::Discord,
        'contact_value' => 'thea#1234',
        'message' => 'Un carnet en cuir végé marron, format A5',
        'selected_options' => [
            ['option' => 'Couleur du fil', 'value' => 'Doré', 'price_modifier' => 500],
        ],
        'estimated_price' => Money::fromCents(2500),
    ]);

    $fresh = $customRequest->fresh();

    expect($fresh->status)->toBe(CustomRequestStatus::Submitted)
        ->and($fresh->selected_options)->toBe([
            ['option' => 'Couleur du fil', 'value' => 'Doré', 'price_modifier' => 500],
        ])
        ->and($fresh->estimated_price->cents())->toBe(2500);

});
