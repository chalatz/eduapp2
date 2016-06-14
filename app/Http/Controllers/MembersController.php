<?php

namespace App\Http\Controllers;

use App\Grader;

use Illuminate\Http\Request;

use App\Http\Requests;

class MembersController extends Controller
{

  public function __construct()
  {
      $this->middleware('verified');

      $this->middleware('is_member');

  }

  public function graders_a()
  {
    $graders = Grader::with('user')->get();

    return view('members.graders_a', compact('graders'));
  }

}
