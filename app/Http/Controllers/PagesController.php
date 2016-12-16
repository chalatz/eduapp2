<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

use App\Suggestion;
use App\Site;
use App\Grader;
use App\User;

use App\Http\Utilities\Category;
use App\Http\Utilities\District;
use App\Http\Utilities\Specialty;
use App\Http\Utilities\Teaching_xp;

use Carbon\Carbon;

use Auth;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('site_submissions_open', ['only' => [
            'choose_grader_type',
            'suggest_other_grader',
            'other_grader_email',
        ]]);

        $this->middleware('verified', ['only' => [
            'choose_grader_type',
            'suggest_other_grader',
            'other_grader_email',
        ]]);

        $this->middleware('suggestion_not_made',['only' => [
            'choose_grader_type',
            'other_grader_email',
        ]]);

        $this->middleware('grader_has_not_accepted', ['only' => [
            //'choose_grader_type',
            'suggest_other_grader',
            //'other_grader_email',
        ]]);

        $this->middleware('is_member', ['only' => [
            'grader_statistics',
            'submissions',
        ]]);

    }

    public function index()
    {
        return view('pages.index');
    }

    public function choose_grader_type()
    {
        return view('pages.choose_grader_type');
    }

    public function suggest_other_grader()
    {
        return view('pages.suggest_other_grader');
    }

    public function other_grader_email()
    {
        return view('pages.other_grader_email');
    }

    public function statistics()
    {

        $sites = Site::all();
        $cats = Category::all();
        $districts = District::all();

        $cats_total = 0;

        foreach($cats as $cat_id => $cat_name){
            
            $cats_total += Site::where('cat_id', '=', $cat_id)->count();
        }        

        return view('pages.statistics', compact(['sites', 'cats', 'districts', 'cats_total']));
    }

    public function grader_statistics($grader_type)
    {
        // if($grader_type == 'a'){
        //     $graders = Grader::alpha();
        // }
        // if($grader_type == 'b'){
        //     $graders = Grader::beta();
        // }

        // $graders = collect([]);
        // foreach(Grader::all() as $grader){
        //     if($grader->user->hasRole('grader_'.$grader_type)){
        //         $graders->push($grader);
        //     }
        // }

        $graders = Grader::with('user')->get();

        $specs = Specialty::all();
        $districts = District::all();
        $xp = Teaching_xp::all();

        $graders_total = 0;
        foreach($graders as $grader){
            if($grader->user->hasRole('grader_'.$grader_type)){
                $graders_total++;
            }
        }

        return view('pages.grader_statistics', compact(['graders','grader_type', 'specs', 'districts', 'xp', 'graders_total']));

    }

    public function get_sites_stats($type, $id)
    {        
        if($type == 'categories'){
            $sites = Site::where('cat_id', $id)->get();
        }
        if($type == 'districts'){
            $sites = Site::where('district_id', $id)->get();
        }

        return view('pages.sites_modal_body', compact('sites', 'type', 'id'));

    }

    public function get_graders_stats($grader_type, $type, $id)
    {
        if($type == 'specialties'){
            $graders = Grader::with('user')->where('specialty_id', $id)->get();
        }
        if($type == 'districts'){
            $graders = Grader::with('user')->where('district_id', $id)->get();
        }
        if($type == 'xp'){
            $graders = Grader::with('user')->where('teaching_xp', 'like', '%'.$id.'%')->get();
        }

        return view('pages.graders_modal_body', compact('graders','grader_type', 'type', 'id'));

    }

    public function submissions()
    {
           
        $sites = Site::latest()
            ->get()
            ->reverse()
            ->groupBy(function($item){ 
                return $item->created_at->format('d-m-y'); 
            });

        // foreach($sites as $date => $site){
        //     echo $date .' '. $site->count() . '<br>';
        // }

        return view('pages.submissions', compact('sites'));
    }

    public function test()
    {
        return view('pages.test');
    }

}
