<?php

namespace App\Http\Controllers;

use App\Grader;
use App\Suggestion;
use Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\CreateGraderRequest;
use App\Http\Requests\CreateGraderBRequest;
use App\Http\Requests\EditGraderRequest;

class GradersController extends Controller
{
  public function __construct()
  {
      $this->middleware('verified');

      $this->middleware('site_submissions_open', ['only' => [
        'create',
        'store',
        'edit_and_suggest_self',
        'addSuggestion',
      ]]);

      $this->middleware('must_own_grader', ['only' => [
        'edit',
        'edit_b',
        'edit_and_suggest_self',
      ]]);

      $this->middleware('must_own_grader_or_is_member', ['only' => [
        'get_file',
      ]]);

      $this->middleware('grader_has_not_accepted', ['only' => [
            'create',
        ]]);

      $this->middleware('edit_and_suggest_self', ['only' => [
            'edit_and_suggest_self',
        ]]);

  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    // if the user is already a grader, redirect to the edit form
    // if(Auth::user()->grader){
    //     return redirect()->route('graders.edit', ['graders' => Auth::user()->grader->id]);
    // }

    // the user has a pending suggestion
    if(Auth::user()->hasSuggestionToRespondTo()->count() > 0){
      $suggestion = Auth::user()->hasSuggestionToRespondTo();
      return view('pages.handle_pending_suggestion', compact('suggestion'));
    }

    return view('graders.forms.create');

  }

  public function create_b()
  {
    // if the user is already a grader B, redirect to the edit form
    if(Auth::user()->hasRole('grader_b')){
        return redirect()->route('graders.edit_b', ['graders' => Auth::user()->grader->id]);
    }

    if(Auth::user()->hasRole('grader_a')){
      $grader = Auth::user()->grader;
      return view('graders.forms.create_b', compact('grader'));
    }

    return view('graders.forms.create_b');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(CreateGraderRequest $request)
  {
      $user = $request->user();
      $user_id = $user->id;
      $user_email = $user->email;

      $data = $request->all();

      if(isset($data['desired_category'])){
        $data['desired_category'] = implode('|', $data['desired_category']);
      }

      if(isset($data['teaching_xp'])){
        $data['teaching_xp'] = implode('|', $data['teaching_xp']);
      }     

      // check if there already is such a suggestion
      $suggestion = Suggestion::where('grader_email', $user_email)->first();

      if($suggestion){

        $suggestion->checkSuggestion('yes', 'accepted');

        $data['suggestions_count'] = $suggestion->suggestions_count + 1;

      } else {

        // Create new suggestion
        $suggestion = $this->addSuggestion($user_id, $user_email);
        $user->grader_status .= ',self_proposed';
        $user->save();

        $data['suggestions_count'] = 1;

      }

      $data['user_id'] = $user_id;

      // Check if the user is already a Grader B
      if($user->grader){

        $grader = $user->grader;

        $grader->fill($data)->save();

      } else {

        // Create the grader
        $grader = Grader::create($data);

      }

    if($request->hasFile('personal_cv') && $request->file('personal_cv')->isValid()){
        $grader->personal_cv = $grader->addPersonalCV($request);
        $grader->save();
    }      

      if($request->hasFile('photo') && $request->file('photo')->isValid()){
          $grader->photo = $grader->addPhoto($request);
          $grader->save();
      }

      // Give the user the role of grader A (id: 2)
      $user->roles()->attach(2);

      if($suggestion->self_proposed != 'yes'){
        // Notify the user
        $suggestion->sendAcceptanceEmail($request->last_name, $request->first_name);
        alert()->success('Ο Υποψήφιος θα ενημερωθεί για την αποδοχή σας. Μην ξεχνάτε ότι μπορείτε να επεξεργάζεστε τα στοιχεία σας όποτε επιθυμείτε.', 'Επιτυχής Υποβολή!')
                ->persistent('Το κατάλαβα');
      } else {
        alert()->success('Μπορείτε τώρα να υποβάλετε υποψηφιότητα. Μην ξεχνάτε επίσης ότι μπορείτε να επεξεργάζεστε τα στοιχεία σας όποτε επιθυμείτε.', 'Επιτυχής Υποβολή!')
                ->persistent('Το κατάλαβα');
      }

      return redirect()->route('home');

  }

  public function store_b(CreateGraderBRequest $request)
  {
    $user = $request->user();

    $request->request->add(['user_id' => $user->id]);

    if($request->has('desired_category')){
      $request->request->add(['desired_category' => implode('|', $request->desired_category)]);
    }

    if($request->has('teaching_xp')){
      $request->request->add(['teaching_xp' => implode('|', $request->teaching_xp)]);
    }      

    // Check if the user is already a Grader A
    if($user->grader){

      $grader = $user->grader;

      $grader->fill($request->all())->save();

    } else {

      // Create the grader
      $grader = Grader::create($request->all());

    }

    if($request->hasFile('personal_cv') && $request->file('personal_cv')->isValid()){
        $grader->personal_cv = $grader->addPersonalCV($request);
        $grader->save();
    }

    if($request->hasFile('photo') && $request->file('photo')->isValid()){
        $grader->photo = $grader->addPhoto($request);
        $grader->save();
    }

    // $grader = Grader::create($request->all());

    // Give the user the role of grader B (id: 3)
    $user->roles()->attach(3);

    alert()->success('Μην ξεχνάτε ότι μπορείτε να επεξεργάζεστε τα στοιχεία σας όποτε επιθυμείτε.', 'Επιτυχής Υποβολή!')
            ->persistent('Το κατάλαβα');

    return redirect()->route('home');

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      $grader = Grader::find($id);

      return view('graders.forms.edit', compact('grader'));
  }

  public function edit_b($id)
  {
      $grader = Grader::find($id);

      return view('graders.forms.edit_b', compact('grader'));
  }

  public function edit_and_suggest_self($id)
  {
      $grader = Grader::find($id);

      $edit_and_suggest_self = true;

      return view('graders.forms.edit', compact('grader', 'edit_and_suggest_self'));
  }

  public function update(EditGraderRequest $request, $id)
  {
      $grader = Grader::findOrFail($id);

      $input = $request->all();

      if($request->has('desired_category')){
        $input['desired_category'] = implode('|', $input['desired_category']);
      }

      if($request->has('teaching_xp')){
        $input['teaching_xp'] = implode('|', $input['teaching_xp']);
      }

      if(!$request->has('english')){
        $input['english'] = 0;
        $input['english_level'] = null;
        $input['lang_pref_english'] = 0;
      }
      if(!$request->has('french')){
        $input['french'] = 0;
        $input['french_level'] = null;
        $input['lang_pref_french'] = 0;
      }
      if(!$request->has('german')){
        $input['german'] = 0;
        $input['german_level'] = null;
        $input['lang_pref_german'] = 0;
      }
      if(!$request->has('italian')){
        $input['italian'] = 0;
        $input['italian_level'] = null;
        $input['lang_pref_italian'] = 0;
      }

      if(!$request->has('propose_myself')){
        $input['propose_myself'] = 0;
        $input['why_propose_myself'] = null;
      }

      if(!$request->has('lang_pref_english')){
        $input['lang_pref_english'] = 0;
      }
      if(!$request->has('lang_pref_french')){
        $input['lang_pref_french'] = 0;
      }
      if(!$request->has('lang_pref_german')){
        $input['lang_pref_german'] = 0;
      }
      if(!$request->has('lang_pref_italian')){
        $input['lang_pref_italian'] = 0;
      }

      $grader->fill($input)->save();

      // the user has suggested himself
      if($request->edit_and_suggest_self && $request->edit_and_suggest_self == 'yes'){
        // Create new suggestion
        $suggestion = $grader->addSuggestion();
        $grader->user->grader_status .= ',self_proposed';
        $grader->user->save();

        $grader->suggestions_count++;
        $grader->save();
      }

      if($request->hasFile('personal_cv') && $request->file('personal_cv')->isValid()){
          $input['personal_cv'] = $grader->addPersonalCV($request);
      }

      if($request->delete_cv == 'delete_me'){
        $grader->personal_cv = null;
        $grader->save();
      }       

      if($request->delete_photo == 'delete_me'){
        $grader->photo = null;
        $grader->save();
      }

      if($request->hasFile('photo') && $request->file('photo')->isValid()){
          $grader->photo = $grader->addPhoto($request);
          $grader->save();
      }

      alert()->success('Τα στοιχεία σας ενημερώθηκαν επιτυχώς!', 'Επιτυχία');

      return redirect()->back();

  }

  public function update_b(EditGraderRequest $request, $id)
  {
      $grader = Grader::findOrFail($id);

      $input = $request->all();

      if($request->has('desired_category')){
        $input['desired_category'] = implode('|', $input['desired_category']);
      }

      if($request->has('teaching_xp')){
        $input['teaching_xp'] = implode('|', $input['teaching_xp']);
      }      

      if(!$request->has('english')){
        $input['english'] = 0;
        $input['english_level'] = null;
        $input['lang_pref_english'] = 0;
      }
      if(!$request->has('french')){
        $input['french'] = 0;
        $input['french_level'] = null;
        $input['lang_pref_french'] = 0;
      }
      if(!$request->has('german')){
        $input['german'] = 0;
        $input['german_level'] = null;
        $input['lang_pref_german'] = 0;
      }
      if(!$request->has('italian')){
        $input['italian'] = 0;
        $input['italian_level'] = null;
        $input['lang_pref_italian'] = 0;
      }

      if(!$request->has('propose_myself')){
        $input['propose_myself'] = 0;
        $input['why_propose_myself'] = null;
      }

      if(!$request->has('lang_pref_english')){
        $input['lang_pref_english'] = 0;
      }
      if(!$request->has('lang_pref_french')){
        $input['lang_pref_french'] = 0;
      }
      if(!$request->has('lang_pref_german')){
        $input['lang_pref_german'] = 0;
      }
      if(!$request->has('lang_pref_italian')){
        $input['lang_pref_italian'] = 0;
      }        

      if($request->hasFile('personal_cv') && $request->file('personal_cv')->isValid()){
          $input['personal_cv'] = $grader->addPersonalCV($request);
      }

      if($request->delete_cv == 'delete_me'){
        $grader->personal_cv = null;
        $grader->save();
      }      

      if($request->delete_photo == 'delete_me'){
        $grader->photo = null;
        $grader->save();
      }

      if($request->hasFile('photo') && $request->file('photo')->isValid()){
          $grader->photo = $grader->addPhoto($request);
          $grader->save();
      }

      $grader->fill($input)->save();

      alert()->success('Τα στοιχεία σας ενημερώθηκαν επιτυχώς!', 'Επιτυχία');

      return redirect()->back();

  }

  public function get_file($file)
  {
    $pathToFile = base_path() . '/storage/grader_files/' . $file;

    return response()->download($pathToFile);

  }  

  private function addSuggestion($user_id, $grader_email)
  {
      // check if there already is such a suggestion
      $suggestion = Suggestion::where('grader_email', $grader_email)->first();

      if(!$suggestion){
        $data = [];
        $data['user_id'] = $user_id;
        $data['grader_email'] = $grader_email;
        $data['suggestor_name'] = $grader_email;
        $data['suggestor_email'] = $grader_email;
        $data['personal_msg'] = "Self proposed";
        $data['unique_string'] = "Self proposed";
        $data['accepted'] = "yes";
        $data['self_proposed'] = "yes";

        $suggestion = Suggestion::create($data);
      }

      return $suggestion;
  }

}
