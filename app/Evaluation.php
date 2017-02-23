<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $fillable = [

        'grader_id',
        'site_id',
        'can_evaluate',
        'why_cannot_evaluate',
        'is_educational',
        'why_not_educational',
        'assigned_at',
        'assigned_until',

        'bk1',
        'bk2',
        'bk3',
        
        'gk1',
        'gk2',
        'gk3',
        'gk4',
        'gk5',

        'dk1',
        'dk2',
        'dk3',
        'dk4',
        'dk5',

        'ek1',
        'ek2',
        'ek3',

        'stk1',
        'stk2',
        'stk3',
        'stk4',

        'beta_grade',
        'gama_grade',
        'delta_grade',
        'epsilon_grade',
        'st_grade',

        'site_comment',

        'bk1_comment',
        'bk2_comment',
        'bk3_comment',

        'gk1_comment',
        'gk2_comment',
        'gk3_comment',
        'gk4_comment',
        'gk5_comment',

        'dk1_comment',
        'dk2_comment',
        'dk3_comment',
        'dk4_comment',
        'dk5_comment',

        'ek1_comment',
        'ek2_comment',
        'ek3_comment',

        'stk1_comment',
        'stk2_comment',
        'stk3_comment',
        'stk4_comment',

        'beta_comment',
        'gama_comment',
        'delta_comment',
        'epsilon_comment',
        'st_comment',

        'total_grade',

    ];

    public static $rules = [

        'bk1' => 'sometimes|required',
        'bk2' => 'sometimes|required',
        'bk3' => 'sometimes|required',

        'gk1' => 'sometimes|required',
        'gk2' => 'sometimes|required',
        'gk3' => 'sometimes|required',
        'gk4' => 'sometimes|required',
        'gk5' => 'sometimes|required',

        'dk1' => 'sometimes|required',
        'dk2' => 'sometimes|required',
        'dk3' => 'sometimes|required',
        'dk4' => 'sometimes|required',
        'dk5' => 'sometimes|required',

        'ek1' => 'sometimes|required',
        'ek2' => 'sometimes|required',
        'ek3' => 'sometimes|required',

        'stk1' => 'sometimes|required',
        'stk2' => 'sometimes|required',
        'stk3' => 'sometimes|required',
        'stk4' => 'sometimes|required',

    ];

    public function grades_a()
    {
        $output = 'na';

        if($this->can_evaluate == 'yes' && $this->is_educational == 'yes' && $this->beta_grade > 0 && $this->gama_grade > 0 && $this->delta_grade > 0 && $this->epsilon_grade > 0 && $this->st_grade > 0){
            $output = 'Έχει αξιολογήσει | 0';
        }

        if($this->can_evaluate == 'no'){
            $output = '-- Δεν έχει αποδεχθεί | -1';
        }

        if($this->can_evaluate == 'na'){
            $output = '-- Δεν έχει ασχοληθεί | 3';
        }

        if($this->can_evaluate == 'yes'){
            if($this->beta_grade == 0 || $this->gama_grade == 0 || $this->delta_grade == 0 || $this->epsilon_grade == 0 || $this->st_grade == 0 || $this->is_educational == 'na'){
                $output = '-- Έχει αποδεχθεί, αλλά δεν έχει ολοκληρώσει | - 2';
            }
        }        

        if($this->can_evaluate == 'yes' && $this->is_educational == 'no'){
            $output = '-- Δεν τον βρήκε εκπαιδευτικό | 1';
        }

        return $output;

    }


}
