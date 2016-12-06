<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Mail;

use DB;

class EmailsController extends Controller
{
    public function __construct()
    {
        $this->middleware('is_ninja');

    }

    public function send_to_past_graders()
    {
        $status = 'off';

            if($status == 'on'){

                $graders = DB::table('past_graders_b')->get();

                $from = 1;
                $to = 1;

                foreach($graders as $grader){
                    if($grader->id >= $from && $grader->id <= $to ){
                        
                        Mail::send('emails.send_to_past_graders', ['grader' => $grader], function ($message) use ($grader) {
                        
                            $message->to($grader->email, $grader->email)->subject('ΟΡΘΗ ΕΠΑΝΑΛΗΨΗ ως προς ΗΜΕΡΟΜΗΝΙΑ - Πρόσκληση για Αξιολογητής Β Επιπέδου 8ου ΔΕΕΙ');

                        });

                        echo $grader->id .'. '. $grader->email.'<br>';

                    }
                }

            } else {
                return 'status: off';
            }

    }


}
