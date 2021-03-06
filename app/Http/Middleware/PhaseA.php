<?php

namespace App\Http\Middleware;

use Closure;

use App\Config;

class PhaseA
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
        $config = Config::first();

        if($config->phase_a_gradings){
            return $next($request);
        }

        alert()->error('Η Φάση Α έχει λήξει.')
                ->persistent('Εντάξει');

        return redirect()->route('home');

    }
}
