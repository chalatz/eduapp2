<?php

namespace App\Http\Middleware;

use Closure;

use App\Suggestion;

class SuggestionNotMade
{
    /**
     * The current user has not suggested anyone.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        $suggestion = Suggestion::where('suggestor_email', $user->email)->first();

        if(!$suggestion){
            return $next($request);
        }

        return redirect()->route('home');
    }
}
