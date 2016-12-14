<?php

namespace App\Http\Middleware;

use Closure;

use App\Config;

class SiteSubmissionsOpen
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
        // this is temporary
        return $next($request);

        // Check if the site submissions are open
        // $config = Config::find(1);

        // if($config->site_submissions){
        //     return $next($request);
        // }

        // alert()->error('Η υποβολή Υποψηφιοτήτων και προτάσεων Αξιολογητών Α έχει λήξει.')
        //         ->persistent('Εντάξει');

        // return redirect()->route('home');
    }
}
