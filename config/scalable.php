<?php

return [
    'webhook_secret'   => env('SCALABLE_SECRET', 'scalable'),
    'gitlab_token'     => env('GITLAB_ACCESS_TOKEN'),
    'gitlab_url'       => env('GITLAB_URL'),
    'gitlab_group'     => env('GITLAB_GROUP'),
    'webhook_url'      => env('GITLAB_WEBHOOK_URL'),
];
