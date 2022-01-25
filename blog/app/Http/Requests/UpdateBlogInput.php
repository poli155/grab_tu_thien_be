<?php

namespace App\Http\Requests;

class UpdateBlogInput extends BaseRequest
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
            'title' => 'string',
            'description' => 'string',
            'location_id' => 'numeric|min:1|max:63',
            'date' => 'date_format:Y-m-d',
        ];
    }
}
