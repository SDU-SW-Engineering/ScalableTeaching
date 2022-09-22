<?php

namespace Domain\SourceControl;

use Illuminate\Support\ServiceProvider;

class SourceControlProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(config('sourcecontrol.provider'));
    }
}
