<?php

namespace App\Http\Middleware;

use Closure;

use App\Config;

class PhaseC
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

        if($config->phase_c_gradings){
            return $next($request);
        }

        alert()->error('Η Φάση Γ έχει λήξει.')
                ->persistent('Εντάξει');

        return redirect()->route('home');
    }
}
