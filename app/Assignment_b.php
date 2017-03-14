<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment_b extends Model
{
    protected $table = 'assignments_b';

    protected $fillable = [
        'site_id',
        'grader_id',
    ];
}
