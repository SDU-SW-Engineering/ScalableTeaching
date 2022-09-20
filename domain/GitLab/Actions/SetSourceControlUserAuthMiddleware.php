<?php

namespace Domain\GitLab\Actions;

use Closure;

class SetSourceControlUserAuthMiddleware
{
    public function handle($request, Closure $next)
    {
        if (auth()->check())
            config()->set('sourcecontrol.users.auth.token', auth()->user()->access_token);
        return $next($request);
    }
}
