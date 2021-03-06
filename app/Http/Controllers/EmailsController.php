<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Grader;

use App\Site;

use App\Summary_A;

use App\Evaluation;

use App\Evaluation_b;

use App\Evaluation_c;

use App\Config;

use Mail;

use DB;

class EmailsController extends Controller
{
    public function __construct()
    {
        $this->middleware('is_member');

        $this->middleware('is_ninja', ['only' => [
          'send_to_graders_a_to_begin',
          'send_to_graders_b_to_begin',
          'send_to_late_graders_a',
          'send_to_late_graders_b',
          'send_to_graders_a_who_did_not_finish',
          'send_to_sites_about_late_graders_a',
          'send_to_sites_about_end_of_phase_a',
          'send_to_sites_about_end_of_phase_b',
          'send_to_sites_about_end_of_phase_c',
          'send_survey_to_sites',
          'send_survey_to_graders',
        ]]);

    }

    public function send_to_graders_a_to_begin()
    {
        $status = 'off';

        if($status == 'on'){

            $summaries = Summary_A::all();

            $from = 60;
            $to = 60;

            foreach($summaries as $summary){
                if($summary->id >= $from && $summary->id <= $to){            

                    Mail::send('emails.send_to_graders_a_to_begin', ['summary' => $summary], function ($message) use ($summary) {                        
                        $message->to($summary->grader_email, $summary->grader_email)->subject('ΠΡΟΣΚΛΗΣΗ ΓΙΑ ΚΡΙΣΗ - ΑΝΑΘΕΣΗ ΙΣΤΟΤΟΠΩΝ ΣΕ ΑΞΙΟΛΟΓΗΤΗ Α - ' .Config::first()->index. 'ου ΔΕΕΙ');
                    });

                    echo $summary->id . ' . ' . $summary->grader_email . '<br>';

                }
            }

        }

    }

    public function send_to_graders_b_to_begin()
    {
        $status = 'on';

        if($status == 'on'){

            $summaries = Summary_A::all();

            $from = 1;
            $to = 1;

            foreach($summaries as $summary){
                if($summary->id >= $from && $summary->id <= $to){            

                    Mail::send('emails.send_to_graders_b_to_begin', ['summary' => $summary], function ($message) use ($summary) {                        
                        $message->to($summary->grader_email, $summary->grader_email)->subject('ΠΡΟΣΚΛΗΣΗ ΓΙΑ ΚΡΙΣΗ - ΑΝΑΘΕΣΗ ΙΣΤΟΤΟΠΩΝ ΣΕ ΑΞΙΟΛΟΓΗΤΗ Β - ' .Config::first()->index. 'ου ΔΕΕΙ');
                    });

                    echo $summary->id . ' . ' . $summary->grader_email . '<br>';

                }
            }

            return "emails sent";

        } else {
            return "status: off";
        }

    }    

    public function send_to_late_graders_a()
    {
        $status = 'on';

        if($status == 'on'){

            $evaluations = Evaluation::distinct()->select('grader_id')->where('can_evaluate', '=', 'na')->groupBy('grader_id')->get();
            
            $i = 0;            

            foreach($evaluations as $evaluation){
                
                $grader = Grader::find($evaluation->grader_id);

                if($grader){

                    $i++;

                    $grader_email = $grader->user->email;

                    $data = [];
                    $data['grader_name'] = $grader->last_name .' '. $grader->first_name;
                    $data['grader_email'] = $grader_email;

                    //if($i == 1){
                        Mail::send('emails.send_to_late_graders_a', ['data' => $data], function ($message) use ($data) {                        
                            $message->to($data['grader_email'],$data['grader_email'])->subject('Α ΦΑΣΗ. ΥΠΕΝΘΥΜΙΣΗ ΓΙΑ ΚΡΙΣΗ - ' .Config::first()->index. 'ος ΔΕΕΙ');
                        });
                    //}

                    echo $i . ' -- ' . $grader->id . '. ' . $grader_email . '<br>';                    

                }

            }

        } else {
            return 'status: off';
        }

    }

    public function send_to_late_graders_b()
    {
        $status = 'on';

        if($status == 'on'){

            $evaluations = Evaluation_b::all();
            
            $i = 0;

            $grader_ids = [];      

            foreach($evaluations as $evaluation){

                if(!$evaluation->complete()){
                    $grader_ids[] = $evaluation->grader_id;
                }                          

            }

            $the_grader_ids = array_unique($grader_ids);

            foreach($the_grader_ids as $grader_id){
                
                $grader = Grader::find($grader_id);

                if($grader){

                    $i++;

                    $grader_email = $grader->user->email;

                    $data = [];
                    $data['grader_name'] = $grader->last_name .' '. $grader->first_name;
                    $data['grader_email'] = $grader_email;

                    Mail::send('emails.send_to_late_graders_b', ['data' => $data], function ($message) use ($data) {                        
                        $message->to($data['grader_email'],$data['grader_email'])->subject('Β ΦΑΣΗ. ΥΠΕΝΘΥΜΙΣΗ ΓΙΑ ΚΡΙΣΗ - ' .Config::first()->index. 'ος ΔΕΕΙ');
                    });

                    echo $i . ' -- ' . $grader->id . '. ' . $grader_email . '<br>';                    

                }                

            }

        } else {
            return 'status: off';
        }        

    }    

    public function send_to_graders_a_who_did_not_finish()
    {
        $status = 'on';

        if($status == 'on'){

            $evaluations = Evaluation::distinct()->select('grader_id')
            ->where('can_evaluate', '=', 'yes')
            ->where('total_grade', '=', 2)
            ->groupBy('grader_id')->get();
            
            $i = 0;            

            foreach($evaluations as $evaluation){
                
                $grader = Grader::find($evaluation->grader_id);

                if($grader){

                    $i++;

                    $grader_email = $grader->user->email;

                    $data = [];
                    $data['grader_name'] = $grader->last_name .' '. $grader->first_name;
                    $data['grader_email'] = $grader_email;

                    //if($i == 1){
                        Mail::send('emails.send_to_graders_a_who_did_not_finish', ['data' => $data], function ($message) use ($data) {                        
                            $message->to($data['grader_email'], $data['grader_email'])->subject('Α ΦΑΣΗ. ΥΠΕΝΘΥΜΙΣΗ ΓΙΑ ΟΛΟΚΛΗΡΩΣΗ ΒΑΘΜΟΛΟΓΙΑΣ - ' .Config::first()->index. 'ος ΔΕΕΙ');
                        });
                    //}

                    echo $i . ' -- ' . $grader->id . '. ' . $grader_email . '<br>';                    

                }

            }

        } else {
            return 'status: off';
        }

    }

    public function send_to_sites_about_late_graders_a()
    {
        $status = 'on';

        if($status == 'on'){

            $sites = Site::all();

            $i = 0;

            foreach($sites as $site){

                $grader = $site->user->suggestedGrader();

                $evaluations_not_accepted = Evaluation::where('grader_id', $grader->id)
                                            ->where('can_evaluate', 'na')
                                            ->get();

                $evaluations_not_finished = Evaluation::where('grader_id', $grader->id)
                                            ->where('can_evaluate', 'yes')
                                            ->where('total_grade', 2)
                                            ->get();

                if($evaluations_not_accepted->count() > 0 || $evaluations_not_finished->count() > 0){

                    if($site->user->email != $grader->user->email){

                        $i++;

                        $site_email = $site->user->email;

                        $data = [];
                        $data['site_name'] = $site->responsible;
                        $data['grader_name'] = $grader->last_name .' '. $grader->first_name;
                        $data['site_email'] = $site_email;

                        //if($i == 1){
                            Mail::send('emails.send_to_sites_about_late_graders_a', ['data' => $data], function ($message) use ($data) {                        
                                $message->to($data['site_email'], $data['site_email'])->subject('Α ΦΑΣΗ. ΜΗ ΟΛΟΚΛΗΡΩΣΗ ΑΞΙΟΛΟΓΗΣΗΣ ΑΠΟ ΑΞΙΟΛΟΓΗΤΗ Α - ' .Config::first()->index. 'ος ΔΕΕΙ');
                            });
                        //}

                        echo $i . ' -- ' . $grader->id . '. ' . $site->id . ' . '. $site_email . '<br>';
                    }

                }

            }

        } else {
            return "status: off";
        }

    }

    public function send_extra_to_grader_a($evaluation_id)
    {
        $evaluation = Evaluation::find($evaluation_id);

        $grader = Grader::find($evaluation->grader_id);
        $site = Site::find($evaluation->site_id);

        $grader_email = $grader->user->email;

        $data = [];
        $data['grader_name'] = $grader->last_name .' '. $grader->first_name;
        $data['site_url'] = $site->url;
        $data['site_title'] = $site->title;
        $data['grader_email'] = $grader_email;

        Mail::send('emails.send_extra_to_grader_a', ['data' => $data], function ($message) use ($data) {                        
            $message->to($data['grader_email'], $data['grader_email'])->subject('ΑΝΑΘΕΣΗ ΙΣΤΟΤΟΠΩΝ ΣΕ ΑΞΙΟΛΟΓΗΤΗ Α ' .Config::first()->index. 'ου ΔΕΕΙ');
        });

        alert()->success('Επιτυχής Αποστολή email');

        return redirect()->back();
    }

    public function send_extra_to_grader_b($evaluation_id)
    {
        $evaluation = Evaluation_b::find($evaluation_id);

        $grader = Grader::find($evaluation->grader_id);
        $site = Site::find($evaluation->site_id);

        $grader_email = $grader->user->email;

        $data = [];
        $data['grader_name'] = $grader->last_name .' '. $grader->first_name;
        $data['site_url'] = $site->url;
        $data['site_title'] = $site->title;
        $data['grader_email'] = $grader_email;

        Mail::send('emails.send_extra_to_grader_b', ['data' => $data], function ($message) use ($data) {                        
            $message->to($data['grader_email'], $data['grader_email'])->subject('ΦΑΣΗ Β - ΑΝΑΘΕΣΗ ΙΣΤΟΤΟΠΩΝ ΣΕ ΑΞΙΟΛΟΓΗΤΗ Β ' .Config::first()->index. 'ου ΔΕΕΙ');
        });

        alert()->success('Επιτυχής Αποστολή email');

        return redirect()->back();
    }    

    public function send_extra_to_grader_20pc($evaluation_id)
    {
        $evaluation = Evaluation::find($evaluation_id);

        $grader = Grader::find($evaluation->grader_id);
        $site = Site::find($evaluation->site_id);

        $grader_email = $grader->user->email;

        $data = [];
        $data['grader_name'] = $grader->last_name .' '. $grader->first_name;
        $data['site_url'] = $site->url;
        $data['site_title'] = $site->title;
        $data['grader_email'] = $grader_email;

        Mail::send('emails.send_extra_to_grader_20pc', ['data' => $data], function ($message) use ($data) {                       
            $message->to($data['grader_email'], $data['grader_email'])->subject('ΦΑΣΗ Β - ΑΝΑΘΕΣΗ ΙΣΤΟΤΟΠΩΝ ΣΕ ΤΡΙΤΟ ΑΞΙΟΛΟΓΗΤΗ ' .Config::first()->index. 'ου ΔΕΕΙ');
        });

        alert()->success('Επιτυχής Αποστολή email');

        return redirect()->back();
    }

    public function send_extra_to_grader_b_20pc($evaluation_id)
    {
        $evaluation = Evaluation_b::find($evaluation_id);

        $grader = Grader::find($evaluation->grader_id);
        $site = Site::find($evaluation->site_id);

        $grader_email = $grader->user->email;

        $data = [];
        $data['grader_name'] = $grader->last_name .' '. $grader->first_name;
        $data['site_url'] = $site->url;
        $data['site_title'] = $site->title;
        $data['grader_email'] = $grader_email;

        Mail::send('emails.send_extra_to_grader_b_20pc', ['data' => $data], function ($message) use ($data) {                       
            $message->to($data['grader_email'], $data['grader_email'])->subject('ΑΝΑΘΕΣΗ ΙΣΤΟΤΟΠΩΝ ΣΕ ΤΡΙΤΟ ΑΞΙΟΛΟΓΗΤΗ ' .Config::first()->index. 'ου ΔΕΕΙ');
        });

        alert()->success('Επιτυχής Αποστολή email');

        return redirect()->back();
    }

    public function send_extra_c_to_grader_b($evaluation_id)
    {
        $evaluation = Evaluation_c::find($evaluation_id);

        $grader = Grader::find($evaluation->grader_id);
        $site = Site::find($evaluation->site_id);

        $grader_email = $grader->user->email;

        $data = [];
        $data['grader_name'] = $grader->last_name .' '. $grader->first_name;
        $data['site_url'] = $site->url;
        $data['site_title'] = $site->title;
        $data['grader_email'] = $grader_email;

        Mail::send('emails.send_extra_c_to_grader_b', ['data' => $data], function ($message) use ($data) {                        
            $message->to($data['grader_email'], $data['grader_email'])->subject('ΦΑΣΗ Γ - ΑΝΑΘΕΣΗ ΙΣΤΟΤΟΠΩΝ ΣΕ ΑΞΙΟΛΟΓΗΤΗ Β ' .Config::first()->index. 'ου ΔΕΕΙ');
        });

        alert()->success('Επιτυχής Αποστολή email');

        return redirect()->back();
    }

    public function send_extra_c_to_grader_b_20pc($evaluation_id)
    {
        $evaluation = Evaluation_c::find($evaluation_id);

        $grader = Grader::find($evaluation->grader_id);
        $site = Site::find($evaluation->site_id);

        $grader_email = $grader->user->email;

        $data = [];
        $data['grader_name'] = $grader->last_name .' '. $grader->first_name;
        $data['site_url'] = $site->url;
        $data['site_title'] = $site->title;
        $data['grader_email'] = $grader_email;

        Mail::send('emails.send_extra_c_to_grader_b_20pc', ['data' => $data], function ($message) use ($data) {                       
            $message->to($data['grader_email'], $data['grader_email'])->subject('ΦΑΣΗ Γ - ΑΝΑΘΕΣΗ ΙΣΤΟΤΟΠΩΝ ΣΕ ΤΡΙΤΟ ΑΞΙΟΛΟΓΗΤΗ ' .Config::first()->index. 'ου ΔΕΕΙ');
        });

        alert()->success('Επιτυχής Αποστολή email');

        return redirect()->back();
    }              

    public function send_extra_to_grader_c()
    {
        $grader_ids = [68, 183, 155, 159];

        foreach($grader_ids as $grader_id){

            $grader = Grader::find($grader_id);

            $grader_email = $grader->user->email;

            $data = [];
            $data['grader_name'] = $grader->last_name .' '. $grader->first_name;
            $data['grader_email'] = $grader_email;

            Mail::send('emails.send_extra_to_grader_c', ['data' => $data], function ($message) use ($data) {                        
                $message->to($data['grader_email'], $data['grader_email'])->subject('ΦΑΣΗ Γ - ΑΝΑΘΕΣΗ ΙΣΤΟΤΟΠΟΥ ΣΕ ΑΞΙΟΛΟΓΗΤΗ Β ' .Config::first()->index. 'ου ΔΕΕΙ');
            });   

        }

        alert()->success('Επιτυχής Αποστολή email');

        return redirect()->back();
    }

    public function send_to_sites_about_end_of_phase_a()
    {
        $status = 'off';

        if($status == 'on'){

            $sites = Site::all();

            $from = 201;
            $to = 250;

            $winners = explode('|', Config::first()->winners_a); 

            foreach($sites as $site){
                if($site->id >= $from && $site->id <= $to){
                    $data = [];
                    $data['site_email'] = $site->contact_email;
                    $data['site_title'] = $site->title;
                    $data['winner'] = false;
                    if(in_array($site->id, $winners)){
                        $data['winner'] = true;
                    }
                    Mail::send('emails.send_to_sites_about_end_of_phase_a', ['data' => $data], function ($message) use ($data) {                        
                        $message->to($data['site_email'], $data['site_email'])->subject('ΑΠΟΤΕΛΕΣΜΑΤΑ ΦΑΣΗΣ Α - ' .Config::first()->index. 'ου ΔΕΕΙ');
                    });

                    echo $site->id .'- ' . $data['site_email'] . '<br>';

                }
            }

        } else {
            return "status: off";
        }


    }

    public function send_to_sites_about_end_of_phase_b()
    {
        $status = 'off';

        if($status == 'on'){

            $winners = explode('|', Config::first()->winners_b);          

            foreach($winners as $site_id){
                $site = Site::find($site_id);
                $data = [];
                $data['site_email'] = $site->contact_email;
                $data['site_title'] = $site->title;
                $data['site_creator'] = $site->creator;

                Mail::send('emails.send_to_sites_about_end_of_phase_b', ['data' => $data], function ($message) use ($data) {                        
                    $message->to($data['site_email'], $data['site_email'])->subject('ΑΝΑΚΟΙΝΩΣΗ - ' .Config::first()->index. 'ου ΔΕΕΙ');
                });

                echo $site->id .'- ' . $data['site_email'] . ' - '. $data['site_creator'] .'<br>';

            }

        } else {
            return "status: off";
        }

    }

    public function send_to_sites_about_end_of_phase_c()
    {
        $status = 'off';

        if($status == 'on'){

            $winners = explode('|', Config::first()->winners_a);          

            foreach($winners as $site_id){
                $site = Site::find($site_id);
                $data = [];
                $data['site_email'] = $site->contact_email;
                $data['site_title'] = $site->title;
                $data['site_creator'] = $site->creator;

                Mail::send('emails.send_to_sites_about_end_of_phase_c', ['data' => $data], function ($message) use ($data) {                        
                    $message->to($data['site_email'], $data['site_email'])->subject('ΤΕΛΙΚΑ ΑΠΟΤΕΛΕΣΜΑΤΑ - ' .Config::first()->index. 'ου ΔΕΕΙ');
                });

                echo $site->id .'| ' . $data['site_email'] . ' - '. $data['site_creator'] .'<br>';

            }

        } else {
            return "status: off";
        }

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
        $status = 'off';

        if($status == 'on'){

            $graders = Grader::all();

            $contest_index = Config::first()->index;

            $i = 1;

            foreach($graders as $grader){
                if(!$grader->user->hasRole('member')){
                    if($grader->user->hasRole('grader_a') && !$grader->hasSite()){

                        $data = [];

                        $data = [
                            'grader' => $grader,
                            'contest_index' => $contest_index,
                        ];

                        Mail::send('emails.send_to_graders_a_without_sites', $data, function ($message) use ($data) {                        
                            $message->to($data['grader']->user->email, $data['grader']->user->email)->subject('Σχετικά με την Υποψηφιότητά σας στον ' .  $data['contest_index'] .'ο ΔΕΕΙ');
                        });

                        echo $i . '. ' . $grader->id . '<br>';
                        $i++;

                        unset($data);

                    }
                }
            }
        } else {
            return 'status: off';
        }        

    }

    public function send_survey_to_sites()
    {
        $status = 'off';

        if($status == 'on'){

            $sites = Site::all();

            $from = 0;
            $to = 0; 

            foreach($sites as $site){
                if(!$site->disq() && $site->id >= $from && $site->id <= $to){
                    $data = [];
                    $data['site_email'] = $site->contact_email;
                    
                    Mail::send('emails.send_survey_to_sites', ['data' => $data], function ($message) use ($data) {                        
                        $message->to($data['site_email'], $data['site_email'])->subject('ΕΡΩΤΗΜΑΤΟΛΟΓΙΟ - ΒΑΘΜΟΛΟΓΙΕΣ - ΒΕΒΑΙΩΣΕΙΣ ΣΥΜΜΕΤΟΧΗΣ ' .Config::first()->index. 'ου ΔΕΕΙ');
                    });

                    echo $site->id .'- ' . $data['site_email'] . '<br>';

                }
            }

            // $data = [];
            // $data['site_email'] = 'chralatz@gmail.com';
            
            // Mail::send('emails.send_survey_to_sites', ['data' => $data], function ($message) use ($data) {                        
            //     $message->to($data['site_email'], $data['site_email'])->subject('ΕΡΩΤΗΜΑΤΟΛΟΓΙΟ - ΒΑΘΜΟΛΟΓΙΕΣ - ΒΕΒΑΙΩΣΕΙΣ ΣΥΜΜΕΤΟΧΗΣ - ' .Config::first()->index. 'ου ΔΕΕΙ');
            // });            

        } else {
            return "status: off";
        }

    }

    public function send_survey_to_graders()
    {
        $status = 'off';

        if($status == 'on'){

            $graders = Grader::all();

            $from = 0;
            $to = 0;

            foreach($graders as $grader){
                if($grader->has_graded() && $grader->id >= $from && $grader->id <= $to){
                    if(!$grader->user->hasRole('site')){
                        $data = [];
                        $data['grader_email'] = $grader->user->email;
                        
                        Mail::send('emails.send_survey_to_graders', ['data' => $data], function ($message) use ($data) {                        
                            $message->to($data['grader_email'], $data['grader_email'])->subject('ΕΡΩΤΗΜΑΤΟΛΟΓΙΟ - ΒΑΘΜΟΛΟΓΙΕΣ - ΒΕΒΑΙΩΣΕΙΣ ΣΥΜΜΕΤΟΧΗΣ - ' .Config::first()->index. 'ου ΔΕΕΙ');
                        });

                        echo $grader->id .'- ' . $data['grader_email'] . '<br>';
                    }
                }
            }

            // $data = [];
            // $data['grader_email'] = 'chralatz@gmail.com';
            
            // Mail::send('emails.send_survey_to_graders', ['data' => $data], function ($message) use ($data) {                        
            //     $message->to($data['grader_email'], $data['grader_email'])->subject('ΕΡΩΤΗΜΑΤΟΛΟΓΙΟ - ΒΑΘΜΟΛΟΓΙΕΣ - ΒΕΒΑΙΩΣΕΙΣ ΣΥΜΜΕΤΟΧΗΣ - ' .Config::first()->index. 'ου ΔΕΕΙ');
            // });            

        } else {
            return "status: off";
        }

    }   


}
