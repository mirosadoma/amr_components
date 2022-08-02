<?php

namespace App\Http\Requests\Site\Profile;

use Illuminate\Foundation\Http\FormRequest;

class editProfilePanelRequest extends FormRequest
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
            'name'                      => __('Name'),
            'email'                     => __('Email'),
            'phone'                     => __('Phone'),
            'image'                     => __('Image'),
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
            'name'          => 'required|min:5',
            'email'         => 'required|email',
            'phone'         => 'required|min:10',
            'image'         => 'nullable|image',
        ];
    }
}
