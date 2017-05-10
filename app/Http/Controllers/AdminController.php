<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use App\Grader;
use App\Site;
use App\Assignment;
use App\Assignment_b;
use App\Suggestion;
use App\Evaluation;
use App\Summary_A;

use Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified');

        $this->middleware('is_admin', ['only' => [
          'masquerade',
          'destroy_suggestion_a',
        ]]);

        $this->middleware('is_ninja', ['only' => [
          'ninja_menu',
          'a_list',
          'create_summary_a',
          'destroy_suggestion_a',
          'sites',
          'graders',
        ]]);

    }

    public function masquerade(Request $request, $user_id)
    {
        if($user_id == Auth::user()->id){

            flash()->error('Προπαθείτε να μεταμφιεστείτε ως ο εαυτός σας!');

        } else {

            // store the id of the ninja user
            $request->session()->put('ninja_id', Auth::user()->id);

            Auth::loginUsingId($user_id);

        }

        return redirect()->route('home');

    }

    public function switch_back(Request $request)
    {
        if($request->session()->has('ninja_id')){

            $admin = User::find($request->session()->get('ninja_id'));

            Auth::logout();
            Auth::login($admin);

            $request->session()->forget('ninja_id');

            return redirect()->route('home');

        }

    }

    public function destroy_suggestion_a($user_id)
    {
        // get the candidate user id
        $user = User::find($user_id);

        $user->grader_status = 'na';

        // get the suggestion
        $suggestion = Suggestion::find($user->suggestion->id);

        $suggestion->delete();

        dd($suggestion->id);

        $user->save();

    }

    public function create_summary_a()
    {
        $status = 'on';
        
        if($status == 'on'){

            $assignments = Assignment_b::all();

            foreach($assignments as $assignment){

                $summary = Summary_A::where('grader_id', $assignment->grader_id)->first();                
                
                if(!$summary){
                    $data = [];
                    $data['grader_id'] = $assignment->grader_id;
                    $data['grader_name'] = Grader::find($assignment->grader_id)->last_name .' '. Grader::find($assignment->grader_id)->first_name;
                    $data['grader_email'] = Grader::find($assignment->grader_id)->user->email;
                    $data['sites_count'] = Assignment_b::where('grader_id', $assignment->grader_id)->count();                     

                    $data['site_titles'] = Site::find($assignment->site_id)->title;
                    $data['site_urls'] = Site::find($assignment->site_id)->url;

                    Summary_A::create($data);

                    unset($data);
                } else {

                    $summary->site_titles .= '{||}' . Site::find($assignment->site_id)->title;
                    $summary->site_urls .= '{||}' . Site::find($assignment->site_id)->url;

                    $summary->save();

                }

            }
            
            return "summaries created";

        } else {
            return 'status: off';
        }

    }

  public function a_list($cat_id = 1){

      $sites = Site::where('cat_id', $cat_id)->get();

      return view('ninja.a_list', compact('sites', 'cat_id'));

  }

    public function sites()
    {
        $sites = Site::all();

        return view('ninja.sites', compact('sites'));

    }

    public function graders()
    {
        $graders = Grader::all();

        return view('ninja.graders', compact('graders'));

    }            

    public function ninja_menu()
    {
        return view('pages.ninja_menu');

    }



}
