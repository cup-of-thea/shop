<?php

namespace Database\Factories;

use App\Domain\Catalogue\Enums\ContactMethod;
use App\Domain\Catalogue\Models\ContactLink;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactLinkFactory extends Factory
{
    protected $model = ContactLink::class;

    public function definition(): array
    {
        return [
            'contact_method' => ContactMethod::Discord,
            'url' => 'https://discord.gg/'.$this->faker->slug(),
            'instructions' => 'Rejoins le serveur puis envoie-moi un message.',
        ];
    }
}
