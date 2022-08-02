<?php

namespace App\Components\Clients\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserUpdateApiRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'name'                  => 'required|string|between:2,100',
            'email'                 => 'nullable|email:filter|max:255|unique:users,email,'.\Auth::user()->id,
            'phone'                 => 'required|digits:9|regex:/^(5)?([0-9]){2}([0-9]){6}$/|unique:users,phone,'.\Auth::user()->id,
            'dev_type'              => 'required',
            'dev_token'             => 'required',
            'image'                 => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }

    protected function failedValidation(Validator $validator) {
        if ($this->wantsJson()) {
            throw new HttpResponseException(response()->json( api_response( 0 , $validator->errors()->first()), 422));
        }
        parent::failedValidation($validator);
    }
}
