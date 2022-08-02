<?php

namespace App\Components\Notifications\Requests\Dashboard;

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
            'ar.title'                      => __('Arabic Title'),
            'en.title'                      => __('English Title'),
            'ar.message'                    => __('Arabic Message'),
            'en.message'                    => __('English Message'),
            'clients'                       => __('Clients'),
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
            'clients'               => 'required|array|not_in:0',
        ];
        $lang_rules = [];
        foreach(app_languages() as $key => $value){
            $lang_rules[$key] = [
                $key.".title" => "required|string|between:2,500",
                $key.".message" => "required|string|between:5,1000",
            ];
        }
        extract($lang_rules, EXTR_PREFIX_SAME, "wddx");
        $rules = array_merge($rules, $ar, $en);
        return $rules;
    }
}
