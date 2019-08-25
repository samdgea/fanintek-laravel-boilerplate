<?php

namespace Fanintek\Fantasena\Http\Middleware;

use Closure;

class AdministrativeOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->isSuperAdministrator() || auth()->user()->hasRole(config('fanrbac.allowed_role_access_admin_menu')))
            return $next($request);

        return redirect()->route('home')->with('splash-type', 'danger')->with('splash-message', 'You\'re not allowed to access this page');
    }
}
