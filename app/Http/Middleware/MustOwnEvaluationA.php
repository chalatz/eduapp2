<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

use App\Evaluation;

class MustOwnEvaluationA
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

        $evaluation = Evaluation::where('grader_id', $user->grader->id)->first();

        if($user->id == $request->user_id && $user->grader->id == $request->grader_id && $evaluation){
            return $next($request);
        }

        return redirect()->route('home');
        
    }
}
