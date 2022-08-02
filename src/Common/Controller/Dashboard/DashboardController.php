<?php

namespace Amr\AmrComponents\Common\Controller\Dashboard;

use Illuminate\Http\Request;
use Amr\AmrComponents\Controller;

class DashboardController extends Controller {

    public function index() {
        return view('DCommon::index', get_defined_vars());
    }

    public function profile() {
        return view('DCommon::profile', get_defined_vars());
    }

    public function profile_update() {
        return redirect()->back();
    }

}
