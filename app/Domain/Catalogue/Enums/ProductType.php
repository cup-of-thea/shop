<?php

namespace App\Domain\Catalogue\Enums;

enum ProductType: string
{
    case Standard = 'standard';
    case Unique = 'unique';
    case Customizable = 'customizable';
    case OnRequest = 'on_request';
}
