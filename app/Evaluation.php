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

}
