<?php

namespace App\Components\Pages\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Page extends Model {
    use Translatable;
    protected $table = "pages";
    protected $translationForeignKey = "page_id";
    public $translatedAttributes = [
        'title','excerpt','content','slug'
    ];
    public $translationModel = 'App\Components\Pages\Models\Translation\Page';
    protected $guarded = ['id'];

    public static function FORM_INPUTS(){
        return [
            'editor' => true,
            'lang' => [
                'inputs' => [
                    [
                        'label' => 'Title',
                        'name'  => 'title',
                        'type'  => 'text',
                    ],
                    [
                        'label' => 'Excerpt',
                        'name'  => 'excerpt',
                        'type'  => 'text',
                    ],
                    [
                        'label' => 'Descriptions',
                        'name'  => 'content',
                        'type'  => 'textarea',
                        'editor' => true,
                    ],
                ]
            ],
            'files' => [
                [
                    'label'         => 'Image',
                    'name'          => 'image',
                    'class'         => 'page_image', // to call file input by class
                    'type'          => 'image', // image/video/file
                    'path'          => 'image_path', // to call file path
                    'delete_url'    => 'pages/remove_image/', // to delete file
                    'multiple'      => false, // file/files
                ],
            ],
        ];
    }

    public static function FORM_SEARCH(){
        return [
            'inputs' => [
                [
                    'label' => 'Title',
                    'name'  => 'title',
                    'type'  => 'text',
                    'value' => '',
                ],
                [
                    'label' => 'Status',
                    'name'  => 'is_active',
                    'type'  => 'select',
                    'value' => ['1' => __("Active"),'0' => __("Un Active")],
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

    public function getImagePathAttribute()
    {
        return $this->image ? url($this->image) : url('assets/admin/app-assets/images/portrait/small/avatar-s-11.jpg');
    }
}
