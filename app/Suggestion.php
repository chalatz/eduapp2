<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

use Mail;

use Auth;

class Suggestion extends Model
{
  protected $fillable = [
        'grader_email',
        'user_id',
        'personal_msg',
        'suggestor_name',
        'suggestor_email',
        'suggestor_url',
        'suggestor_phone',
        'unique_string',
        'accepted',
        'self_proposed',
    ];

    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function sendSuggestionEmail($type)
    {
        $data = [
            'unique_url' => route('user.suggest', ['unique_string' => $this->unique_string]),
            'suggestor_name' => $this->suggestor_name,
            'suggestor_email' => $this->suggestor_email,
            'suggestor_url' => $this->suggestor_url,
            'suggestor_phone' => $this->suggestor_phone,
            'personal_msg' => $this->personal_msg,
        ];

        if($type == 'initial_request'){
          $data['title'] = 'Πρόταση για Αξιολογητής Α';
          $data['text'] = 'Έχετε προταθεί ως';

          Mail::send('emails.send_suggestion', ['data' => $data], function ($message) use ($data) {
              $message->to($this->grader_email, $this->grader_email)->subject('Πρόταση για Αξιολογητής Α');
          });
        }

        if($type == 'reminder'){
          if($this->reminders_count == 0){
            alert()->error('Έχετε υπερβεί το όριο αποστολής αυτού του είδους email. Παρακαλούμε επικοινωνήστε μαζί μας για επιπλέον βοήθεια.', 'Σφάλμα')
                    ->persistent('Εντάξει');

            return redirect()->route('home');
          }

          $data['title'] = 'Υπενθύμιση Πρότασης για Αξιολογητής Α';
          $data['text'] = 'Σας υπενθυμίζουμε ότι έχετε προταθεί ως';

          Mail::send('emails.send_suggestion', ['data' => $data], function ($message) use ($data) {
              $message->to($this->grader_email, $this->grader_email)->subject('Υπενθύμιση Πρότασης για Αξιολογητής Α');
          });

          $this->reminders_count--;
          $this->save();

          alert()->success('Έχει αποσταλεί το email.')
            ->persistent('Εντάξει');
        }
    }

    // the suggested grader has accepted
    public function hasAccepted()
    {
      return $this->accepted == 'yes';
    }

    public function checkSuggestion($accepted, $grader_status)
    {
          $this->accepted = $accepted;
          $this->user->grader_status .= ',' . $grader_status;
          $this->user->save();

          $this->save();

          return $this;

    }

    public function sendAcceptanceEmail($last_name, $first_name)
    {
      $data = [
        'last_name' => $last_name,
        'first_name' => $first_name,
        'grader_email' => $this->grader_email,
      ];

      Mail::send('emails.send_acceptance', ['data' => $data], function ($message) use ($data) {
          $message->to($this->suggestor_email, $this->suggestor_email)->subject('Αποδοχή από τον Αξιολογητή Α που προτείνατε.');
      });

    }

    public function sendDenialEmail()
    {
      $data = [
        'name' => $this->suggestor_name,
        'email' => $this->suggestor_email
      ];

      Mail::send('emails.send_denial', ['data' => $data], function ($message) use ($data) {
          $message->to($this->suggestor_email, $this->suggestor_email)->subject('Άρνηση από τον Αξιολογητή Α που προτείνατε.');
      });

    }

    public function logOutOtherUser()
    {
      $user = User::where('email', $this->grader_email)->first();
      if(!$user){
        Auth::logout();
      }
      // if there is a different logged in user, log him out
      if(Auth::check() && $user && Auth::user()->id != $user->id){
        Auth::logout();
      }
    }

    public static $rules = [
            'suggestor_name' => 'required',
            'suggestor_url' => 'required|url',
            'grader_email' => 'required|email|max:255',
            'personal_msg' => 'required',
        ];

}
