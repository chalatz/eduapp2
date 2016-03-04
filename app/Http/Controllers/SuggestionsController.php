<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Suggestion;

use Auth;

class SuggestionsController extends Controller
{
  public function __construct()
  {
      $this->middleware('verified');
  }

  public function do_suggest_other_grader(Request $request)
  {
      $this->validate($request,[
          'suggestor_name' => 'required',
          'grader_email' => 'required|email',
          'personal_msg' => 'required',
      ]);

      $data['user_id'] = $request->user()->id;
      $data['grader_email'] = $request->grader_email;
      $data['suggestor_name'] = $request->suggestor_name;
      $data['suggestor_email'] = $request->user()->email;

      $data['unique_string'] = str_random(50);
      $data['personal_msg'] = $request->personal_msg;

      $suggestion = Suggestion::create($data);

      $suggestion->sendSuggestionEmail();

      alert()->success('Έχει ασταλεί το email.')
              ->persistent('Εντάξει');

      return redirect('/');

  }

  public function handle_suggestion($unique_string)
  {
    return view('suggestions.handle_new');
  }

}
