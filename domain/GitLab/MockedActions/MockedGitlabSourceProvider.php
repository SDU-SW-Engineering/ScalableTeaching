<?php

namespace Domain\GitLab\MockedActions;

use App\Http\Kernel;
use Domain\SourceControl\SourceControl;
use Illuminate\Support\ServiceProvider;

class MockedGitlabSourceProvider extends ServiceProvider
{
    public function boot(Kernel $kernel): void
    {
        $this->app->bind(SourceControl::class, MockedGitlabActions::class);
    }
}
