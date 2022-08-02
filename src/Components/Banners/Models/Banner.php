<?php

namespace App\Components\Banners\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model {

    protected $table = "banners";
    protected $guarded = ['id'];

    public static function FORM_INPUTS(){
        return [
            'editor' => true,
            'inputs' => [
                [
                    'label' => 'Link',
                    'name'  => 'link',
                    'type'  => 'text',
                    'value' => '',
                ],
            ],
            'files' => [
                [
                    'label'         => 'Image',
                    'name'          => 'image',
                    'class'         => 'banner_image', // to call file input by class
                    'type'          => 'image', // image/video/file
                    'path'          => 'image_path', // to call file path
                    'delete_url'    => 'banners/remove_image/', // to delete file
                    'multiple'      => false, // file/files
                ],
            ],
        ];
    }

    public static function FORM_SEARCH(){
        return [
            'inputs' => [
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
        return $this->image ? url($this->image) : url('assets/site/images/two-confident-business-man-shaking-hands-during-meeting-office-success-dealing-greeting-partner-concept_1423-185.webp');
    }
}
