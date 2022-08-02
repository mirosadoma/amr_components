<?php

namespace Amr\AmrComponents\Common\Controller\Dashboard;

use Amr\AmrComponents\Controller;
use Illuminate\Support\Facades\Auth;

class Logout extends Controller {

    public function __invoke() {
        Auth::logout();
        return redirect()->route('home');
    }

}
