<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RolesRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $rules = [
            'name' => 'required|min:4|unique:roles|alpha_dash',
            'display_name' => 'required|min:4|unique:roles|regex:/^[\pL\s]+$/u',
            'description' => 'max:255'
        ];

        if($this->method() == 'PUT'){
            $id = $this->route()->parameters()['roles'];

            $rules['name'] = 'required|min:4|alpha_dash|unique:roles,name,'.$id;
            $rules['display_name'] = 'required|min:4|regex:/^[\pL\s]+$/u|unique:roles,display_name,'.$id;
        }

        return $rules;
    }
}
