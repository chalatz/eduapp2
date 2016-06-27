<?php

namespace App\Http\Middleware;

use Closure;

class MustOwnGraderOrIsMember
{
    /**
     * Make sure the User is the owner of the Grader.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();

        $grader = $user->grader;

        if(($user->id == $grader->user_id) || $user->hasRole('member')){
            return $next($request);
        }

        alert()->error('Άρνηση Πρόσβασης.')
                ->persistent('Εντάξει');

        return redirect()->route('home');

    }
}
