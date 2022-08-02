<?php

namespace App\Components\ContactUs\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SendContactUsRequest extends FormRequest
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
            'name'                  => __('Name'),
            'phone'                 => __('Phone'),
            'email'                 => __('Email'),
            'message'               => __('Message'),
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name'                  => 'required|string|between:2,100',
            'phone'                 => 'required|digits:9|regex:/^(5)?([0-9]){2}([0-9]){6}$/',
            'email'                 => 'nullable|email:filter|max:255',
            'message'               => 'required|string|between:2,500'
        ];
       
        return $rules;
    }
    
    protected function failedValidation(Validator $validator) {
        if ($this->wantsJson()) {
            throw new HttpResponseException(response()->json( api_response( 0 , $validator->errors()->first()), 422));
        }
        parent::failedValidation($validator);
    }
}
