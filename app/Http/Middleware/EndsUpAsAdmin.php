<?php

namespace App\Http\Middleware;

use Closure;

class EndsUpAsAdmin
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
        $response = $next($request);

        $user = $request->user();

        if(!$user->hasRole('admin')){
            return $response;
        }

    }
}
