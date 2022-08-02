<?php

namespace App\Components\Notifications\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// Resources
use App\Components\Notifications\Resources\Api\NotificationsResource;

class NotificationsController extends Controller {

    public $successStatus = 200;
    public $errorStatus = 400;

    public function notifications()
    {
        $user = Auth::user();
        $notifications = $user->notifications->toArray();
        $user->notifications->markAsRead();
        $msg = api_msg(request() , 'كل الإشعارات' ,'All notifications');
        return response()->json(api_response( 1 , $msg , NotificationsResource::collection($notifications)), $this-> successStatus);
    }

    public function check_notifications()
    {
        $unreadNotifications = Auth::user()->unreadNotifications->count();
        if($unreadNotifications == 0){
            $msg = api_msg(request() , 'لا توجد إشعارات جديدة' ,'No notifications new found');
            $data = "false";
        }else{
            $msg = api_msg(request() , 'يوجد إشعارات جديدة' ,'Notifications new found');
            $data = "true";
        }
        return response()->json(api_response( 1 , $msg, $data), $this-> successStatus);
    }
    
    public function deleteNotifications(Request $request , $id)
    {
        Auth::user()->notifications()->where('data->notify_id', $id)->firstOrFail()->delete();
        $msg = api_msg($request , 'تم حذف الإشعار بنجاح' ,'The notification has been successfully deleted');
        return response()->json(api_response( 1 , $msg ), $this-> successStatus);
    }
}
