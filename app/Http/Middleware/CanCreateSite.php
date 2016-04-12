<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

class CanCreateSite
{
    /**
     * Thu user can create a Site
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check() && Auth::user()->suggestion && Auth::user()->suggestion->accepted == 'yes'){
            return $next($request);
        }

        return redirect()->route('home');

    }
}
