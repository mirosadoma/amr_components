<?php

namespace App\Components\Banners\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Resources
use App\Components\Banners\Resources\Api\BannersResources;
use Hash;
// Models
use App\Components\Banners\Models\Banner;

class BannersController extends Controller {

    public $successStatus = 200;
    public $errorStatus = 422;

    public function banners(){
        $banners = Banner::all();
        $msg = api_msg($request , 'البانرات' ,'Banners');
        return response()->json(api_response(1, $msg, BannersResources::collection($banners)), $this->successStatus);
    }
}
