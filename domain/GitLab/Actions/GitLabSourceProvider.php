<?php

namespace Domain\GitLab\Actions;

use App\Http\Kernel;
use Domain\SourceControl\SourceControl;
use Illuminate\Support\ServiceProvider;

class GitLabSourceProvider extends ServiceProvider
{
    public function boot(Kernel $kernel): void
    {
        $this->app->scoped(SourceControl::class, GitLabActions::class);
        $kernel->appendMiddlewareToGroup('web', SetSourceControlUserAuthMiddleware::class);
    }
}
