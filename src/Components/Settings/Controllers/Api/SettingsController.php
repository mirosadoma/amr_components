<?php

namespace App\Components\Settings\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Resources
use App\Components\Settings\Resources\Api\SettingsResource;
// Models
use App\Components\Settings\Models\SiteSocial;
use App\Components\Settings\Models\SiteConfig;

class SettingsController extends Controller {

    public $successStatus = 200;
    public $errorStatus = 422;

    public function contact_us()
    {
        $settings = SiteSocial::all();
        $msg = api_msg(request() , 'كل معلومات التواصل' ,'All Contact us');
        return response()->json(api_response( 1 , $msg , SettingsResource::collection($settings)), $this->successStatus);
    }

    public function settings_contact()
    {
        $setting = SiteConfig::first();
        $msg = api_msg(request() , 'أرقام التواصل' ,'Numbers Contact');
        return response()->json(api_response( 1 , $msg , [
            'phone'     => $setting->phone ?? "",
            'whatsapp'  => $setting->whatsapp ?? "",
        ]), $this->successStatus);
    }

    public function settings_mobile_links()
    {
        $setting = SiteConfig::first();
        $msg = api_msg(request() , 'روابط التطبيق' ,'App Urls');
        return response()->json(api_response( 1 , $msg , [
            'app_store'     => $setting->appstore ?? "",
            'google_app'    => $setting->googleplay ?? "",
        ]), $this->successStatus);
    }
}
