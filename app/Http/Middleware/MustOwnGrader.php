<?php

namespace App\Http\Middleware;

use Closure;

class MustOwnGrader
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

        if($user->id == $grader->user_id){
            return $next($request);
        }

        alert()->error('Άρνηση Πρόσβασης.')
                ->persistent('Εντάξει');

        return redirect()->route('home');

    }
}
