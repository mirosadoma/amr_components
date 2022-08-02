<?php

namespace App\Components\Notifications\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Models
use App\Models\User;
use Auth;

class NotificationsController extends Controller {

    public function notifications() {
        $allNotifications = Auth::user()->notifications;
        return view('Notifications_Site::notifications',get_defined_vars());
    }
}