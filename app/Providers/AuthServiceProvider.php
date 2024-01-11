<?php

namespace App\Providers;

use App\Models\Group;
use App\Models\Project;
use App\Models\User;
use App\Policies\ProjectPolicy;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Project::class => ProjectPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function($user, $ability) {
            if($user->is_admin && $ability != 'viewHorizon' && $ability != 'group:leave')
                return true;
        });

        Gate::define('group:leave', function (User $user, Group $group) {

           if ($group->members->count() == 1)
           {
               return Response::deny("You can not leave a group of 1");
           }

           return Response::allow();
        });


    }
}
