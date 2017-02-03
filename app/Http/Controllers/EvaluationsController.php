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

use Carbon\Carbon;

use Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\EditCriteriaRequest;

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

    public function edit($user_id, $criterion, $grader_id, $site_id)
    {
        $evaluation = Evaluation::where('grader_id', $grader_id)->where('site_id', $site_id)->first();        
        
        if($evaluation->can_evaluate =='no' || $evaluation->finalized == 'yes'){
            return redirect()->route('home');
        }
        
        $user_id = Auth::user()->id;
		
        $user = User::find($user_id);
        
        $grader = Grader::where('user_id', $user_id)->first();

        return view('evaluations.a.edit', compact('evaluation', 'criterion'));

    }

    public function update(EditCriteriaRequest $request, $id)
    {
        $input = $request->all();
        
        $evaluation = Evaluation::find($id);
        
        $total_grade = $evaluation->total_grade;

    }

    public function can_evaluate_submit(Request $request, $id)
    {
        $this->validate($request, [
            'can_evaluate' => 'required',
            'why_cannot_evaluate' => 'required_if:can_evaluate,no',
        ]);

        $data = [];

        $data['assigned_at'] = Carbon::today();
        $data['assigned_until'] = Carbon::today()->addDays(7);
        $data['can_evaluate'] = $request->can_evaluate;
        if($request->why_cannot_evaluate){
            $data['why_cannot_evaluate'] = $request->why_cannot_evaluate;
        }

        $evaluation = Evaluation::find($id);

        if($request->can_evaluate == 'no'){
            $evaluation->total_grade = -1;
        }

        if($request->can_evaluate == 'yes' && $evaluation->total_grade < 10 && $evaluation->is_educational == 'na'){
            $evaluation->total_grade = 2;
        }

        if($request->can_evaluate == 'yes'){
            alert()->success('Ευχαριστούμε για την αποδοχή!', 'Επιτυχία');
        }

        $evaluation->fill($data)->save();

        return redirect()->back();

    }

    public function is_educational_submit(Request $request, $id)
    {
        $this->validate($request, [
            'is_educational' => 'required',
            'why_not_educational' => 'required_if:is_educational,no',
        ]);
        
        $data = [];

        $data['is_educational'] = $request->is_educational;
        if($request->why_not_educational){
            $data['why_not_educational'] = $request->why_not_educational;
        }

        $evaluation = Evaluation::find($id);

        if($request->is_educational == 'no'){
            $evaluation->total_grade = 1;
        }

        if($request->is_educational == 'yes'){
            $evaluation->total_grade = 0;
        }
        
        $evaluation->fill($data)->save();

        alert()->success('Επιτυχής καταχώριση Απάντησης.');

        return redirect()->back();

    }

    public function site_comment_submit(Request $request, $id)
    {
        $evaluation = Evaluation::find($id);

        $evaluation->site_comment = $request->site_comment;

        $evaluation->save();

        alert()->success('Επιτυχής καταχώριση Σχολίου.');

        return redirect()->back();

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
