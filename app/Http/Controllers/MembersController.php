<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Auth;

use App\Site;
use App\Grader;
use App\Suggestion;
use App\Evaluation;

use Illuminate\Http\Request;

use App\Http\Requests;

class MembersController extends Controller
{

  public function __construct()
  {
      $this->middleware('verified');

      $this->middleware('is_member');

  }

  public function sites()
  {
      $sites = Site::with('user')->get();

      return view('members.sites', compact('sites'));

  }

  public function sites_print()
  {
      $sites = Site::with('user')->get();

      return view('members.sites_print', compact('sites'));

  }

  public function graders_a()
  {
    $graders = Grader::with('user', 'sites')->get();

    return view('members.graders_a', compact('graders'));
  }

  public function graders_a_print()
  {
    $graders = Grader::with('user', 'sites')->get();

    return view('members.graders_a_print', compact('graders'));
  }

  public function graders_b()
  {
    $graders = Grader::with('user')->get();

    return view('members.graders_b', compact('graders'));
  }

  public function graders_b_print()
  {
    $graders = Grader::with('user')->get();

    return view('members.graders_b_print', compact('graders'));
  }

  public function approve($grader_id)
  {
        $grader = Grader::find($grader_id);

        $grader->approved_at = Carbon::now();
        $grader->approver_email = Auth::user()->email;
        $grader->approved = 1;

        $grader->save();

        alert()->success('Μην ξεχνάς ότι ξέρουμε ποιος είσαι.', 'Επιτυχής Έκγριση!')
                ->persistent('Το κατάλαβα');

        return redirect()->back();

  }

  public function handle_sites($cat_id)
  {
    $accepted_cat_ids = ['1','3','6'];

    if(!in_array($cat_id, $accepted_cat_ids)){
      return redirect()->route('home');
    }

    $sites = Site::where('cat_id', $cat_id)->get();

    return view('members.handle_sites', compact('sites', 'cat_id'));

  }

  public function post_handle_sites(Request $request)
  {
    $site_id = $request->site_id;

    $property_id = $request->property_id;

    $site = Site::find($site_id);

    if($request->handle_sites_cat_id == 6){
      $site->specialty_id = $property_id;
    }

    if($request->handle_sites_cat_id == 1){
      $site->primary_edu_id = $property_id;
    }

    if($request->handle_sites_cat_id == 3){
      $site->secondary_edu_id = $property_id;
    }

    $site->save();

    return response()->json(['message' => $request['site_id']]);

  }

  public function sites_grades_a()
  {

    $sites = Site::all();

    $max_evals = 0;

    foreach($sites as $site){
      $evals_count = Evaluation::where('site_id', $site->id)->count();
      if($evals_count > $max_evals){
          $max_evals = $evals_count;
      }
    }

    return view('members.sites_grades_a', compact('sites', 'max_evals'));

  }
  

}
