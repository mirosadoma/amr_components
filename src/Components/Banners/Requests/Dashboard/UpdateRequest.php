<?php

namespace App\Components\Banners\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
        $return = [
            'link'          => __('Link'),
            'image'         => __('Image'),
        ];
        return $return;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'link'          => 'nullable|url',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ];
        return $rules;
    }
}
