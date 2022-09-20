<?php

namespace Domain\GitLab\Actions;

use App\Http\Kernel;
use Illuminate\Support\ServiceProvider;

class GitLabSourceProvider extends ServiceProvider
{
    public function boot(Kernel $kernel) : void
    {
        $kernel->appendMiddlewareToGroup('web', SetSourceControlUserAuthMiddleware::class);
    }
}
