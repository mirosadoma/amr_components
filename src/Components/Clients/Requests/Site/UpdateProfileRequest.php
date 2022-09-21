<?php

namespace App\Components\Clients\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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

    public function attributes()
    {
        return [
            'name'                  => __('Name'),
            'email'                 => __('Email'),
            'phone'                 => __('Phone'),
            'image'                 => __('Image'),
            'gender'                => __('Gender'),
            'city_id'               => __('City'),
        ];
    }

    public function messages()
    {
        return [
            'name.regex' => __('Please enter the correct full name without symbols or numbers'),
            'phone.regex' => __('Incorrect mobile number format must match 5xxxxxxxx')
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'                  => 'required|regex:/^[\p{Arabic}a-zA-Z ]+$/u|string|between:2,100|unique:users,name,'.$this->client,
            'email'                 => 'required|email:filter|between:2,200|unique:users,email,'.$this->client,
            'phone'                 => 'required|digits:9|regex:/^(5)?([0-9]){2}([0-9]){6}$/|unique:users,phone,'.$this->client,
            'image'                 => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'gender'               => 'required|exists:cities,id',
            "gender"  => [
                "required",
                Rule::in(['male', 'female']),
            ],
            'city_id'               => 'required|not_in:0|exists:cities,id',
        ];
    }
}
