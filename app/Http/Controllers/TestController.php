<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Suggestion;
use App\Site;
use App\Grader;
use app\User;

use App\Http\Utilities\Category;
use App\Http\Utilities\District;

use Auth;

class TestController extends Controller
{
    public function ajax_test()
    {
        return view('pages.ajax_test');
    }

    public function ajax_url(Request $request, $district_id)
    {
        $sites = Site::where('district_id', $district_id)->get();

        if($request->ajax()){
            $html = '';
            
            foreach($sites as $site){
                $html .= '<p>' . $site->id . '</p>';
            }

            return $html;

        } else {
            return redirect()->route('home');
        }
    }

}
