<?php

namespace App\Http\Controllers;

use App\Grader;
use App\Suggestion;
use Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\CreateGraderRequest;
//use App\Http\Requests\EditSiteRequest;

class GradersController extends Controller
{
  public function __construct()
  {
      $this->middleware('verified');
      
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

      // Create new suggestion
      $suggestion = $this->addSuggestion($user_id, $user_email);

      // Create the grader
      $data = $request->all();
      $data['user_id'] = $user_id;
      $data['suggestions_count'] = 1;

      $grader = Grader::create($data);

      // Give the user the role of grader A (id: 2)
      $user->roles()->attach(2);
      
      $user->grader_status .= ',self_proposed';
      $user->save();

      alert()->success('Μπορείτε τώρα να υποβάλετε υποψηφιότητα. Μην ξεχνάτε επίσης ότι μπορείτε να επεξεργάζεστε τα στοιχεία σας όποτε επιθυμείτε.', 'Επιτυχής Υποβολή!')
              ->persistent('Το κατάλαβα');

      return redirect()->route('home');

  }

  private function addSuggestion($user_id, $grader_email)
  {
      $data = [];
      $data['user_id'] = $user_id;
      $data['grader_email'] = $grader_email;
      $data['suggestor_name'] = $grader_email;
      $data['suggestor_email'] = $grader_email;
      $data['personal_msg'] = "Self proposed";
      $data['unique_string'] = "Self proposed";
      $data['accepted'] = "yes";
      $data['self_proposed'] = 'yes';

      $suggestion = Suggestion::create($data);

      return $suggestion;
  }

}
