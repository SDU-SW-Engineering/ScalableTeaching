<?php

namespace App\Providers;

use App\GitLabSocialite;
use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Contracts\Factory;

class GitLabServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->createGitlabDriver();
    }

    protected function createGitlabDriver()
    {
        $config = config('services.gitlab');

        $socialite = app(Factory::class);
        $socialite->extend('gitlab-new', function() use ($config, $socialite) { // @phpstan-ignore-line
            return $socialite->buildProvider(GitLabSocialite::class, $config)->setHost($config['host'] ?? null); // @phpstan-ignore-line
        });
    }
}
