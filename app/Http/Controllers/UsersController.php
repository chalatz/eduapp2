<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Auth;

class UsersController extends Controller
{

    public function verify($verification_token)
    {
        Auth::logout();

        // try to find a user that has that string
        $user = User::whereVerification_token($verification_token)->firstOrFail();

        // the user is found but is already verified
        if($user->verified){
            alert()->info('Το email σας έχει ήδη επιβεβαιωθεί. Μπορείτε να συνδεθείτε.')
                    ->persistent('Εντάξει');
            return redirect('/');
        }

        // the user is found and ready to be verified
        $user->verified = 1;
        $user->save();

        alert()->success('Το email σας έχει επιβεβαιωθεί με επιτυχία! Μπορείτε τώρα να συνδεθείτε.')
                ->persistent('Εντάξει');

        return redirect('/');

    }

    public function send_verification()
    {
        $user = Auth::user();

        $user->verification_token = str_random(40);

        $user->save();

        $user->sendVerificationEmail();

        alert()->success('Σας έχει σταλεί ένα e-mail στον λογαριασμό που έχετε δηλώσει. Μόλις έλθει (μπορεί κα να καθυστερήσει έως 30 λεπτά), παρακαλούμε ανοίξτε αυτό το e-mail και πατήστε στον σύνδεσμο που θα βρείτε, προκειμένου να επιβεβαιώσετε το e-mail σας.', 'Επιτυχής Αποστολή')
                ->persistent('Το κατάλαβα');

        return redirect()->route('home');

    }

}
