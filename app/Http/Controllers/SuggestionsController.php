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
        ['only' => [
          'do_suggest_other_grader',
          'do_other_grader_email',
          'suggest_new_grader_a',
          'send_reminder_to_grader_a_from_site',
          'delete_suggestion',
        ]]);

      $this->middleware('has_not_accepted',
        ['only' => [
          'handle_suggestion_answer',
          'handle_suggestion',
        ]]);

      $this->middleware('suggestion_made',
        ['only' => [
          'suggest_new_grader_a',
        ]]);

  }

  public function do_other_grader_email(Request $request, $action = 'create')
  {
    $this->validate($request, ['grader_email' => 'required|email|confirmed']);

    $grader_email = $request->grader_email;

    // check if the user has submitted his own email
    if($request->user()->email == $request->grader_email){
      flash()->error('Έχετε υποβάλλει το δικό σας email. Παρακαλούμε υποβάλλετε κάποιο άλλο, ή <a href="'.route("graders.create").'">προτείνετε τον εαυτό σας.</a>');
      return redirect()->back();
    }

    // check if the suggested user has already been suggested by another site
    $suggestions_count = Suggestion::where('grader_email', $request->grader_email)->count();
    if($suggestions_count > 0){
      flash()->warning('Ο Αξιολογητής που έχετε προτείνει έχει προταθεί και από άλλον υποψήφιο, οπότε είναι πιθανό <strong>να μην αποδεχθεί την πρόσκλησή σας.</strong>');
    }

    // check if the suggested user has already accepeted 3 times
    $suggested_user = User::where('email', $grader_email)->first();
    if($suggested_user && $suggested_user->grader){
      $times_accepted = $suggested_user->grader->suggestions_count;
      if($times_accepted >= 3){
        flash()->error('Ο Αξιολογητής έχει ήδη αποδεχθεί 3 προσκλήσεις. Παρακαλούμε <a href="'.route("other_grader_email").'">προτείνετε κάποιον άλλον</a> ή <a href="'.route("graders.create").'">τον εαυτό σας</a>');
        return redirect()->back();
      }
    }

    // a new grader is suggested
    if($action == 'edit'){

      // -- DEPRECATED
      return redirect()->route('home');

      // check if the user suggests the same grader again
      $old_suggestion = Suggestion::where('user_id', $request->user()->id)->first();
      if ($old_suggestion->grader_email == $grader_email) {
        flash()->error('Επιχειρείτε να προτείνετε πάλι το ίδιο email.');
        return redirect()->back();
      }

      return view('pages.suggest_other_grader', compact('grader_email', 'old_suggestion'));

    } // end edit action

    return view('pages.suggest_other_grader', compact('grader_email'));

  }

  public function do_suggest_other_grader(SuggestOtherGraderRequest $request)
  {
      $data['user_id'] = $request->user()->id;
      $data['grader_email'] = $request->grader_email;
      $data['suggestor_name'] = $request->suggestor_name;
      $data['suggestor_email'] = $request->user()->email;
      $data['suggestor_url'] = $request->suggestor_url;
      $data['suggestor_phone'] = $request->suggestor_phone;

      $data['unique_string'] = str_random(50);
      $data['personal_msg'] = $request->personal_msg;

      $data['self_proposed'] = "no";

      $suggestion = Suggestion::create($data);

      $suggestion->sendSuggestionEmail('initial_request');

      // A new grader is being suggested. Delete the old suggestion.
      if(isset($request->old_suggestion_id)){
        Suggestion::destroy($request->old_suggestion_id);
        alert()->success('Έχει αποσταλεί το email και έχει διαγραφεί η προηγούμενη πρόταση.')
          ->persistent('Εντάξει');

        return redirect()->route('home');
      }

      alert()->success('Εάν αποδεχτεί ο προτεινόμενος Αξιολογητής Α, θα μπορείτε να υποβάλλετε την υποψηφιότητά σας', 'Έχει αποσταλεί το email.')
        ->persistent('Εντάξει');

      return redirect()->route('home');

  }

  public function handle_suggestion($unique_string)
  {
    // the grader is already a user
    $suggestion = Suggestion::where('unique_string',$unique_string)->first();

    if($suggestion){
      $suggestion->logOutOtherUser();

      // warn the user if he has accepted before
      $user = User::where('email', $suggestion->grader_email)->first();
      if($user && $user->grader && $user->hasRole('grader_a')){
        $suggestions_count = $user->grader->suggestions_count;

        return view('suggestions.handle_new', compact('unique_string', 'suggestions_count', 'suggestion'));
      }
    }

    return view('suggestions.handle_new', compact('unique_string', 'suggestion'));
  }

  public function handle_suggestion_answer($answer, $unique_string)
  {
    // find the suggestion
    $suggestion = Suggestion::where('unique_string', $unique_string)->first();

    // The grader has accepted
    if($answer == 'yes'){

      $suggestion->logOutOtherUser();

      $grader_email = $suggestion->grader_email;

      // Check if the grader has already registered
      $user = User::where('email', $grader_email)->first();

      // There is already a grader A with this email
      if($user && $user->hasRole('grader_a')){
        $user->grader_status .= ',accepted';
        $user->save();

        $suggestion->accepted = 'yes';
        $suggestion->save();

        $grader = Grader::where('user_id', $user->id)->first();
        $suggestions_count =  $grader->suggestions_count;
        $suggestions_count = $suggestions_count + 1;
        $grader->suggestions_count = $suggestions_count;
        $grader->save();

        // Notify the user
        $suggestion->sendAcceptanceEmail($grader->last_name, $grader->first_name);

        return redirect()->route('home');
      }

      // There is already a user with this email
      // The user is verified
      if($user && $user->verified){
        // check if the user is logged in
        if(!Auth::check()){
          Auth::login($user);
        }

        if(Auth::user()->hasRole('grader_b')){
          $grader = Auth::user()->grader;
          return view('graders.forms.create', compact('grader'));
        }

        return view('graders.forms.create', compact('answer'));

      }

      // The user is not verified
      if($user && !$user->verified){
        // check if the user is logged in
        if(Auth::check()){
          flash()->error('<strong>Το email σας δεν έχει επιβεβαιωθεί. Παρακαλούμε επιβεβεβαιώστε το email σας ή ζητήστε να σας έλθει εκ νέου το email επιβεβαίωσης.</strong>');
          return redirect()->route('home');
        } else {
          flash()->error('<strong>Έχει βρεθεί λογαριασμός με αυτό το email, αλλά το email δεν έχει επιβεβαιωθεί. Παρακαλούμε επιβεβεβαιώστε το email σας ή συνδεθείτε και ζητήστε να σας έλθει εκ νέου το email επιβεβαίωσης.</strong>');
          return redirect()->route('home');
        }
      }

      // There is not such a user
      return view('graders.new_grader_other', compact('grader_email', 'unique_string'));

    } else {
      // The grader has NOT accepted

      // Notify the user
      $suggestion->sendDenialEmail();

      // Delete the suggestion
      Suggestion::destroy($suggestion->id);

      return redirect()->route('home');

    }

  }

  public function store_other_grader(CreateOtherGraderRequest $request)
  {
    $unique_string = $request->unique_string;

    // find the suggestion
    $suggestion = Suggestion::where('unique_string', $unique_string)->first();

    $suggestion->logOutOtherUser();

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

    // Give the user the roles of user (id: 5) and grader A (id: 2)
    $user->roles()->attach(5);
    $user->roles()->attach(2);

    // Create the grader
    $data = $request->all();
    $data['user_id'] = $user->id;
    $data['suggestions_count'] = 1;

    if(isset($data['desired_category'])){
      $data['desired_category'] = implode('|', $data['desired_category']);
    }

    $grader = Grader::create($data);

    if($request->hasFile('photo') && $request->file('photo')->isValid()){
      $grader->photo = $grader->addPhoto($request);
      $grader->save();
    }

    // Notify the user
    $suggestion->sendAcceptanceEmail($request->last_name, $request->first_name);

    alert()->success('Ο Υποψήφιος θα ενημερωθεί για την αποδοχή σας. Μην ξεχνάτε ότι μπορείτε να επεξεργάζεστε τα στοιχεία σας όποτε επιθυμείτε.', 'Επιτυχής Υποβολή!')
            ->persistent('Το κατάλαβα');

    return redirect()->route('home');

  }

  public function send_reminder_to_grader_a_from_site()
  {
    $user = Auth::user();

    $suggestion = Suggestion::where('user_id', $user->id)->first();

    if($suggestion && $suggestion->hasAccepted()){
      alert()->info('Ο Αξιολογητής που έχετε προτείνει έχει ήδη αποδεχτεί')
              ->persistent('Εντάξει');

      return redirect()->route('home');
    }

    $suggestion->sendSuggestionEmail('reminder');

    return redirect()->route('home');

  }

  public function suggest_new_grader_a_email()
  {
    // -- DEPRECATED
    //return redirect()->route('home');

    $user = Auth::user();

    $suggestion = Suggestion::where('user_id', $user->id)->first();

    if($suggestion && $suggestion->hasAccepted()){
      alert()->info('Ο Αξιολογητής που έχετε προτείνει έχει ήδη αποδεχτεί')
              ->persistent('Εντάξει');

      return redirect()->route('home');
    }

    return view('suggestions.suggest_new_grader_a_email', compact('suggestion'));

  }

  public function delete_suggestion()
  {
    $suggestion = Auth::user()->suggestion;

    if($suggestion && $suggestion->accepted != 'yes'){

      $suggestion->delete();
        alert()->success('Τώρα μπορείτε να επιλέξετε εκ νέου είτε νέο αξιολογητή είτε τον εαυτό σας.', 'Επιτυχής διαγραφή')->persistent('Εντάξει');

    } else {

      alert()->error('Αδύνατη η διαγραφή της πρότασης')->persistent('Εντάξει');

    }

    return redirect()->route('home');

  }

}
