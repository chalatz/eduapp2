<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Suggestion;
use App\Site;
use App\Grader;
use App\User;

use App\Http\Utilities\Category;
use App\Http\Utilities\District;
use App\Http\Utilities\Specialty;

use Auth;

class PagesController extends Controller
{
    public function __construct()
    {
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
            'statistics',
            'get_sites_stats',
            'grader_a_statistics',
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

    public function grader_a_statistics()
    {
        $graders = Grader::alpha();
        $specs = Specialty::all();
        $districts = District::all();

        $specs_total = 0;

        foreach($specs as $spec_id => $spec_name){
            
            $specs_total += $graders->where('specialty_id', $spec_id)->count();
        }

        return view('pages.grader_a_statistics', compact(['graders', 'specs', 'specs_total', 'districts']));

    }

    public function get_sites_stats($type, $id)
    {
        //return view('pages.sites_modal_body', compact('sites', 'type'));

        if($type == 'categories'){
            $sites = Site::where('cat_id', $id)->get();
        }
        if($type == 'districts'){
            $sites = Site::where('district_id', $id)->get();
        }

        return view('pages.sites_modal_body', compact('sites', 'type', 'id'));

    }   

    public function test()
    {
        return view('pages.test');
    }

}
