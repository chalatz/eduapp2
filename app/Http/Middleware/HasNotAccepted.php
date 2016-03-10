<?php

namespace App\Http\Middleware;

use Closure;

use App\Suggestion;

class HasNotAccepted
{
    /**
     * Allow only the candidate graders who have not accepted or declined yet.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $unique_string = $request->unique_string;
        $suggestion = Suggestion::where('unique_string', $unique_string)->first();

        if($suggestion && $suggestion->accepted != 'yes'){
            return $next($request);
        }

        if($suggestion && $suggestion->accepted == 'yes'){
            alert()->info('Εάν για κάποιο λόγο επιθυμείτε να εξαιρεθείτε, παρακαλούμε επικοινωνήστε μαζί μας,', 'Έχετε ήδη αποδεχθεί')
                    ->persistent('Εντάξει');
        }

        return redirect()->route('home');

    }

}
