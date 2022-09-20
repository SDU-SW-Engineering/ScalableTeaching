<?php

return [
    'driver' => \Domain\GitLab\Actions\GitLabActions::class,
    'url'    => env('GITLAB_URL'),

    'gitlab' => [
        'group' => env('GITLAB_GROUP')
    ],

    'users' => [
        'default' => [
            'token' => env('GITLAB_ACCESS_TOKEN')
        ],
        'auth' => [
            'token' => null
        ]
    ]
];
