<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Resources
use App\Components\Settings\Resources\Api\SettingsWelcomeResource;
// use App\Components\Advertises\Resources\Api\AdvertisesResources;
use App\Components\Advertises\Resources\Api\AdvertisesHomeResources;
// Models
use App\Components\Settings\Models\SiteConfig;
use App\Components\Advertises\Models\Advertise;

class MainController extends Controller {

    public $successStatus = 200;
    public $errorStatus = 422;

    public function index()
    {
        $adv_public = Advertise::where('is_active', 1)->where('adv_type', 0)->get();
        $adv_specific = Advertise::where('is_active', 1)->where('adv_type', 1)->get();
        $adv_live = Advertise::where('is_active', 1)->where('adv_type', 2)->get();
        $resources = [
            'adv_public'    => AdvertisesHomeResources::collection($adv_public),
            'adv_specific'  => AdvertisesHomeResources::collection($adv_specific),
            'adv_live'      => AdvertisesHomeResources::collection($adv_live),
        ];
        $msg = api_msg(request() , 'الرئيسية' ,'Home');
        return response()->json(api_response(1 , $msg , $resources), $this->successStatus);
    }

    public function welcome_content()
    {
        $setting = SiteConfig::first();
        $msg = api_msg(request() , 'محتوى رسالة الترحيب' ,'Welcome Content');
        return response()->json(api_response(1 , $msg , new SettingsWelcomeResource($setting)), $this->successStatus);
    }

    public function get_logo()
    {
        $setting = SiteConfig::first();
        $msg = api_msg(request() , 'شعار التطبيق' ,'Application Logo');
        return response()->json(api_response(1 , $msg , ['logo' => $setting->logo_path]), $this->successStatus);
    }

    public function search()
    {
        $advertises = Advertise::query()->where('is_active', 1);
        if (request()->adv_type == "all") {
            $advertises = $advertises->get();
        }elseif (request()->adv_type == "public") {
            $advertises = $advertises->where('adv_type', 0)->get();
        }elseif (request()->adv_type == "specific") {
            $advertises = $advertises->where('adv_type', 1)->get();
        }elseif (request()->adv_type == "live") {
            $advertises = $advertises->where('adv_type', 2)->get();
        }
        if (isset(request()->filter) && request()->filter == 1) {
            if (request()->has("car_brand_id")) {
                $advertises = $advertises->where('car_brand_id', request()->car_brand_id);
            }
            if (request()->has("car_type_id")) {
                $advertises = $advertises->where('car_type_id', request()->car_type_id);
            }
            if (request()->has("car_model_id")) {
                $advertises = $advertises->where('car_model_id', request()->car_model_id);
            }
            if (request()->has("city_id")) {
                $advertises = $advertises->where('city_id', request()->city_id);
            }
        }
        $msg = api_msg(request() , 'المزادات' ,'Advertise');
        return response()->json(api_response(1 , $msg , AdvertisesHomeResources::collection($advertises)), $this->successStatus);
    }
}