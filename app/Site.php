<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Site extends Model
{

    protected $fillable = [
        'url',
        'title',
        'cat_id',
        'user_id',
        'grader_id',
        'creator',
        'responsible',
        'responsible_type',
        'district_id',
        'county_id',
        'country_id',
        'language_id',
        'uses_private_data',
        'received_permission',
        'restricted_access',
        'restricted_access_details',
        'purpose',
        'contact_last_name',
        'contact_first_name',
        'contact_email',
        'contact_phone',
        'contact_address',
        'i_agree',
        'specialty_id',
        'primary_edu_id',
        'secondary_edu_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static $rules = [
        'url' => 'required|url',
        'title' => 'required',
        'cat_id' => 'required',
        'creator' => 'required',
        'responsible' => 'required',
        'responsible_type' => 'required',
        'district_id' => 'required',
        'county_id' => 'required',
        'uses_private_data' => 'required',
        'received_permission' => 'required_if:uses_private_data,yes',
        'restricted_access' => 'required',
        'restricted_access_details' => 'required_if:restricted_access,yes',
        'contact_last_name' => 'required',
        'contact_first_name' => 'required',
        'contact_email' => 'required',
        'contact_phone' => 'required',
        'i_agree' => 'sometimes|accepted',
    ];

    public function disq()
    {
        $grader_user = User::where('email', $this->user->suggestion->grader_email)->first();

        $suggestion = $this->user->suggestion;

        $grader_user = User::where('email', $suggestion->grader_email)->first();

        $grader = $grader_user->grader;

        $evaluations = Evaluation::where('grader_id', $grader->id)->get();

        $count = $evaluations->count(); 

        $i = 0;
        foreach($evaluations as $evaluation){
            if($evaluation->complete() || $evaluation->total_grade == 1){
                $i++;
            }
        }

        if($i >= $count || $i >= 2){
            return false;
        } else {
            return true;
        }

    }

    // the site is graded ok
    public function graded($phase)
    {
        if($phase == 'a'){
            $evaluations = Evaluation::where('site_id', $this->id)->get();
        }

        if($phase == 'b'){
            $evaluations = Evaluation_b::where('site_id', $this->id)->get();
        }

        if($phase == 'c'){
            $evaluations = Evaluation_c::where('site_id', $this->id)->get();
        }                 

        $counter = 0;

        foreach($evaluations as $evaluation){

            if($evaluation->complete()){
                $counter++;
            }

        }            

        if($evaluations->count() >= 2 && $counter >= 2){
            return true;
        } else {
            return false;
        }

    }

    public function total_grades($phase)
    {
        if($phase == 'a'){
            $evaluations = Evaluation::where('site_id', $this->id)->orderBy('total_grade', 'desc')->get();
        }

        if($phase == 'b'){
            $evaluations = Evaluation_b::where('site_id', $this->id)->orderBy('total_grade', 'desc')->get();
        }

        if($phase == 'c'){
            $evaluations = Evaluation_c::where('site_id', $this->id)->orderBy('total_grade', 'desc')->get();
        }                 

        $total_grades = [];

        foreach($evaluations as $evaluation){
            $total_grades[] = $evaluation->total_grade;
        }

        if(count($total_grades) < 2){
            $total_grades[0] = 0;
            $total_grades[1] = 0;
        }

        return $total_grades;

    }

    public function axes()
    {
        $evaluations_a = Evaluation::where('site_id', $this->id)->orderBy('total_grade', 'desc')->get();
        $evaluations_b = Evaluation_b::where('site_id', $this->id)->orderBy('total_grade', 'desc')->get();
        $evaluations_c = Evaluation_c::where('site_id', $this->id)->orderBy('total_grade', 'desc')->get();
        
        $c = 0;
        if($evaluations_a->count() >= 2){
            foreach($evaluations_a as $evaluation_a){
                $beta_grades_a[] = $evaluation_a->beta_grade;
                $gama_grades_a[] = $evaluation_a->gama_grade;
                $delta_grades_a[] = $evaluation_a->delta_grade;
                $epsilon_grades_a[] = $evaluation_a->epsilon_grade;
                $st_grades_a[] = $evaluation_a->st_grade;

                $c++;
                if($c == 2) { break; }
            }

            $axis['beta'] = $beta_grades_a;
            $axis['gama'] = $gama_grades_a;
            $axis['delta'] = $delta_grades_a;
            $axis['epsilon'] = $epsilon_grades_a;
            $axis['st'] = $st_grades_a;
        }

        $c = 0;
        if($evaluations_b->count() >= 2){
            foreach($evaluations_b as $evaluation_b){
                $beta_grades_b[] = $evaluation_b->beta_grade;
                $gama_grades_b[] = $evaluation_b->gama_grade;
                $delta_grades_b[] = $evaluation_b->delta_grade;
                $epsilon_grades_b[] = $evaluation_b->epsilon_grade;
                $st_grades_b[] = $evaluation_b->st_grade;

                $c++;
                if($c == 2) { break; }
            }

            $axis['beta'] = array_merge($beta_grades_a, $beta_grades_b);
            $axis['gama'] = array_merge($gama_grades_a, $gama_grades_b);
            $axis['delta'] = array_merge($delta_grades_a, $delta_grades_b);
            $axis['epsilon'] = array_merge($epsilon_grades_a, $epsilon_grades_b);
            $axis['st'] = array_merge($st_grades_a, $st_grades_b);
        }

        $c = 0;
        if($evaluations_c->count() >= 2){
            foreach($evaluations_c as $evaluation_c){
                $beta_grades_c[] = $evaluation_c->beta_grade;
                $gama_grades_c[] = $evaluation_c->gama_grade;
                $delta_grades_c[] = $evaluation_c->delta_grade;
                $epsilon_grades_c[] = $evaluation_c->epsilon_grade;
                $st_grades_c[] = $evaluation_c->st_grade;

                $c++;
                if($c == 2) { break; }
            }

            $axis['beta'] = array_merge($beta_grades_a, $beta_grades_b, $beta_grades_c);
            $axis['gama'] = array_merge($gama_grades_a, $gama_grades_b, $gama_grades_c);
            $axis['delta'] = array_merge($delta_grades_a, $delta_grades_b, $delta_grades_c);
            $axis['epsilon'] = array_merge($epsilon_grades_a, $epsilon_grades_b, $epsilon_grades_c);
            $axis['st'] = array_merge($st_grades_a, $st_grades_b, $st_grades_c);

        }       

        rsort($axis['beta']);
        rsort($axis['gama']);
        rsort($axis['delta']);
        rsort($axis['epsilon']);
        rsort($axis['st']);

        if(count($axis['beta']) == 2){
            $mo['beta'] = ($axis['beta'][0] + $axis['beta'][1]) / 2;
            $mo['gama'] = ($axis['gama'][0] + $axis['gama'][1]) / 2;
            $mo['delta'] = ($axis['delta'][0] + $axis['delta'][1]) / 2;
            $mo['epsilon'] = ($axis['epsilon'][0] + $axis['epsilon'][1]) / 2;
            $mo['st'] = ($axis['st'][0] + $axis['st'][1]) / 2;
        }

        if(count($axis['beta']) == 4){
            $mo['beta'] = ($axis['beta'][1] + $axis['beta'][2]) / 2;
            $mo['gama'] = ($axis['gama'][1] + $axis['gama'][2]) / 2;
            $mo['delta'] = ($axis['delta'][1] + $axis['delta'][2]) / 2;
            $mo['epsilon'] = ($axis['epsilon'][1] + $axis['epsilon'][2]) / 2;
            $mo['st'] = ($axis['st'][1] + $axis['st'][2]) / 2;
        }

        if(count($axis['beta']) == 6){
            $mo['beta'] = ($axis['beta'][1] + $axis['beta'][2] + $axis['beta'][3] + $axis['beta'][4]) / 4;
            $mo['gama'] = ($axis['gama'][1] + $axis['gama'][2] + $axis['gama'][3] + $axis['gama'][4]) / 4;
            $mo['delta'] = ($axis['delta'][1] + $axis['delta'][2] + $axis['delta'][3] + $axis['delta'][4]) / 4;
            $mo['epsilon'] = ($axis['epsilon'][1] + $axis['epsilon'][2] + $axis['epsilon'][3] + $axis['epsilon'][4]) / 4;
            $mo['st'] = ($axis['st'][1] + $axis['st'][2] + $axis['st'][3] + $axis['st'][4]) / 4;
        }                

        return $mo;
        
    }

    public function final_grades()
    {
        $total_grades_a = [];
        $total_grades_b = [];
        $total_grades_c = [];
        $final_grades = [];

        $evaluations_a = Evaluation::where('site_id', $this->id)->orderBy('total_grade', 'desc')->get();
        $evaluations_b = Evaluation_b::where('site_id', $this->id)->orderBy('total_grade', 'desc')->get();
        $evaluations_c = Evaluation_c::where('site_id', $this->id)->orderBy('total_grade', 'desc')->get();
        
        foreach($evaluations_a as $evaluation_a){
            $total_grades_a[] = $evaluation_a->total_grade;
        }

        foreach($evaluations_b as $evaluation_b){
            $total_grades_b[] = $evaluation_b->total_grade;
        }

        foreach($evaluations_c as $evaluation_c){
            $total_grades_c[] = $evaluation_c->total_grade;
        }

        $final_grades[] = $total_grades_a[0];                
        $final_grades[] = $total_grades_a[1];

        $final_grades[] = $total_grades_b[0];                
        $final_grades[] = $total_grades_b[1];                

        $final_grades[] = $total_grades_c[0];                
        $final_grades[] = $total_grades_c[1];

        rsort($final_grades);

        return $final_grades;                

    }

}
