<?php

namespace App\Domain\Catalogue\Enums;

enum ContactMethod: string
{
    case Instagram = 'instagram';
    case Discord = 'discord';
    case Signal = 'signal';
    case Threads = 'threads';
    case BlueSky = 'bluesky';
    case Mastodon = 'mastodon';
}
