<?php

namespace App\Components\Pages\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// Resources
use App\Components\Pages\Resources\Api\PagesResource;
// Models
use App\Components\Pages\Models\Page;

class PagesController extends Controller {

    public $successStatus = 200;
    public $errorStatus = 400;

    public function index()
    {
        $pages = Page::where('is_active', 1)->get();
        $msg = api_msg(request() , 'كل الصفحات' ,'All Pages');
        return response()->json(api_response( 1 , $msg , PagesResource::collection($pages)), $this->successStatus);
    }

    public function show($page)
    {
        $page = Page::where('id', $page)->where('is_active', 1)->firstOrFail();
        $msg = api_msg(request() , 'عرض الصفحة' ,'Show Page');
        return response()->json(api_response( 1 , $msg , new PagesResource($page)), $this->successStatus);
    }

    public function fallBack()
    {
        $msg = api_msg(request() , 'لا يوجد' ,'Not Fousnd!');
        return response()->json(api_response( 0 , $msg ), $this->errorStatus);
    }
}