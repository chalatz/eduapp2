<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Suggestion;
use App\Site;
use App\Grader;
use App\User;
use App\Evaluation;

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

        return view('pages.ajax_modal', compact('sites'));

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

    public function panormighty()
    {
        $status = 'off';

        if($status == 'on'){

            $graders_all = Grader::all();

            $graders = [];
            $sites = [];

            $i = 0;

            foreach($graders_all as $grader){
                if($grader->user->hasRole('grader_a') && $grader->hasSite()){
                    $graders[$i]['grader_id'] = $grader->id;
                    $site = Site::where('grader_id', $grader->id)->first();
                    $graders[$i]['site_id'] = $site->id;
                    $graders[$i]['cat_id'] = $site->cat_id;
                    $graders[$i]['district_id'] = $site->district_id;
                    $graders[$i]['specialty'] = $grader->specialty_id;
                    $i++;
                }
            }

            $sites_all = Site::all();

            $i = 0;

            foreach($sites_all as $site){
                $sites[$i]['grader_id'] = $site->grader_id;
                $sites[$i]['id'] = $site->id;
                $sites[$i]['cat_id'] = $site->cat_id;
                $sites[$i]['district_id'] = $site->district_id;
                $i++;
            }

            $s2 = [];
            $sIndex = [];
            foreach ($sites as $s) {
                $s2[$s['id']] = ["cat" => $s['cat_id'], "district" => $s['district_id'],
                            "grader" => $s['grader_id']];
                $sIndex[] = $s['id'];
            }

            $sites = $s2;

            $g2 = [];
            $gIndex = [];
            foreach ($graders as $g) {
                $g2[$g['grader_id']] = ["cat" => $g['cat_id'], "district" => $g['district_id'],
                                "site" => $g['site_id'], "specialty" => $g['specialty']];
                $gIndex[] = $g['grader_id'];
            }


            $graders = $g2;        

            // echo "<pre>";
            // print_r($graders);
            // echo "</pre>";
            
            // dd(count($graders));

            // file_put_contents('C:\laragon\www\eduapp2\the_graders.inc', serialize($graders));
            // file_put_contents('C:\laragon\www\eduapp2\the_sites.inc', serialize($sites));            

        } else {
            return "status: off";
        }

    }

    public function deleted_evaluations()
    {
        $evaluations = Evaluation::all();

        $arr = [];

        $i = 0;
        foreach($evaluations as $evaluation){
            $arr[$i] = $evaluation->id;
            $i++;
        }

        $arr[count($arr)] = 560;

        //echo $arr[count($arr)-1];

        for($j = 0; $j < count($arr)-1; $j++){
            $diff = abs($arr[$j] - $arr[$j + 1]);
            //echo $arr[$j] . '<br>';
            if($diff != 1){
                echo $arr[$j] . '<br>';
            }
        }

        echo '<p>----------------------</p>';

        for($j = 0; $j < count($arr)-1; $j++){
            $diff = abs($arr[$j] - $arr[$j + 1]);
            //echo $arr[$j] . '<br>';
            if($diff != 1){
                echo $arr[$j]+1 . '<br>';
            }
        }

    }

}
