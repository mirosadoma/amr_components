<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//models
use App\Components\Banners\Models\Banner;

class MainController extends Controller {

    public function index() {
        $banners = Banner::where('is_active', 1)->get();
        return view('site.index',get_defined_vars());
    }
}
