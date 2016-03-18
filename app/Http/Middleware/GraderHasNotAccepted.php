<?php

namespace App\Http\Middleware;

use Closure;

use App\Grader;

class GraderHasNotAccepted
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
        $grader = Grader::where('user_id', $user->id)->first();
        
        if(!$grader){
            return $next($request);                
        }
        
        return redirect()->route('home');
        
    }
    
}
