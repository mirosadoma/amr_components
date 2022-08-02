<?php

namespace App\Http\Requests\Site\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ForgetPanelRequest extends FormRequest
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
        if (is_numeric(request()->phone_email)) {
            return ['phone_email'       => __('Phone'),];
        }else {
            return ['phone_email'       => __('Email'),];
        }
    }

    public function messages()
    {
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
        if (is_numeric(request()->phone_email) == true) {
            return ['phone_email'       => 'required|digits:9|regex:/^(5)?([0-9]){2}([0-9]){6}$/|exists:users,phone'];
        }else{
            return ['phone_email'       => 'required|exists:users,email'];
        }
    }
}
