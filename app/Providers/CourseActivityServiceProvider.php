<?php

namespace App\Providers;

use App\Events\ProjectCreated;
use App\Listeners\GitLab\Project\DisableForking;
use App\Listeners\GitLab\Project\RegisterWebhook;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;

class CourseActivityServiceProvider extends EventServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     */
    protected $listen = [

    ];

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
