<?php

return [
    'driver' => env('SOURCE_CONTROL_DRIVER', 'GitLabSourceControlDriver'),
    'url'    => env('GITLAB_URL'),

    'gitlab' => [
        'group' => env('GITLAB_GROUP')
    ],

    'users' => [
        'default' => [
            'token' => env('GITLAB_ACCESS_TOKEN')
        ],
        'auth'    => [
            'token' => null
        ]
    ]
];
