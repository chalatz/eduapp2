<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class The_sites extends Model
{
    protected $table = 'the_sites';

    protected $fillable = [
        'site_id',
        'district_id',
        'cat_id',
        'grader_id',
        'specialty_id',
        'graders_left',
    ];

}
