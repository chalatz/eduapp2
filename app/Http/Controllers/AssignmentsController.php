<?php

namespace App\Http\Controllers;

use App\Grader;
use App\Site;
use App\User;
use App\Suggestion;
use App\The_sites;
use App\The_graders;
use App\Assignment;
use App\Assignment_b;
use App\Config;

use DB;

use Illuminate\Http\Request;

use App\Http\Requests;

class AssignmentsController extends Controller
{
  public function __construct()
    {
        $this->middleware('verified');

        $this->middleware('is_member');

        $this->middleware('is_ninja', ['except' => [
            'assignments_panel_a_sites',
            'assign_site_a',
            'store_manual_a',
            'assign_delete_a',
            'assignments_panel_b_sites',
            'assign_site_b',
            'store_manual_b',
            'assign_delete_b',
        ]]);

    }

    public function assignments_panel_a_sites($cat)
    {
        if($cat == 'all'){
            $sites = Site::all();            
        } else {
            $sites = Site::where('cat_id', $cat)->get();
        }

        $my_graders = Grader::all();

        return view('assignments.panel_a_sites', compact('sites', 'my_graders', 'cat'));
    }

    public function assignments_panel_b_sites($cat)
    {
        if($cat == 'all'){
            $sites = Site::all();            
        } else {
            $sites = Site::where('cat_id', $cat)->get();
        }

        $winners = Config::first()->winners_a;

        $winners_ids = explode('|', $winners);

        return view('assignments.panel_b_sites', compact('sites', 'cat', 'winners_ids'));
    }       

    public function assign_site_a($site_id)
    {
        $site = Site::find($site_id);
        $graders = Grader::all();
        $assignments = Assignment::where('site_id', $site->id)->get();

        return view('assignments.assign_site_a', compact('site', 'assignments', 'graders'));

    }

    public function assign_site_b($site_id)
    {
        $site = Site::find($site_id);

        $graders = Grader::where('approved', 1)->get();

        $assignments = Assignment_b::where('site_id', $site->id)->get();

        return view('assignments.assign_site_b', compact('site', 'assignments', 'graders'));

    }    

    public function store_manual_a(Request $request)
    {
        $this->validate($request, ['grader_id' => 'required']);

        $data = [];
        $data['site_id'] = $request->site_id;
        $data['grader_id'] = $request->grader_id;

        Assignment::create($data);

        alert()->success('Επιτυχής Υποβολή Ανάθεσης');

        return redirect()->route('assign_site_a', $request->site_id);
    }

    public function store_manual_b(Request $request)
    {
        $this->validate($request, ['grader_id' => 'required']);

        $data = [];
        $data['site_id'] = $request->site_id;
        $data['grader_id'] = $request->grader_id;

        Assignment_b::create($data);

        alert()->success('Επιτυχής Υποβολή Ανάθεσης');

        return redirect()->route('assign_site_b', $request->site_id);
    }    

    public function assign_delete_a($assignment_id, $site_id)
    {
        $assignment = Assignment::findOrFail($assignment_id);

        $assignment->delete();

        alert()->success('Επιτυχής Διαγραφή');

        return redirect()->route('assign_site_a', $site_id);

    }

    public function assign_delete_b($assignment_id, $site_id)
    {
        $assignment = Assignment_b::findOrFail($assignment_id);

        $assignment->delete();

        alert()->success('Επιτυχής Διαγραφή');

        return redirect()->route('assign_site_b', $site_id);

    }    

    public function assigns_a($type)
    {
        $status = 'off';

        if ($status == 'on'){
            DB::table('assignments')->truncate();

            if($type == 'all'){
                $sites = The_sites::all();
            }

            if($type == 'personal'){
                $sites = The_sites::where('cat_id', 6)->get();
            }

            $graders = The_graders::all();

            $this->attempt_a($sites, $graders);
        } else {
            return "status: off";
        }

    }

    private function attempt_a($sites, $graders){

        foreach($sites as $site){
            if($site->graders_left > 0){

                foreach($graders as $grader){
                    
                    if(Assignment::where('site_id', $site->id)->count() > 0){
                        $assignment = Assignment::where('site_id', $site->id)->first();
                        $existed_grader_id = $assignment->grader_id;
                    } else {
                        $existed_grader_id = 0;
                    }

                    if(
                        $grader->grader_id != $site->grader_id &&
                        $grader->grader_id != $existed_grader_id &&
                        $grader->district_id != $site->district_id &&
                        $grader->cat_id != $site->cat_id &&
                        $grader->sites_left > 0
                    ){
                        $data = [];
                        $data['site_id'] = $site->id;
                        $data['grader_id'] = $grader->grader_id;
                        
                        Assignment::create($data);

                        $site->graders_left -= 1;
                        $site->save();

                        $grader->sites_left -= 1;
                        $grader->save();
                    }

                        $the_site = The_sites::where('site_id', $site->site_id)->first();
                        if($the_site->graders_left == 0){
                            break;
                        }
                }

            }
        }

    }

    private function attempt_b($sites, $graders){

        foreach($sites as $site){

            if($site->graders_left > 0){

                if(Assignment::where('site_id', $site->id)->count() > 0){
                    $assignment = Assignment::where('site_id', $site->id)->first();
                    $existed_grader_id = $assignment->grader_id;
                } else {
                    $existed_grader_id = 0;
                }

                $availables = [];
                foreach(The_graders::all() as $grader){
                    if(Assignment::where('site_id', $site->id)->count() > 0){
                        $assignment = Assignment::where('site_id', $site->id)->first();
                        $existed_grader_id = $assignment->grader_id;
                    } else {
                        $existed_grader_id = 0;
                    }                                      
                    if($grader->sites_left > 0 && $grader->grader_id != $existed_grader_id && $grader->district_id != $site->district_id){
                        array_push($availables, $grader);
                    }
                }

                // $districts = [];
                // foreach($availables as $available){
                //     if($available->district_id != $site->district_id && $available->grader_id != $existed_grader_id){
                //         array_push($districts, $available);
                //     }
                // }

                if(count($availables) == 0 ){
                    exit();
                }

                if(count($availables) > 1 && count($availables) >= 2){
                    $sliced = array_slice($availables, 0,2);
                }

                if(count($availables) == 1){
                    $sliced = array_slice($availables, 0,1);
                }                

                foreach($sliced as $slice){
                    if($slice->district_id != $site->district_id && $slice->grader_id != $existed_grader_id){
                        $data = [];
                        $data['site_id'] = $site->id;
                        $data['grader_id'] = $slice->grader_id;

                        $the_site = The_sites::where('site_id', $site->site_id)->first();
                        $the_site_graders_left = $the_site->graders_left;
                        $the_site->graders_left = $the_site_graders_left - 1;
                        $the_site->save();

                        $the_grader = The_graders::where('grader_id', $slice->grader_id)->first();
                        $the_grader_sites_left = $the_grader->sites_left;
                        $the_grader->sites_left = $the_grader_sites_left - 1;
                        $the_grader->save();

                        Assignment::create($data);

                        if($the_grader->sites_left == 0){
                            $the_grader->delete();
                        }

                    } else {
                        exit();
                    }


                }


                // foreach($districts as $district){
                //     //if($site->graders_left > 0){
                //         $data = [];
                //         $data['site_id'] = $site->id;
                //         $data['grader_id'] = $district->grader_id;
                        
                //         Assignment::create($data);

                //         $site->graders_left -= 1;
                //         $site->save();

                //         $district->sites_left -= 1;
                //         $district->save();

                //         $the_site = The_sites::where('site_id', $site->site_id)->first();
                //         if($the_site->graders_left == 0){
                //             break;
                //         }                    
                //     //}

                // }

            }


        }

    }

    public function assigns_tables($type)
    {
        $status = 'off';

        if($status == 'on'){

            if($type=='sites'){

                DB::table('the_sites')->truncate();

                $sites = Site::all();

                foreach($sites as $site){
                    $data = [];
                    $data['site_id'] = $site->id;
                    $data['district_id'] = $site->district_id;
                    $data['cat_id'] = $site->cat_id;
                    $data['specialty_id'] = $site->specialty_id;
                    $data['grader_id'] = $site->grader_id;
                    $data['graders_left'] = 2;

                    The_sites::create($data);
                    unset($data);
                }

                return "sites ok";
            }

            if($type=='graders_a'){

                DB::table('the_graders')->truncate();

                $graders = Grader::all();

                foreach($graders as $grader){
                    if(!$grader->user->hasRole('member')){
                        if($grader->user->hasRole('grader_a') && $grader->hasSite()){

                            //$suggestions = Suggestion::where('grader_email', $grader->user->email)->where('accepted', 'yes')->get();
                            // $cat_array = [];
                            // foreach($suggestions as $suggestion){
                            //     $user = User::where('email', $suggestion->suggestor_email)->first();
                            //     array_push($cat_array, $user->site->cat_id);
                            // }

                            $cat_array = [];
                            foreach($grader->sites as $site){
                                array_push($cat_array, $site->cat_id);
                            }

                            $data = [];
                            $data['grader_id'] = $grader->id;
                            $data['district_id'] = $grader->district_id;
                            $data['cat_id'] = implode($cat_array, '|');                            
                            $data['specialty_id'] = $grader->specialty_id;
                            $data['sites_left'] = $grader->suggestions_count * 2;
                            
                            The_graders::create($data);                    

                            echo implode($cat_array, '|') . '<br>';
                            echo '--------------------<br>';

                            unset($cat_array);

                            unset($data);

                        }
                    }
                    
                }

                return "graders A ok";
            }            

        } else {
            return "status: off";
        }

    }

    private function the_sites_array()
    {
        $the_sites = [];

        $i = 0;

        $sites = Site::all();

        foreach($sites as $site){
            $the_sites[$i]['id'] = $site->id;
            $the_sites[$i]['district_id'] = $site->district_id;
            $the_sites[$i]['grader_id'] = $site->grader_id;
            $the_sites[$i]['graders_left'] = 2;

            $i++;
        }

        return $the_sites;

    }

    private function the_graders_array()
    {
        $the_graders = [];

        $j = 0;

        $graders = Grader::all();

        foreach($graders as $grader){
            if(!$grader->user->hasRole('member')){
                if($grader->user->hasRole('grader_a') && $grader->hasSite()){
                    $the_graders[$j]['id'] = $grader->id;
                    $the_graders[$j]['district_id'] = $grader->district_id;
                    $the_graders[$j]['sites_left'] = $grader->suggestions_count * 2;
                    

                    $j++;
                }
            }
        }

        return $the_graders;

    }
    

}
