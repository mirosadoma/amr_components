<?php

namespace App\Components\Cities\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Resources
use App\Components\Cities\Resources\Api\CitiesResources;
use Hash;
// Models
use App\Components\Cities\Models\City;

class CitiesController extends Controller {

    public $successStatus = 200;
    public $errorStatus = 422;

    public function cities(){
        $cities = City::all();
        $msg = api_msg($request , 'المدن' ,'Cities');
        return response()->json(api_response(1, $msg, CitiesResources::collection($cities)), $this->successStatus);
    }
}
