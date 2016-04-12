<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

use App\Site;

class CreateSiteRequest extends Request
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

        return $user && $user->verified && $user->suggestion->accepted == 'yes';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Site::$rules;
    }
}
