<?php

namespace App\Http\Requests\Site\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SignUpPanelRequest extends FormRequest
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
            'name'                      => __('Name'),
            'email'                     => __('Email'),
            'phone'                     => __('Phone'),
            'gender'                    => __('Gender'),
            'city_id'                   => __('City'),
            'password_confirmation'     => __('Password Confirmation'),
            'password'                  => __('Password'),
            'code'                      => __('Code'),
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
        $data = [
            'name'                  => 'required|regex:/^[\p{Arabic}a-zA-Z ]+$/u|string|between:2,100',
            'email'                 => 'required|email:filter|max:255|unique:users,email',
            'phone'                 => 'required|digits:9|regex:/^(5)?([0-9]){2}([0-9]){6}$/|unique:users,phone',
            'gender'                => [
                "nullable",
                Rule::in(['male', 'female']),
            ],
            'password'              => 'required|min:4|max:50',
            'password_confirmation' => 'required_with:password|same:password',
            'city_id'               => 'required|not_in:0|exists:cities,id',
            'code'                  => 'nullable|not_in:0',
        ];
        return $data;
    }
}
