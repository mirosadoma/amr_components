<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Components\Notifications\Models\Notification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Components\Cities\Models\City;

class Client extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    public static function FORM_INPUTS(){
        return [
            'inputs' => [
                [
                    'label'         => 'Name',
                    'name'          => 'name',
                    'type'          => 'text',
                ],
                [
                    'label'         => 'Email',
                    'name'          => 'email',
                    'type'          => 'email',
                ],
                [
                    'label'         => 'Phone',
                    'name'          => 'phone',
                    'type'          => 'number',
                ],
                [
                    'label'         => 'Password',
                    'name'          => 'password',
                    'type'          => 'password',
                ],
                [
                    'label'         => 'Password Confirmation',
                    'name'          => 'password_confirmation',
                    'type'          => 'password',
                ],
                // [
                //     'label'         => 'Cities',
                //     'name'          => 'city_id',
                //     'type'          => 'select',
                //     'options'       => City::all()
                // ],
            ],
            'files' => [
                [
                    'label'         => 'Client Image',
                    'name'          => 'image',
                    'class'         => 'client_image', // to call file input by class
                    'type'          => 'image', // image/video/file
                    'path'          => 'image_path', // to call file path
                    'delete_url'    => 'clients/remove_image/', // to delete file
                    'multiple'      => false, // file/files
                ],
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
                [
                    'label' => 'Status',
                    'name'  => 'is_active',
                    'type'  => 'select',
                    'value' => ['1' => __("Active"),'0' => __("Un Active")],
                ],
                // [
                //     'label' => 'Role',
                //     'name'  => 'role_id',
                //     'type'  => 'select',
                //     'value' => [\App\User::class, 'getRoles'],
                // ],
            ]
        ];
    }

    protected $dates = ['deleted_at'];

    protected $table = "users";

    protected $guarded = ['id'];

    Protected $guard_name ='admin';

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            $query->where('api_token',generator_api_token());
        });
    }

    public function getPhoneNumberAttribute()
    {
        return $this->phone ? $this->phone : $this->phone;
    }

    public function getImagePathAttribute()
    {
        return $this->image ? url($this->image) : url('assets/logo.svg');
    }

    // public function city()
    // {
    //     return $this->belongsTo(City::class);
    // }

    public function parent()
    {
        return $this->belongsTo(Self::class, 'parent_id');
    }
}
