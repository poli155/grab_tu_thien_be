<?php

namespace App\Http\Requests;

class RegisterInput extends BaseRequest
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
            'email' => 'required|string|email|max:255|unique:users',
            'name' => "required|string",
            'password' => 'required|string|min:6|max:255',
            'phone' => 'required|string',
            'location_id' => 'required|numeric|min:1|max:63',
            'birthday' => 'required|date_format:Y-m-d',
            'role_id' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email is required!',
            'email.max' => 'Email is too long',
            'email.email' => 'Need to be email',
            'password.required' => 'Password is required!',
            'password.min' => 'Password is too short',
            'password.max' => 'Password is too long',
            'name.required' => 'Name is required!',
            'phone.required' => 'Phone number is required!',
            'location_id.required' => 'Location is required!',
            'birthday.required' => 'Birthday is required!',
            'role_id.required' => 'Role is required!',
        ];
    }
}
