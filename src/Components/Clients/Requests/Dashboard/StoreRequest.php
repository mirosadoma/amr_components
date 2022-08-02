<?php

namespace App\Components\Clients\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name'                  => __('Client Name'),
            'email'                 => __('Client Email'),
            'phone'                 => __('Client Phone'),
            'image'                 => __('Client Image'),
            'password'              => __('Client Password'),
            'password_confirmation' => __('Password Confirmation'),
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
            'name'                  => 'required|regex:/^[\p{Arabic}a-zA-Z ]+$/u|string|between:2,100|unique:users,name',
            'email'                 => 'required|email:filter|between:2,200|unique:users,email',
            'phone'                 => 'required|digits:9|regex:/^(5)?([0-9]){2}([0-9]){6}$/|unique:users,phone',
            'image'                 => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'password'              => 'required|min:6|max:255',
            'password_confirmation' => 'required_with:password|same:password',
            'city_id'               => 'required|exists:cities,id',
        ];
    }
}
