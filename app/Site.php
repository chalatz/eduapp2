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
            if($evaluation->complete()){
                $i++;
            }
        }

        if($i >= $count || $i >= 2){
            return true;
        } else {
            return false;
        }

    }

}
