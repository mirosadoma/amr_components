<?php

namespace App\Components\Settings\Requests\Dashboard;

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
        return [
            // 'pay_percentage'    => __('Pay Percentage'),
            // 'vat'               => __('Vat'),
            // 'application_ratio' => __('Application Ratio'),
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
            // 'pay_percentage'    => 'required|numeric|min:1|not_in:0',
            // 'vat'               => 'required|numeric|min:1|not_in:0|lt:pay_percentage',
            // 'application_ratio' => 'required|numeric|min:1|not_in:0|lt:pay_percentage',
        ];
    }
}
