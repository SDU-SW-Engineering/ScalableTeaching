<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EnsureUserIsSystemAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = user();

        if ($user === null)
        {
            return redirect()->route('login');
        }

        if ( ! user()->is_sys_admin)
        {
            abort(403);
        }

        return $next($request);
    }
}
