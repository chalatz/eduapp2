<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

use App\Grader;

class CreateGraderRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // the user must be verified
        $user = Request::user();

        // there must NOT be a grader for the user
        $grader = Grader::where('user_id', $user->id)->first();

        return $user && $user->verified && !$grader;
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
