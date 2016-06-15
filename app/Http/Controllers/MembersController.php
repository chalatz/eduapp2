<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Auth;

use App\Grader;

use Illuminate\Http\Request;

use App\Http\Requests;

class MembersController extends Controller
{

  public function __construct()
  {
      $this->middleware('verified');

      $this->middleware('is_member');

  }

  public function graders_a()
  {
    $graders = Grader::with('user', 'sites')->get();

    return view('members.graders_a', compact('graders'));
  }

  public function graders_b()
  {
    $graders = Grader::with('user')->get();

    return view('members.graders_b', compact('graders'));
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

}
