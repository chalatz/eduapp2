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
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static $rules = [
        'url' => 'required|url',
        'title' => 'required',
        'cat_id' => 'required',
    ];

}
