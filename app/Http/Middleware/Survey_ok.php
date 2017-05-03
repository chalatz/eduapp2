<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

class Survey_ok
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
        if(Auth::check() && Auth::user()->hasRole('site') && Auth::user()->site->survey_ok){
            return $next($request);
        }

        return redirect()->route('home');

    }
}
