<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use app\Suggestion;

class Grader extends Model
{
  protected $fillable = [
    'user_id',
    'last_name',
    'first_name',
    'suggestions_count'
  ];

  public function user()
  {
      return $this->belongsTo(User::class);
  }

  public function sites()
  {
      return $this->belongsToMany(Role::class)->withTimeStamps();
  }

  public function addSuggestion($user_id, $grader_email)
  {
    $data = [];
    $data['user_id'] = $user_id;
    $data['grader_email'] = $grader_email;
    $data['suggestor_name'] = $grader_email;
    $data['suggestor_email'] = $grader_email;
    $data['personal_msg'] = "Self proposed";
    $data['unique_string'] = "Self proposed";
    $data['accepted'] = "yes";

    $suggestion = Suggestion::create($data);

    return $suggestion;

  }

  public static $other_grader_rules = [
    'password' => 'required|confirmed|min:6',
    'last_name' => 'required',
    'first_name' => 'required',
  ];

  public static $rules = [
    'last_name' => 'required',
    'first_name' => 'required',
  ];

}
