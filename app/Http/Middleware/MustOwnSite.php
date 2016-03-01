<?php

namespace App\Http\Middleware;

use Closure;

use App\Site;

class MustOwnSite
{
    /**
     * Make sure the User is the owner of the Site
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        $site = $user->site;

        if($user->id == $site->user_id){
            return $next($request);
        }

        alert()->error('Άρνηση Πρόσβασης.')
                ->persistent('Εντάξει');

        return redirect()->route('home');

    }
}
