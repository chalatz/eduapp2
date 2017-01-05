<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Grader;

use App\Config;

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
                            $message->to($grader->email, $grader->email)->subject('ΟΡΘΗ ΕΠΑΝΑΛΗΨΗ ως προς ΗΜΕΡΟΜΗΝΙΑ - Πρόσκληση για Αξιολογητής Β Επιπέδου ' .Config::first()->index. 'ου ΔΕΕΙ');
                        });

                        echo $grader->id .'. '. $grader->email.'<br>';

                    }
                }

            } else {
                return 'status: off';
            }

    }

    public function send_to_graders_a_without_sites()
    {
        $status = 'on';

        if($status == 'on'){

            $graders = Grader::all();

            $contest_index = Config::first()->index;

            $data = [
                'grader' => $grader,
                'contest_index' => $contest_index,
            ];

            $i = 1;

            foreach($graders as $grader){
                if(!$grader->user->hasRole('member') || $grader->user->hasRole('ninja')){
                    if($grader->user->hasRole('grader_a') && !$grader->hasSite()){

                        Mail::send('emails.send_to_graders_a_without_sites', $data, function ($message) use ($data) {                        
                            $message->to($data['grader']->user->email, $data['grader']->user->email)->subject('Σχετικά με την Υποψηφιότητά σας στον ' .  $data['contest_index'] .'ο ΔΕΕΙ');
                        });

                        echo $i . '. ' . $grader->id . '<br>';
                        $i++;
                    }
                }
            }
        } else {
            return 'status: off';
        }        

    }


}
