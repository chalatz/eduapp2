<?php

namespace App\Http\Controllers;

use App\Grader;
use App\Site;
use App\User;
use App\Suggestion;
use App\The_sites;
use App\The_graders;
use App\Assignment;
use App\Evaluation;

use Auth;

use Illuminate\Http\Request;

use App\Http\Requests;

class EvaluationsController extends Controller
{
    public function __construct()
        {
            $this->middleware('verified');

        }

    public function show()
    {
        $user = Auth::user();

        $site = $user->site;
        $grader = $user->grader;

        $evaluations = Evaluation::where('grader_id', $grader->id)->get();

        return view ('evaluations.a.show', compact('evaluations', 'user', 'site', 'grader'));

    }

    public function can_evaluate_submit(Request $request, $id)
    {
        $this->validate($request, [
            'can_evaluate' => 'required',
            'why_cannot_evaluate' => 'required_if:can_evaluate,no',
        ]);

    }

    public function init()
    {
        $status = 'off';

        if($status == 'on'){

            $assignments = Assignment::all();

            foreach($assignments as $assignment){
                $data = [];

                $data['site_id'] = $assignment->site_id;
                $data['grader_id'] = $assignment->grader_id;

                Evaluation::create($data);

            }
        } else {
            return "status: off";
        }

        return "evals initialized";

    }

}
