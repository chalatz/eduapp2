<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Mail;
use App\Role;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'verification_token'
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

    public function sendVerificationEmail()
    {
        $data = [
            'verification_token' => $this->verification_token,
            'verification_url' => route('user.verify', ['verification_token' => $this->verification_token]),
        ];

        Mail::send('emails.verify_user', ['data' => $data], function ($message) use ($data) {
            $message->to($this->email, $this->email)->subject('Επιβεβαιώστε το email σας. Edu Web Awards 2017');
        });
    }

} // end Class
