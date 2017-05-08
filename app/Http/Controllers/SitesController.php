<?php

namespace App\Http\Controllers;

use App\Site;
use Auth;

use App\Config;

use App\Evaluation;
use App\Evaluation_b;
use App\Evaluation_c;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\CreateSiteRequest;
use App\Http\Requests\EditSiteRequest;

class SitesController extends Controller
{
    public function __construct()
    {
        $this->middleware('site_submissions_open', ['only' => [
            'create',
            'store',
        ]]);

        $this->middleware('verified');

        $this->middleware('must_own_site', ['only' => 'edit']);

        $this->middleware('can_create_site', ['only' => 'create']);

        $this->middleware('gradings_over', ['only' => 'summary']);
        
        $this->middleware('survey_ok', ['only' => 'summary']);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        // if the user already has a site, redirect to the edit form
        if($user->site){
            return redirect()->route('sites.edit', ['sites' => $user->site->id]);
        }

        return view('sites.forms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSiteRequest $request)
    {

        $user = Auth::user();

        $data = $request->all();

        $data['user_id'] = $user->id;
        $data['grader_id'] = $user->suggestedGrader()->id;

        Site::create($data);

        // Give the user the role of Site (id: 1)
        $user->roles()->attach(1);

        alert()->success('Μην ξεχνάτε ότι μπορείτε να επεξεργάζεστε τα στοιχεία της υποψηφιότητάς σας όποτε επιθυμείτε.', 'Επιτυχής Υποβολή Υποψηφιότητας!')
                ->persistent('Το κατάλαβα');

        return redirect()->route('home');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $site = Site::find($id);

        return view('sites.forms.edit', compact('site'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditSiteRequest $request, $id)
    {
        $site = Site::findOrFail($id);

        $input = $request->all();

        if($request->uses_private_data == 'no'){
            $input['received_permission'] = null;
        }
        if($request->restricted_access == 'no'){
            $input['restricted_access_details'] = null;
        }

        $site->fill($input)->save();

        alert()->success('Τα στοιχεία σας ενημερώθηκαν επιτυχώς!', 'Επιτυχία');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function summary()
    {
        $user = Auth::user();

        $site = $user->site;

        $site_id = $site->id;

        $winners_a = explode('|', Config::first()->winners_a);
        $winners_b = explode('|', Config::first()->winners_b);

        $mo = [];
        $phase = [];
        $phase['a'] = false;     
        $phase['b'] = false;     
        $phase['c'] = false;     

        $evaluations_a = Evaluation::where('site_id', $site->id)->get();
        
        if($evaluations_a){
            $phase['a'] = true;

            $max_phase = 'Α';

            $total_grades_a = $site->total_grades('a');

            $mo['a'] = ($total_grades_a[0] + $total_grades_a[1]) / 2;
        }      

        if(in_array($site->id, $winners_a)){
            $phase['b'] = true;

            $max_phase = 'Β';

            $evaluations_b = Evaluation_b::where('site_id', $site->id)->get();

            $total_grades_b = $site->total_grades('b');

            $mo['b'] = ($total_grades_b[0] + $total_grades_b[1]) / 2;
        }

        if(in_array($site->id, $winners_b)){
            $phase['c'] = true;

            $max_phase = 'Γ';

            $site = Site::find($site_id);

            $the_grades = $site->final_grades();

            $mo['c'] = ($the_grades[1] + $the_grades[2] + $the_grades[3] + $the_grades[4]) / 4;
            
        }        

        return view('sites.summary', compact('mo', 'phase', 'max_phase', 'site_id'));            
                   
    }

}
