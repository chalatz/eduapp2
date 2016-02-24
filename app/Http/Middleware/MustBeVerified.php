<?php

namespace App\Http\Middleware;

use Closure;

class MustBeVerified
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
        $user = $request->user();

        // if the user is looged in AND verified
        if ($user && $user->verified) {
            return $next($request);
        }

        return redirect()->route('home');
    }
}
