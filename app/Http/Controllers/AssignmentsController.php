<?php

namespace App\Http\Controllers;

use App\Grader;
use App\Site;
use App\Suggestion;

use Illuminate\Http\Request;

use App\Http\Requests;

class AssignmentsController extends Controller
{
    public function assigns()
    {
        echo "<pre>";

        // create the sites array
        $sites = $this->the_sites_array();
        $sites2 = $this->the_sites_array();

        echo "=================== SITES ==================================<br>";
        print_r($sites);
        echo "=================== END SITES ==================================<br>";

        // create the graders array
        $graders = $this->the_graders_array();
        $graders2 = $this->the_graders_array();

        echo "=================== GRADERS ==================================<br>";
        print_r($graders);
        echo "=================== END GRADERS ==================================<br>";

        $a = [];

        $i = 0;
        $j = 0;

        foreach($sites as $site_key => $site){
            if($sites2[$j]['graders_left'] > 0){
                foreach($graders as $grader_key => $grader){
                    if(
                        $grader['id'] != $site['grader_id'] && 
                        $grader['district_id'] != $site['district_id'] && 
                        $graders2[$i]['sites_left'] > 0
                    ){
                        $a[$i]['site_id'] = $site['id'];
                        $a[$i]['grader_id'] = $grader['id'];
                        
                        // $sites[$site_key]['graders_left'] -= 1;
                        // $graders[$grader_key]['sites_left'] -= 1;

                        $a[$i]['graders_left'] = $site['graders_left'];
                        $a[$i]['sites_left'] = $grader['sites_left'];

                        $i++;

                    }
                }
            }

            $j++;
            
        }

        // foreach($sites as $key => $value){
        //     $sites[$key]['graders_left'] = 0;

        // }

        echo "=================== ASSIGNMENTS ==================================<br>";
        print_r($a);
        echo "=================== ASSIGNMENTS ==================================<br>";

        echo "</pre>";


        //dd($the_graders);


    }

    public function assigns_tables()
    {
        $status = 'on';

        if($status == 'on'){

            

        }

    }

    private function the_sites_array()
    {
        $the_sites = [];

        $i = 0;

        $sites = Site::all();

        foreach($sites as $site){
            $the_sites[$i]['id'] = $site->id;
            $the_sites[$i]['district_id'] = $site->district_id;
            $the_sites[$i]['grader_id'] = $site->grader_id;
            $the_sites[$i]['graders_left'] = 2;

            $i++;
        }

        return $the_sites;

    }

    private function the_graders_array()
    {
        $the_graders = [];

        $j = 0;

        $graders = Grader::all();

        foreach($graders as $grader){
            if(!$grader->user->hasRole('member')){
                if($grader->user->hasRole('grader_a') && $grader->hasSite()){
                    $the_graders[$j]['id'] = $grader->id;
                    $the_graders[$j]['district_id'] = $grader->district_id;
                    $the_graders[$j]['sites_left'] = $grader->suggestions_count * 2;
                    

                    $j++;
                }
            }
        }

        return $the_graders;

    }
    

}
