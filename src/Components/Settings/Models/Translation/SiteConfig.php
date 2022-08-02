<?php

namespace App\Components\Settings\Models\Translation;

use Illuminate\Database\Eloquent\Model;

class SiteConfig extends Model
{
    protected $table = "site_config_translations";
    protected $fillable = ['title','description','keywords'];
    protected $guarded = ['site_config_id'];
    public $timestamps = false;
}