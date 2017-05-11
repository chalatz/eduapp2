<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

use App\Site;

use App\Config;

class EditSiteRequest extends Request
{
    /**
     * Make sure the User is the owner of the Site
     *
     * @return bool
     */
    public function authorize()
    {
        $site_id = $this->route()->parameter('sites');

        $site = Site::find($site_id);

        if(Request::session()->has('ninja_id')){
            return $this->user()->id == $site->user_id;
        }

        return Config::first()->end_of_gradings == 0 && $this->user()->id == $site->user_id;
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
