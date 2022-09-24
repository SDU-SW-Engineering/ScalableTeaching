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
use Str;

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
            $value = Str::of($value)->trim();
            if($value->startsWith('-') || $value->endsWith('-'))
                return false;
            return preg_match("/^[A-Za-z-0-9]+$/", $value->value()) === 1;
        });

        Http::macro('gitlab', function() {
            return Http::withToken(config('scalable.gitlab_token'))->baseUrl(config('scalable.gitlab_url') . '/api/v4');
        });
    }
}
