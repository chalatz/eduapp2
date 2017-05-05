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
        if(Auth::user()->survey_ok){
            return $next($request);
        }

        return redirect()->route('home');

    }
}
