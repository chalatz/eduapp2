<?php

namespace App\Http\Middleware;

use Closure;

use App\Config;

use Auth;

class GradingsOver
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
        //Check if the gradings are over
        $config = Config::first();

        if(Auth:: check() && $config->end_of_gradings && Auth::user()->hasRole('site')){
            return $next($request);
        }

        return redirect()->route('home');

    }
}
