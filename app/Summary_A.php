<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Summary_A extends Model
{
    protected $table = 'summary_a';

    protected $fillable = [
        'grader_id',
        'sites_count',
        'grader_name',
        'grader_email',
        'site_titles',
        'site_urls',
    ];

}
