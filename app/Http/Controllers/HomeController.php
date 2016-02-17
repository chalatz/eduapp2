<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // alert()->success('Σας έχει σταλεί ένα e-mail στον λογαριασμό που έχετε δηλώσει. Μόλις έλθει (μπορεί κα να καθυστερήσει έως 30 λεπτά), παρακαλούμε ανοίξτε αυτό το e-mail και πατήστε στον σύνδεσμο που θα βρείτε, προκειμένου να επιβεβαιώσετε το e-mail σας.', 'Επιτυχής Εγγραφή')
        //         ->persistent('Το κατάλαβα');

        //flash()->error('You have been logged out.');


        return view('home');
    }
}
