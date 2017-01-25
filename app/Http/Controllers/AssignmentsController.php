<?php

namespace App\Http\Controllers;

use App\Grader;
use App\Site;
use App\Suggestion;
use App\The_sites;
use App\The_graders;
use App\Assignment;

use DB;

use Illuminate\Http\Request;

use App\Http\Requests;

class AssignmentsController extends Controller
{
  public function __construct()
    {
        $this->middleware('verified');

        $this->middleware('is_member');

    }

    public function assignments_panel_a()
    {
        $sites = Site::all();

        return view('assignments.panel_a', compact('sites'));
    }

    public function assign_site_a($site_id)
    {
        $site = Site::find($site_id);
        $assignments = Assignment::where('site_id', $site->id)->get();

        return view('assignments.assign_site_a', compact('site', 'assignments'));

    }  

    public function assigns_a($type)
    {
        DB::table('assignments')->truncate();

        if($type == 'all'){
            $sites = The_sites::all();
        }

        if($type == 'personal'){
            $sites = The_sites::where('cat_id', 6)->get();
        }

        $graders = The_graders::all();

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

    public function assigns_tables($type)
    {
        $status = 'on';

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
                            $data = [];
                            $data['grader_id'] = $grader->id;
                            $data['district_id'] = $grader->district_id;
                            $data['cat_id'] = $grader->sites->first()->cat_id;
                            $data['specialty_id'] = $grader->specialty_id;
                            $data['sites_left'] = $grader->suggestions_count * 2;
                            
                            The_graders::create($data);
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
