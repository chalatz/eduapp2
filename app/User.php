<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Mail;
use App\Role;
use App\Site;
use App\Grader;
use App\Suggestion;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'verification_token', 'verified'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimeStamps();
    }

    public function site()
    {
        return $this->hasOne(Site::class);
    }

    public function grader()
    {
        return $this->hasOne(Grader::class);
    }

    public function suggestion()
    {
        return $this->hasOne(Suggestion::class);
    }

    // the user has suggested someone
    public function hasSuggested()
    {
        $suggestion = Suggestion::where('suggestor_email', $this->email)->first();

        if($suggestion){
            return true;
        } else {
            return false;
        }

    }

    // the one user has suggested, has accepted
    public function hasNotAcceptedYet()
    {
        $suggestion = Suggestion::where('suggestor_email', $this->email)->first();

        if($suggestion && $suggestion->accepted == 'na'){
            return true;
        } else {
            return false;
        }

    }

    // the user is suggested by someone and has not responded yet
    public function hasSuggestionToRespondTo()
    {
        $suggestion = Suggestion::where('grader_email', $this->email)
            ->where('accepted', '!=', 'yes')
            ->where('self_proposed', 'no')
            ->first();

        return $suggestion;
    }

    public function sendVerificationEmail()
    {
        $data = [
            'verification_token' => $this->verification_token,
            'verification_url' => route('user.verify', ['verification_token' => $this->verification_token]),
        ];

        Mail::send('emails.verify_user', ['data' => $data], function ($message) use ($data) {
            $message->to($this->email, $this->email)->subject('Επιβεβαιώστε το email σας.');
        });
    }

    /**
    * Find out if user has a specific role
    *
    * $return boolean
    */
    public function hasRole($check)
    {

        return in_array($check, array_flatten($this->roles->toArray()));

    }

} // end Class
