<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class The_graders extends Model
{
    protected $table = 'the_graders';

    protected $fillable = [
        'grader_id',
        'district_id',
        'cat_id',
        'specialty_id',
        'sites_left',
    ];

}
