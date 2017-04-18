<?php

namespace App\Http\Middleware;

use Closure;

class IsGraderB
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

        // if the user is logged in AND is member
        if ($user && $user->hasRole('grader_b')) {
            return $next($request);
        }

        alert()->error('Άρνηση Πρόσβασης.')
                ->persistent('Εντάξει');

        return redirect()->route('home');        
    }
}
