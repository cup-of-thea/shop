<?php

namespace App\Domain\Catalogue\Enums;

enum ProductStatus: string
{
    case Active = 'active';
    case Archived = 'archived';
}
