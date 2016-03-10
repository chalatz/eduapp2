<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SuggestOtherGraderRequest extends Request
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

        return $user && $user->verified;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'suggestor_name' => 'required',
            'grader_email' => 'required|email|max:255|unique:users,email',
            'personal_msg' => 'required',
        ];
    }
}
