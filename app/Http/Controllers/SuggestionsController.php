<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\SuggestOtherGraderRequest;
use App\Http\Requests\CreateOtherGraderRequest;

use App\Suggestion;
use App\User;
use App\Grader;

use Auth;

class SuggestionsController extends Controller
{
  public function __construct()
  {
      $this->middleware('verified',
        ['only' => ['do_suggest_other_grader']]
      );

      $this->middleware('has_not_accepted',
        ['only' => ['handle_suggestion_answer', 'handle_suggestion']]
      );

  }

  public function do_suggest_other_grader(SuggestOtherGraderRequest $request)
  {
      $data['user_id'] = $request->user()->id;
      $data['grader_email'] = $request->grader_email;
      $data['suggestor_name'] = $request->suggestor_name;
      $data['suggestor_email'] = $request->user()->email;

      $data['unique_string'] = str_random(50);
      $data['personal_msg'] = $request->personal_msg;

      $data['self_proposed'] = "no"; 

      $suggestion = Suggestion::create($data);

      $suggestion->sendSuggestionEmail();

      alert()->success('Έχει αποσταλεί το email.')
              ->persistent('Εντάξει');

      return redirect('/');

  }

  public function handle_suggestion($unique_string)
  {

    return view('suggestions.handle_new', compact('unique_string'));
  }

  public function handle_suggestion_answer($answer, $unique_string)
  {

    // The grader has accepted
    if($answer == 'yes'){

      // find the suggestion
      $suggestion = Suggestion::where('unique_string', $unique_string)->first();
      $grader_email = $suggestion->grader_email;

      // There is already a grader with this email
      $user = User::where('email', $grader_email)->first();
      if($user->hasRole('grader_a')){
        $user->grader_status .= ',accepted';
        $user->save();
        
        $suggestion->accepted = 'yes';
        $suggestion->save();
        
        $grader = Grader::where('user_id', $user->id)->first();
        $suggestions_count =  $grader->suggestions_count;
        $suggestions_count = $suggestions_count + 1;
        $grader->suggestions_count = $suggestions_count;
        $grader->save();
        
        return redirect()->route('home');
      }

      return view('graders.new_grader_other', compact('grader_email', 'unique_string'));

    } else {
      // The grader has NOT accepted
    }

  }

  public function store_other_grader(CreateOtherGraderRequest $request)
  {
    Auth::logout();

    $unique_string = $request->unique_string;

    // find the suggestion
    $suggestion = Suggestion::where('unique_string', $unique_string)->first();
    $grader_email = $suggestion->grader_email;

    // Update the suggestor
    $suggestor_email = $suggestion->suggestor_email;
    $suggestor = User::where('email', $suggestor_email)->first();
    $suggestor->grader_status .= ',accepted';
    $suggestor->save();

    // Update the Suggestion
    $suggestion->accepted = 'yes';
    $suggestion->save();

    // Create the user
    $user = User::create([
              'email' => $grader_email,
              'password' => bcrypt($request->password),
              'verification_token' => str_random(40),
              'verified' => 1,
            ]);

    // Give the user the role of grader A (id: 2)
    $user->roles()->attach(2);

    // Create the grader
    $data = [];
    $data['user_id'] = $user->id;
    $data['last_name'] = $request->last_name;
    $data['first_name'] = $request->first_name;

    $grader = Grader::create($data);

    // Notify the user
    $suggestion->sendAcceptanceEmail($request->last_name, $request->first_name);

    alert()->success('Ο Υποψήφιος θα ενημερωθεί για την αποδοχή σας. Μην ξεχνάτε ότι μπορείτε να επεξεργάζεστε τα στοιχεία σας όποτε επιθυμείτε.', 'Επιτυχής Υποβολή!')
            ->persistent('Το κατάλαβα');

    return redirect()->route('home');

  }

}
