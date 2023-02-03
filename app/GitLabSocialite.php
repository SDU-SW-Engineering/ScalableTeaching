<?php

namespace App;

use Laravel\Socialite\Two\GitlabProvider;

class GitLabSocialite extends GitlabProvider
{
    protected $scopes = ['api'];

    /**
     * {@inheritdoc}
     */
    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get($this->host.'/api/v4/user', [
            'query' => ['access_token' => $token],
        ]);

        return json_decode($response->getBody(), true);
    }
}
