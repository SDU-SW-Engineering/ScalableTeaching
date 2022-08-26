<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\NoReturn;

class BasicAuthForStaging
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('staging-authed'))
        {
            return $next($request);
        }

        if($request->server('PHP_AUTH_USER') && $request->server('PHP_AUTH_PW'))
        {
            if ( ! ($request->server('PHP_AUTH_USER') == getenv('STAGING_USER') &&
                $request->server('PHP_AUTH_PW') == getenv('STAGING_PASS')))
                $this->basic();
            session()->put('staging-authed', true);

            return $next($request);
        }

        $this->basic();
    }

    private function basic() : never
    {
        header('WWW-Authenticate: Basic realm="Staging"');
        header('HTTP/1.0 401 Unauthorized');
        exit;
    }
}
