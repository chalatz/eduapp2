<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Mail;

class Suggestion extends Model
{
  protected $fillable = [
        'grader_email',
        'user_id',
        'personal_msg',
        'suggestor_name',
        'suggestor_email',
        'unique_string',
        'accepted',
        'self_proposed',
    ];

    public function sendSuggestionEmail()
    {
        $data = [
            'unique_url' => route('user.suggest', ['unique_string' => $this->unique_string]),
            'suggestor_name' => $this->suggestor_name,
            'suggestor_email' => $this->suggestor_email,
            'personal_msg' => $this->personal_msg,
        ];

        Mail::send('emails.send_suggestion', ['data' => $data], function ($message) use ($data) {
            $message->to($this->grader_email, $this->grader_email)->subject('Πρόταση για Αξιολογητής Α.');
        });
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

}
