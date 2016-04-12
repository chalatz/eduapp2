<?php

namespace App\Http\Middleware;

use Closure;

use App\Grader;
use App\Suggestion;

class GraderHasNotAccepted
{
    /**
     * The suggested grader has not accepted yet
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();

        //$suggestion = Suggestion::where('suggestor_email', $user->email)->first();

        //$suggestion = $user->suggestion;

        $user = $request->user();
        $grader = Grader::where('user_id', $user->id)->first();

        // if($user->grader_status == 'na' || str_contains($user->grader_status, 'not_accepted')){
        //     return $next($request);
        // }

        if($grader && !$user->hasRole('grader_a')){
            return $next($request);
        }

        if(!$grader){
            return $next($request);
        }

        return redirect()->route('home');

    }

}
