<?php

namespace App\Components\Settings\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class SiteConfig extends Model {

    use Translatable;
    protected $table = "site_config";
    protected $translationForeignKey = "site_config_id";
    public $translatedAttributes = [
        'title','description','keywords'
    ];
    public $translationModel = 'App\Components\Settings\Models\Translation\SiteConfig';
    protected $guarded = ['id'];

    public function getLogoPathAttribute()
    {
        return $this->logo ? url($this->logo) : url('assets/logo.svg');
    }

    public function getFooterLogoPathAttribute()
    {
        return $this->footer_logo ? url($this->footer_logo) : url('assets/logo-footer.svg');
    }
    
    public function getPhoneNumberAttribute()
    {
        return $this->phone ? "966".$this->phone . "+" : $this->phone;
    }
}
