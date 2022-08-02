<?php

namespace App\Components\Pages\Requests\Dashboard;

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
        $langs = [
            'title'                 => 'Title',
            'excerpt'               => 'Excerpt',
            'content'               => 'Content',
        ];
        $return = [
            'image'                 => __('Page Image'),
        ];
        foreach(app_languages() as $key=>$value) {
            foreach($langs as $K=>$V) {
                $return[$key.".".$K] = __($value['name']. " " .$V);
            }
        }
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
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ];
        $lang_rules = [];
        foreach(app_languages() as $key => $value){
            $lang_rules[$key] = [
                $key.".title"   => "required|string|between:2,100",
                $key.".excerpt" => "required|string|between:2,500",
                $key.".content" => "required|string|between:2,1000",
            ];
        }
        extract($lang_rules, EXTR_PREFIX_SAME, "wddx");
        $rules = array_merge($rules, $ar, $en);
        return $rules;
    }
}
