<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Site extends Model
{

    protected $fillable = [
        'site_url',
        'title',
        'cat_id',
    ];

    public function site()
    {
        return $this->hasOne(User::class);
    }

}
