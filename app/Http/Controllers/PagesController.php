<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Suggestion;

use Auth;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified', ['only' => [
            'choose_grader_type',
            'suggest_other_grader',
            'other_grader_email',
        ]]);

        $this->middleware('grader_has_not_accepted', ['only' => [
            'choose_grader_type',
            'suggest_other_grader',
        ]]);
    }

    public function index()
    {
        return view('pages.index');
    }

    public function choose_grader_type()
    {
        return view('pages.choose_grader_type');
    }

    public function suggest_other_grader()
    {
        return view('pages.suggest_other_grader');
    }

    public function other_grader_email()
    {
        return view('pages.other_grader_email');
    }

    public function test()
    {
        return view('pages.test');
    }


}
