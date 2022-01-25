<?php

namespace App\Http\Requests;

class UpdateProfileInput extends BaseRequest
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
        return [
            'email' => 'string|email|max:255|unique:users',
            'name' => "string",
            'password' => 'string|min:6|max:255',
            'phone' => 'string',
            'location_id' => 'numeric|min:1|max:63',
            'birthday' => 'date_format:Y-m-d',
            'role_id' => 'numeric'
        ];
    }
}
