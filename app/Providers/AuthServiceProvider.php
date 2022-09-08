<?php

namespace App\Providers;

use App\Models\Project;
use App\Models\Survey;
use App\Models\User as UserModel;
use App\Policies\ProjectPolicy;
use App\Policies\SurveyPolicy;
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
            if($user->is_admin && $ability != 'viewHorizon')
                return true;
        });
    }
}
