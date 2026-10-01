<?php

namespace App\Domain\Catalogue\Exceptions;

use App\Domain\Catalogue\Enums\ContactMethod;
use DomainException;

class ContactLinkAlreadyExistsException extends DomainException
{
    public static function for(ContactMethod $contactMethod): self
    {
        return new self("A contact link already exists for {$contactMethod->value}.");
    }
}
