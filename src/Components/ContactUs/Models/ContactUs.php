<?php

namespace App\Components\ContactUs\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model {

    protected $table = "contact_us";
    protected $guarded = ['id'];

    public static function FORM_SEARCH(){
        return [
            'inputs' => [
                [
                    'label' => 'Name',
                    'name'  => 'name',
                    'type'  => 'text',
                    'value' => '',
                ],
                [
                    'label' => 'Email',
                    'name'  => 'email',
                    'type'  => 'email',
                    'value' => '',
                ],
                [
                    'label' => 'Phone',
                    'name'  => 'phone',
                    'type'  => 'number',
                    'value' => '',
                ],
                [
                    'label' => 'Created At',
                    'name'  => 'created_at',
                    'type'  => 'date',
                    'value' => '',
                ],
            ]
        ];
    }
}