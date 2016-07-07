<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

use Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified');

        $this->middleware('is_admin', ['only' => [
          'masquerade',
        ]]);

        

    }

    public function masquerade(Request $request, $user_id)
    {
        if($user_id == Auth::user()->id){
            flash()->error('Προπαθείτε να μεταμφιεστείτε ως ο εαυτός σας!');
        } else {

            // store the id of the ninja user
            $request->session()->put('ninja_id', Auth::user()->id);

            Auth::loginUsingId($user_id);

        }

        return redirect()->route('home');

    }

    public function switch_back(Request $request)
    {
        if($request->session()->has('ninja_id')){

            $admin = User::find($request->session()->get('ninja_id'));

            Auth::logout();
            Auth::login($admin);

            $request->session()->forget('ninja_id');

            return redirect()->route('home');

        }

    }



}
