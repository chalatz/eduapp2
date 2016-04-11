<?php

namespace App\Http\Controllers;

use App\Grader;
use App\Suggestion;
use Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\CreateGraderRequest;
use App\Http\Requests\EditGraderRequest;

class GradersController extends Controller
{
  public function __construct()
  {
      $this->middleware('verified');

      $this->middleware('must_own_grader', ['only' => 'edit']);

      $this->middleware('grader_has_not_accepted', ['only' => [
            'create',
        ]]);

  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('graders.forms.create');

  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(CreateGraderRequest $request)
  {

      $user = $user_id = $request->user();
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

      // Create the grader
      $data['user_id'] = $user_id;

      $grader = Grader::create($data);

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

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id, $proposal_status)
  {
      $grader = Grader::find($id);

      return view('graders.forms.edit', compact('grader', 'proposal_status'));
  }

  public function update(EditGraderRequest $request, $id)
  {
      $grader = Grader::findOrFail($id);

      $input = $request->all();

      $grader->fill($input)->save();

      // the user has suggested himself
      if($request->proposal_status == 'after-proposal'){
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
