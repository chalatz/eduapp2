<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

use App\Evaluation;

class CanEvaluateA
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
        $user = Auth::user();

        $evaluation = Evaluation::where('grader_id', $user->grader->id)->first();

        if(($user->hasRole('grader_a') || $user->hasRole('grader_b')) && $evaluation){
            return $next($request);
        }

        return redirect()->route('home');
    }
}
