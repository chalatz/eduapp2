<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Hash;
use App\Config;

class UsersController extends Controller
{

    public function verify($verification_token)
    {
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

        // keep the user logged in
        if(Auth::check()){
            if($user->id != Auth::user()->id){
                Auth::logout();
            }
        }

        alert()->success('Το email σας έχει επιβεβαιωθεί με επιτυχία!')
                ->persistent('Εντάξει');

        return redirect('/');

    }

    public function send_verification()
    {
        $user = Auth::user();

        if($user->reminders_count == 0){
            alert()->error('Έχετε υπερβεί το όριο αποστολής αυτού του είδους email. Παρακαλούμε επικοινωνήστε μαζί μας για επιπλέον βοήθεια.', 'Σφάλμα')
                    ->persistent('Εντάξει');

            return redirect()->route('home');
        }

        $user->reminders_count--;

        $user->verification_token = str_random(40);

        $user->save();

        $user->sendVerificationEmail();

        alert()->success('Σας έχει σταλεί ένα e-mail στον λογαριασμό που έχετε δηλώσει. Μόλις έλθει (μπορεί κα να καθυστερήσει έως 30 λεπτά), παρακαλούμε ανοίξτε αυτό το e-mail και πατήστε στον σύνδεσμο που θα βρείτε, προκειμένου να επιβεβαιώσετε το e-mail σας.', 'Επιτυχής Αποστολή')
                ->persistent('Το κατάλαβα');

        return redirect()->route('home');

    }

    public function change_password()
    {
        return view('auth.passwords.change');
    }

    public function do_change_password(Request $request)
    {
        if(Auth::guest()){
            return redirect()->route('home');
        }

        $this->validate($request, [
            'current_password' => 'required',
            'new_password' => 'required|confirmed|min:6',
        ], [
            'confirmed' => 'Οι Κωδικοί Πρόσβασης πρέπει να ταιριάζουν',
        ]);


        if(Hash::check($request->current_password, Auth::user()->password)){

            $user = User::find(Auth::user()->id);
            $user->password = bcrypt($request->new_password);
            $user->save();

            alert()->success('Επιτυχής Αλλαγή!');

            return redirect()->route('home');

        } else {
            alert()->error('Λανθασμένος Τρέχων Κωδικός Πρόσβασης')->persistent('Εντάξει');
            return redirect()->back();
        }

    }

    public function account_actions(){
        return view('pages.user_account_actions');
    }

    public function store_survey(Request $request)
    {
        $this->validate($request, [
            'survey_key' => 'required',
        ]);

        if($request->survey_key == Config::first()->survey_key){

            $user = $request->user();
            $user->survey_ok = 1;
            $user->save();

            alert()->success('Το κλειδί που δώσατε είναι σωστό!', 'Επιτυχία');

        } else {
            alert()->error('Το κλειδί που δώσατε δεν είναι το σωστό.')->persistent('Εντάξει');
        }

        return redirect()->route('home');

    }    

}
