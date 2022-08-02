<?php

namespace App\Components\Notifications\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Mail\SendNotification;
// Models
use App\Models\User;
use App\Components\Notifications\Models\AccountNotification;
use Notification;
use App\Models\Token;
// Requests
use App\Components\Notifications\Requests\Dashboard\StoreRequest;

class NotificationsController extends Controller {

    public function index() {
        if (!permissionCheck('notifications.view')) {
            return abort(403);
        }
        $PageTitle = __('All Notifications');
        $Breadcrumb = [
            [
                'name'  => $PageTitle,
                'route' => 'notifications.index',
            ],
        ];
        if (permissionCheck('sponsors.create')) {
            $Button = [
                'title' => __('Send Notification'),
                'route' =>  'notifications.create',
                'icon'  => 'plus'
            ];
        }

        $unreadNotifications = Auth::guard('admin')->user()->unreadNotifications;
        $latestFiveUnreadNotifications = Auth::guard('admin')->user()->unreadNotifications()->latest()->take(5)->get();
        $latestTenUnreadNotifications = Auth::guard('admin')->user()->unreadNotifications()->latest()->take(10)->get();
        $readNotifications = Auth::guard('admin')->user()->readNotifications;
        $allNotifications = Auth::guard('admin')->user()->notifications()->paginate();
        return view('Notifications_Dashboard::index',get_defined_vars());
    }

    public function show($id) {
        if (!permissionCheck('notifications.view')) {
            return abort(403);
        }
        $notification = Auth::guard('admin')->user()->notifications()->where('id', $id)->first();
        if (isset($notification)) {
            $notification->markAsRead();
            return redirect('app/' . $notification->data['url']);
        } else {
            return redirect()->route('app.notifications.index');
        }
    }

    public function markAllAsRead() {
        if (!permissionCheck('notifications.update')) {
            return abort(403);
        }
        Auth::guard('admin')->user()->unreadNotifications->markAsRead();
        return redirect()->back()->with('success', __("All notifications have been read successfully"));
    }

    public function create() {
        if (!permissionCheck('notifications.create')) {
            return abort(403);
        }
        $clients = User::where('is_active', 1)->where('type', '<>', 'admin')->get();
        return view('Notifications_Dashboard::create', get_defined_vars());
    }

    public function store(StoreRequest $request) {
        if (!permissionCheck('notifications.create')) {
            return abort(403);
        }
        if(in_array('all',$request->clients)){
            $clients = User::where('is_active', 1)->where('type', 'client')->get();
            foreach ($clients as $client) {
                // mail
                $data['message_ar'] = $request->ar['message'];
                $data['title_ar'] = $request->ar['title'];
                $data['message_en'] = $request->en['message'];
                $data['title_en'] = $request->en['title'];
                $data['user_name'] = $client->name;
                $data['logo'] = app_settings()->logo_path;
                $data['project_name'] = "أنا إيجابى";
                $data['home_link'] = route('home');
                try {
                    // hint send code to mail
                    Mail::to($client->email, $client->name)->send(new SendNotification($data));
                }catch (\Exception $e){
                    // return $e->getMessage();
                }
                //push notification
                $client_tokens = $client->fcm_token;
                if (app()->getLocale() == "ar") {
                    $client_data = [
                        'title'     => $request->ar['title'],
                        'message'   => $request->ar['message'],
                        'type'      => "home",
                    ];
                    push_send_desktop($client_tokens, $client_data);
                    Notification::send($client , new AccountNotification($request->ar['message'] , $request->en['message'], 'home','', $client_data));
                }else {
                    $client_data = [
                        'title'     => $request->en['title'],
                        'message'   => $request->en['message'],
                        'type'      => "home",
                    ];
                    push_send_desktop($client_tokens, $client_data);
                    Notification::send($client , new AccountNotification($request->en['message'] , $request->en['message'], 'home','', $client_data));
                }
            }
        }else{
            foreach ($request->clients as $client) {
                $client = User::find($client);
                // mail
                $data['message_ar'] = $request->ar['message'];
                $data['title_ar'] = $request->ar['title'];
                $data['message_en'] = $request->en['message'];
                $data['title_en'] = $request->en['title'];
                $data['user_name'] = $client->name;
                $data['logo'] = app_settings()->logo_path;
                $data['project_name'] = "أنا إيجابى";
                $data['home_link'] = route('home');
                try {
                    // hint send code to mail
                    Mail::to($client->email, $client->name)->send(new SendNotification($data));
                }catch (\Exception $e){
                    // return $e->getMessage();
                }
                //push notification
                $client_tokens = $client->fcm_token;
                if (app()->getLocale() == "ar") {
                    $client_data = [
                        'title'     => $request->ar['title'],
                        'message'   => $request->ar['message'],
                        'type'      => "home",
                    ];
                    push_send_desktop($client_tokens, $client_data);
                    Notification::send($client , new AccountNotification($request->ar['message'] , $request->en['message'], 'home','', $client_data));
                }else {
                    $client_data = [
                        'title'     => $request->en['title'],
                        'message'   => $request->en['message'],
                        'type'      => "home",
                    ];
                    push_send_desktop($client_tokens, $client_data);
                    Notification::send($client , new AccountNotification($request->en['message'] , $request->en['message'], 'home','', $client_data));
                }
            }
        }
        return redirect()->back()->with('success', __("Notification send successfully"));
    }

    public function update_status($id) {
        if (!permissionCheck('notifications.update')) {
            return abort(403);
        }
        $notification = Auth::guard('admin')->user()->notifications()->where('id', $id)->first();
        $notification->update(['read_at' => now()]);
        return redirect()->back()->with('success', __("Notification was read successfully"));
    }

    public function destroy($id) {
        if (!permissionCheck('notifications.delete')) {
            return abort(403);
        }
        Auth::guard('admin')->user()->notifications()->where('id', $id)->first()->delete();
        return redirect()->back()->with('success', __("notification deleted success"));
    }

    public function destroyAll() {
        if (!permissionCheck('notifications.delete')) {
            return abort(403);
        }
        if (Auth::guard('admin')->user()->notifications()->count()) {
            Auth::guard('admin')->user()->notifications()->delete();
            return redirect()->back()->with('success', __("All notifications deleted success"));
        } else {
            return redirect()->back();
        }
    }
}
