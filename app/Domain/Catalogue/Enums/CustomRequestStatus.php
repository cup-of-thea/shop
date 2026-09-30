<?php

namespace App\Domain\Catalogue\Enums;

enum CustomRequestStatus: string
{
    case Draft = 'draft';
    case Submitted = 'submitted';
}
