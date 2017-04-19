<?php

namespace App\Http\Controllers;

use App\Grader;
use App\Site;
use App\User;

use App\Evaluation_c;
use App\BetaCriterion;
use App\GamaCriterion;
use App\DeltaCriterion;
use App\EpsilonCriterion;
use App\StCriterion;

use Carbon\Carbon;

use Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\EditCriteriaRequest;

class Evaluations_cController extends Controller
{
    public function __construct()
        {
            $this->middleware('verified');

            $this->middleware('is_grader_b');

            $this->middleware('phase_c');

            $this->middleware('must_own_evaluation_c', ['only' => 'edit']);

        }

    public function show()
    {
        $user = Auth::user();

        $site = $user->site;
        $grader = $user->grader;

        $evaluations = Evaluation_c::where('grader_id', $grader->id)->where('can_evaluate', '!=', 'no')->get();

        $colors = ['success', 'info', 'warning','success', 'info', 'warning','success', 'info', 'warning'];

        return view ('evaluations.c.show', compact('evaluations', 'user', 'site', 'grader', 'colors'));

    }

    public function edit($user_id, $criterion, $grader_id, $site_id)
    {
        $evaluation = Evaluation_c::where('grader_id', $grader_id)->where('site_id', $site_id)->first();        
        
        if($evaluation->can_evaluate =='no' || $evaluation->finalized == 'yes'){
            return redirect()->route('home');
        }
        
        $user_id = Auth::user()->id;
		
        $user = User::find($user_id);
        
        $grader = Grader::where('user_id', $user_id)->first();

        return view('evaluations.c.edit', compact('evaluation', 'criterion'));

    }

    public function update(EditCriteriaRequest $request, $id)
    {
        $input = $request->all();
        
        $evaluation = Evaluation_c::find($id);

        if(isset($input['bk1'])){
            $input['beta_grade'] = $input['bk1'] * (BetaCriterion::first()->bk1_weight / 5) +
                                   $input['bk2'] * (BetaCriterion::first()->bk2_weight / 5) +
                                   $input['bk3'] * (BetaCriterion::first()->bk3_weight / 5);
        }

        if(isset($input['gk1'])){
            $input['gama_grade'] = $input['gk1'] * (GamaCriterion::first()->gk1_weight / 5) + 
                                   $input['gk2'] * (GamaCriterion::first()->gk2_weight / 5) + 
                                   $input['gk3'] * (GamaCriterion::first()->gk3_weight / 5) +
                                   $input['gk4'] * (GamaCriterion::first()->gk4_weight / 5) +
                                   $input['gk5'] * (GamaCriterion::first()->gk5_weight / 5);            
            
        }

        if(isset($input['dk1'])){
            $input['delta_grade'] = $input['dk1'] * (DeltaCriterion::first()->dk1_weight / 5) + 
                                    $input['dk2'] * (DeltaCriterion::first()->dk2_weight / 5) + 
                                    $input['dk3'] * (DeltaCriterion::first()->dk3_weight / 5) +
                                    $input['dk4'] * (DeltaCriterion::first()->dk4_weight / 5) +
                                    $input['dk5'] * (DeltaCriterion::first()->dk5_weight / 5);            
        }

        if(isset($input['ek1'])){
            $input['epsilon_grade'] = $input['ek1'] * (EpsilonCriterion::first()->ek1_weight / 5) + 
                                      $input['ek2'] * (EpsilonCriterion::first()->ek2_weight / 5) + 
                                      $input['ek3'] * (EpsilonCriterion::first()->ek3_weight / 5);            
        }

        if(isset($input['stk1'])){
            $input['st_grade'] = $input['stk1'] * (StCriterion::first()->stk1_weight / 5) + 
                                 $input['stk2'] * (StCriterion::first()->stk2_weight / 5) + 
                                 $input['stk3'] * (StCriterion::first()->stk3_weight / 5) +
                                 $input['stk4'] * (StCriterion::first()->stk4_weight / 5);            
        }        

        $evaluation->fill($input)->save();

        $beta_grade = $evaluation->beta_grade * (BetaCriterion::first()->weight / 100);
        $gama_grade = $evaluation->gama_grade * (GamaCriterion::first()->weight / 100);
        $delta_grade = $evaluation->delta_grade * (DeltaCriterion::first()->weight / 100);
        $epsilon_grade = $evaluation->epsilon_grade * (EpsilonCriterion::first()->weight / 100);
        $st_grade = $evaluation->st_grade * (StCriterion::first()->weight / 100);
        
        $evaluation->total_grade = $beta_grade + $gama_grade + $delta_grade + $epsilon_grade + $st_grade;
        
        $evaluation->save();

        alert()->success('Επιτυχής καταχώριση Βαθμολογίας.');

        return redirect()->route('evaluation_c.show');

    }

    public function evaluation_c_finalize($id)
    {
        $evaluation = Evaluation_c::find($id);
        
        $grader_id = $evaluation->grader_id;
        
        $grader = Grader::find($grader_id);
        
        $user = $grader->user;
        
        if(Auth::user()->id != $user->id){
            return redirect()->route('home');
        }
        
        $evaluation->finalized = 'yes';
        $evaluation->finalized_at = Carbon::today();

        $evaluation->save();

        alert()->success('Επιτυχής καταχώριση Οριστικής Υποβολής Βαθμολογίας.');

        return redirect()->back();

    }

    public function can_evaluate_submit(Request $request, $id)
    {
        $this->validate($request, [
            'can_evaluate' => 'required',
            'why_cannot_evaluate' => 'required_if:can_evaluate,no',
        ]);

        $data = [];

        $data['assigned_at'] = Carbon::today();
        $data['assigned_until'] = Carbon::today()->addDays(2);

        $data['can_evaluate'] = $request->can_evaluate;
        if($request->why_cannot_evaluate){
            $data['why_cannot_evaluate'] = $request->why_cannot_evaluate;
        }

        $evaluation = Evaluation_c::find($id);

        if($request->can_evaluate == 'no'){
            $evaluation->total_grade = -1;
            alert()->info('Δεν έχετε αποδεχτεί να αξιολογήσετε αυτόν τον Ιστότοπο. Θα σας ανατεθεί άλλος Ιστότοπος.')
                ->persistent('Το κατάλαβα');
        }

        if($request->can_evaluate == 'yes' && $evaluation->total_grade < 10 && $evaluation->is_educational == 'na'){
            $evaluation->total_grade = 2;
        }

        if($request->can_evaluate == 'yes'){
            $data['why_cannot_evaluate'] = null;
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

        $evaluation = Evaluation_c::find($id);

        if($request->is_educational == 'no'){
            $evaluation->total_grade = 1;
        }

        if($request->is_educational == 'yes'){
            $data['why_not_educational'] = null;
            $evaluation->total_grade = 0;
        }
        
        $evaluation->fill($data)->save();

        alert()->success('Επιτυχής καταχώριση Απάντησης.');

        return redirect()->back();

    }

    public function site_comment_submit(Request $request, $id)
    {
        $evaluation = Evaluation_c::find($id);

        $evaluation->site_comment = $request->site_comment;

        $evaluation->save();

        alert()->success('Επιτυχής καταχώριση Σχολίου.');

        return redirect()->back();

    }

    public function assign_evaluation_site_c_grader_b($site_id, $from)
    {
        $site = Site::find($site_id);
        $graders = Grader::where('approved', 1)->get();
        $evalutations = Evaluation_c::where('site_id', $site->id)->get();

        return view('evaluations.assign_evaluation_site_c_grader_b', compact('site', 'evalutations', 'graders', 'from'));

    }

    public function store_manual_c(Request $request)
    {
        $this->validate($request, ['grader_id' => 'required']);

        $data = [];
        $data['site_id'] = $request->site_id;
        $data['grader_id'] = $request->grader_id;

        $data['assigned_at'] = Carbon::today();
        $data['assigned_until'] = Carbon::today()->addDays(2);

        Evaluation_c::create($data);

        alert()->success('Επιτυχής Υποβολή Ανάθεσης');

        return redirect()->back();
    }        

}  