<?php

namespace App\Http\Requests\Site\Auth;

use Illuminate\Foundation\Http\FormRequest;

class SigninPanelRequest extends FormRequest
{
    protected $errorBag = 'form';

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
        $results = [
            'password'              => __('Password')
        ];
        if (is_numeric(request()->phone_email)) {
            $results['phone_email']   = __('Phone');
        }else {
            $results['phone_email']   = __('Email');
        }
        return $results;
    }

    public function messages()
    {
        $messages = [];
        if (is_numeric(request()->phone_email) == true) {
            return ['phone_email.exists'       => __('Sorry, this number is not registered with us. Please verify your mobile number')];
        }else{
            return ['phone_email.exists'       => __('Sorry, this e-mail is not registered with us. Please check your e-mail')];
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'password'      => 'required',
        ];
        if (is_numeric(request()->phone_email) == true) {
            $rules['phone_email']   = 'required|digits:9|regex:/^(5)?([0-9]){2}([0-9]){6}$/|exists:users,phone';
        }else{
            $rules['phone_email']   = 'required|exists:users,email';
        }
        return $rules;
    }
}
