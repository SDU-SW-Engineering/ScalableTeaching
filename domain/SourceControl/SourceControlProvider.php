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
        $this->app->bind(SourceControl::class, config('sourcecontrol.driver'));
    }
}
