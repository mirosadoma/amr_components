<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsPanelRequest extends FormRequest
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
        return [
            'email'                     => __('Email'),
            'purpose'                   => __('Purpose'),
            'important'                 => __('Important'),
            'subject'                   => __('Subject'),
            'msg'                       => __('Message'),
            'captcha'                   => __('Captcha'),
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
            'email'             => 'required',
            'purpose'           => 'required|not_in:null',
            'important'         => 'required|not_in:null',
            'subject'           => 'required|min:5',
            'msg'               => 'required',
            'captcha'           => 'required',
        ];
    }
}
