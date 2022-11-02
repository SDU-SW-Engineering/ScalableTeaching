<?php

namespace Domain\GitLab\Actions;

use Closure;
use Illuminate\Http\Request;

class SetSourceControlUserAuthMiddleware
{
    public function handle(Request $request, Closure $next): mixed
    {
        if (auth()->check()) {
            config()->set('sourcecontrol.users.auth.token', auth()->user()->access_token);
        }

        return $next($request);
    }
}
