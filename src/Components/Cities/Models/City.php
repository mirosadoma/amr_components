<?php

namespace App\Components\Cities\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
// Models
use App\Components\Countries\Models\Country;
use App\Models\User;

class City extends Model {

    use Translatable;
    protected $table = "cities";
    protected $translationForeignKey = "city_id";
    public $translatedAttributes = ['name'];
    public $translationModel = 'App\Components\Cities\Models\Translation\City';
    protected $guarded = ['id'];

    public static function FORM_INPUTS(){
        return [
            'lang' => [
                'inputs' => [
                    [
                        'label' => 'Name',
                        'name'  => 'name',
                        'type'  => 'text',
                    ],
                ]
            ],
        ];
    }

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
                    'label' => 'Created At',
                    'name'  => 'created_at',
                    'type'  => 'date',
                    'value' => '',
                ],
            ]
        ];
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
