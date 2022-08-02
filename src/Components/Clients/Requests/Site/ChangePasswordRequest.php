<?php

namespace App\Components\Clients\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'old_password'              => __('Old Password'),
            'new_password'              => __('New Password'),
            'password_confirmation'     => __('Confirmation Password'),
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
            'old_password'          => 'required|min:6|max:255',
            'new_password'          => 'required|min:6|max:255',
            'password_confirmation' => 'required_with:new_password|same:new_password',
        ];
    }
}
