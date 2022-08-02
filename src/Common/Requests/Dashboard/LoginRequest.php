<?php

namespace Amr\AmrComponents\Common\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    public function attributes() {
        return [
            'condition.username'   => __('Username'),
            'condition.password'   => __('Password'),
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $rules = [
            'username'    => 'required',
            'password'    => 'required',
        ];
        return $rules;
    }

}
