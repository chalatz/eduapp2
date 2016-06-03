<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Suggestion;

class Grader extends Model
{
  protected $fillable = [
    'user_id',
    'last_name',
    'first_name',
    'suggestions_count',
    'personal_xp',
    'specialty_id',
    'district_id',
    'address',
    'desired_category',
    'past_grader',
    'past_grader_more',
    'wants_to_be_grader_b',
    'english',
    'french',
    'german',
    'italian',
    'english_level',
    'french_level',
    'german_level',
    'italian_level',
    'languages_other',
    'languages_other_level',
  ];

  public function user()
  {
      return $this->belongsTo(User::class);
  }

  public function sites()
  {
      return $this->belongsToMany(Role::class)->withTimeStamps();
  }

  public function addSuggestion()
  {
    $data = [];
    $data['user_id'] = $this->user->id;
    $data['grader_email'] = $this->user->email;
    $data['suggestor_name'] = $this->user->email;
    $data['suggestor_email'] = $this->user->email;
    $data['personal_msg'] = "Self proposed";
    $data['unique_string'] = "Self proposed";
    $data['accepted'] = "yes";
    $data['self_proposed'] = "yes";

    $suggestion = Suggestion::create($data);

    return $suggestion;

  }

  public static $other_grader_rules = [
    'password' => 'required|confirmed|min:6',
    'last_name' => 'required',
    'first_name' => 'required',
  ];

  public static $rules = [
    'password' => 'sometimes|required|confirmed|min:6',
    'last_name' => 'required',
    'first_name' => 'required',
    'personal_xp' => 'sometimes|required',
  ];

}
