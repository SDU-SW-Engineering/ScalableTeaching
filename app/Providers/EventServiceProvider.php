<?php

namespace App\Providers;

use App\Events\ProjectCreated;
use App\Listeners\GitLab\Project\DisableForking;
use App\Listeners\GitLab\Project\RefreshMemberAccess;
use App\Listeners\GitLab\Project\RegisterWebhook;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ProjectCreated::class => [
            RefreshMemberAccess::class,
            DisableForking::class,
            RegisterWebhook::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
    }
}
