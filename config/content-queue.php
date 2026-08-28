<?php

return [
    'discord_bot_token' => env('CONTENT_QUEUE_DISCORD_BOT_TOKEN'),
    'discord_user_id' => env('CONTENT_QUEUE_DISCORD_USER_ID'),
    'cadence_days' => (int) env('CONTENT_QUEUE_CADENCE_DAYS', 4),
];
