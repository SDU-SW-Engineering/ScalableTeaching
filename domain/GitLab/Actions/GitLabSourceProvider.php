<?php

namespace Domain\GitLab\Actions;

use App\Http\Kernel;
use Illuminate\Auth\Events\Login as LoginEvent;
use Illuminate\Support\ServiceProvider;

class GitLabSourceProvider extends ServiceProvider
{
    public function boot(Kernel $kernel)
    {
        $kernel->appendMiddlewareToGroup('web', SetSourceControlUserAuthMiddleware::class);
    }
}
