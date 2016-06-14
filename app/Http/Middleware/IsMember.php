<?php

namespace App\Http\Middleware;

use Closure;

class IsMember
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

        // if the user is logged in AND is stuff
        if ($user && $user->hasRole('member')) {
            return $next($request);
        }

        alert()->error('Άρνηση Πρόσβασης.')
                ->persistent('Εντάξει');

        return redirect()->route('home');
    }
}
