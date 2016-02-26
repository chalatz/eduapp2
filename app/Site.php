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
    ];

    public function site()
    {
        return $this->hasOne(User::class);
    }

}
