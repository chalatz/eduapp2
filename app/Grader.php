<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grader extends Model
{
  protected $fillable = [
    'user_id',
    'last_name',
    'first_name',
  ];

  public function user()
  {
      return $this->belongsTo(User::class);
  }

  public function sites()
  {
      return $this->belongsToMany(Role::class)->withTimeStamps();
  }

  public static $other_grader_rules = [
    'password' => 'required|confirmed|min:6',
    'last_name' => 'required',
    'first_name' => 'required',
  ];

}
