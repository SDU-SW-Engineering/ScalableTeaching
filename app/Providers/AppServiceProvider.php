<?php

namespace App\Providers;

use App\GitLabSocialite;
use Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Laravel\Horizon\Horizon;
use Laravel\Socialite\Contracts\Factory;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\SocialiteManager;
use Laravel\Socialite\Two\GitlabProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('alpha_hyphen', function($attribute, $value) {
            return preg_match("/^[A-Za-z-0-9]+$/", $value) === 1;
        });

        Http::macro('gitlab', function() {
            return Http::withToken(config('scalable.gitlab_token'))->baseUrl(config('scalable.gitlab_url') . '/api/v4');
        });

        $this->createGitlabDriver();
    }

    protected function createGitlabDriver()
    {
        $config = config('services.gitlab');


        $socialite = app(Factory::class);
        $socialite->extend('gitlab-new', function() use ($config, $socialite) {
            return $socialite->buildProvider(GitLabSocialite::class, $config)->setHost($config['host'] ?? null);
        });
    }
}
