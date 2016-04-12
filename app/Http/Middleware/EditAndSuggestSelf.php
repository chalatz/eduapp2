<?php

namespace App\Http\Middleware;

use Closure;

class EditAndSuggestSelf
{
    /**
     * The user has already accepted a suggestion, he is a grader, and now he wants to suggest himself
     * He Should have a role of grader and not be self proposed
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();

        if($user->hasRole('grader_a') && !$user->suggestion){
            return $next($request);
        }

        return redirect()->route('home');

    }
}
