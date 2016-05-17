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

      $this->middleware('must_own_grader', ['only' => [
        'edit',
        'edit_b',
        'edit_and_suggest_self',
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
<<<<<<< HEAD
=======
    // if the user is already a grader, redirect to the edit form
    // if(Auth::user()->grader){
    //     return redirect()->route('graders.edit', ['graders' => Auth::user()->grader->id]);
    // }

>>>>>>> grader_b_try
    return view('graders.forms.create');

  }

  public function create_b()
  {
    // if the user is already a grader B, redirect to the edit form
    if(Auth::user()->hasRole('grader_b')){
        return redirect()->route('graders.edit_b', ['graders' => Auth::user()->grader->id]);
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

    $grader = Grader::create($request->all());

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

      alert()->success('Τα στοιχεία σας ενημερώθηκαν επιτυχώς!', 'Επιτυχία');

      return redirect()->back();

  }

  public function update_b(EditGraderRequest $request, $id)
  {
      $grader = Grader::findOrFail($id);

      $input = $request->all();

      $grader->fill($input)->save();

      alert()->success('Τα στοιχεία σας ενημερώθηκαν επιτυχώς!', 'Επιτυχία');

      return redirect()->back();

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
