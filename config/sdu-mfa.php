<?php

use App\Models\User;

return [
    'client_id'          => env('MFA_CLIENT_ID'),
    'client_secret'      => env('MFA_CLIENT_SECRET'),
    'tenant_id'          => env('MFA_TENANT_ID'),
    'required_ad_groups' => env('MFA_REQUIRED_AD_GROUPS'),
    'persist_users'      => User::class,
];
