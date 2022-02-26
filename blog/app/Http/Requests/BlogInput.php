<?php

namespace App\Http\Requests;

class BlogInput extends BaseRequest
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
            'title' => 'required|string',
            'description' => 'string',
            'target' => 'required|numeric',
            'location_id' => 'required|numeric|min:1|max:63',
            'date' => 'required|date_format:Y-m-d',
        ];
    }
}
