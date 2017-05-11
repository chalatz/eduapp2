<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

use App\Grader;

use App\Config;

use Auth;

class EditGraderRequest extends Request
{
    /**
     * Make sure the User is the owner of the Grader
     *
     * @return bool
     */
    public function authorize()
    {
        $grader_id = $this->route()->parameter('graders');

        $grader = Grader::find($grader_id);

        if(Auth::user()->hasRole('member') || Request::session()->has('ninja_id')){
            return $this->user()->id == $grader->user_id;
        }     

        return Config::first()->end_of_gradings == 0 && $this->user()->id == $grader->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Grader::$rules;
    }
}
