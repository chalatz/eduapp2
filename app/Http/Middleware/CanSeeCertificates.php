<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

use App\Config;

class CanSeeCertificates
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
        $config = Config::first();

        if(Auth::user()->survey_ok && $config->end_of_gradings){
            return $next($request);
        }

        return redirect()->route('home');
    }
}
