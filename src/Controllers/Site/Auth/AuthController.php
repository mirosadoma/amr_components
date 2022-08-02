<?php

namespace App\Http\Controllers\Site\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Site\Auth\SigninPanelRequest;
use App\Http\Requests\Site\Auth\SignUpPanelRequest;
use App\Http\Requests\Site\Auth\ForgetPanelRequest;
use App\Http\Requests\Site\Auth\ResetPanelRequest;
use App\Http\Requests\Site\Auth\VerficationPanelRequest;
// Models
use App\Components\Cities\Models\City;
use App\Models\User;
use App\Components\Notifications\Models\AccountNotification;
use Notification;
use Auth;
use App\Models\SendSms;
use Hash;
use Mail;
use App\Mail\SendMail;
use App\Mail\SendCode;

class AuthController extends Controller {

    public function loginPage() {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('site.auth.login');
    }

    public function loginAuth(SigninPanelRequest $request) {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        if (is_numeric($request->phone_email)) {
            $user = User::wherePhone($request->phone_email)->first();
        }elseif (filter_var($request->phone_email, FILTER_VALIDATE_EMAIL)) {
            $user = User::whereEmail($request->phone_email)->first();
        }
        if($user && $user->deleted_at){
            return redirect()->route('site.login')->with('error',__('You Deleted By Adminstratore'));
        }
        if($user && $user->is_active != 1){
            return redirect()->route('site.login')->with('error',__('You Are Not Active From Administrator'));
        }
        $key = "";
        if (is_numeric($request->phone_email)) {
            $key = "phone";
        }elseif (filter_var($request->phone_email, FILTER_VALIDATE_EMAIL)) {
            $key = "email";
        }
        $credentials = [
            $key                => $request->phone_email,
            'password'          => $request->password,
        ];
        if(Auth::attempt($credentials)){
            return redirect()->intended('/')->with('success',__('Login has been successfully'));
        }else{
            return redirect()->back()->with('error',__(ucwords($key).' Or Password Is incorrect, please try again'));
        }
    }

    public function signupPage() {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        $cities = City::all();
        return view('site.auth.signup', get_defined_vars());
    }

    public function signupAuth(SignUpPanelRequest $request) {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        $data = $request->all();
        $generator_verification_code = generator_verification_code();
        if ($request->has('code') && !empty($request->code)) {
            $user = User::where('type', 'practicer')->where('code', $request->code)->first();
            if ($user) {
                $data['parent_id']      = $user->id;
                $data['type']           = 'positive';
                unset($data['code']);
                $data['is_active']          = 1;
                $data['password']           = bcrypt($request->password);
                $data['verification_code']  = $generator_verification_code;
                $user_create = User::create($data);
                //push notification
                $tokens = $user->fcm_token;
                $notif_data = [
                    'title'     => __("Notification"),
                    'message'   => __("A new positive has been added for you"),
                    'type'      => "practicers/profile/positives",
                ];
                push_send_desktop($tokens, $notif_data);
                // Notifications
                Notification::send($user , new AccountNotification("تمت إضافة إيجابي جديد لك" , "A new positive has been added for you", 'practicers/profile/positives','', $notif_data));
            }else{
                return redirect()->back()->with('error',__('Code IS Rong'));
            }
        }else{
            $data['type']               = 'client';
            $data['is_active']          = 1;
            $data['password']           = bcrypt($request->password);
            $data['verification_code']  = $generator_verification_code;
            $user_create = User::create($data);
        }
        $data['logo'] = app_settings()->logo_path;
        $data['project_name'] = "أنا إيجابى";
        $data['home_link'] = route('home');
        $data['user_name'] = $user_create->name;
        $data['verification_code'] = $generator_verification_code;
        if (isset($user_create->email)) {
            try {
                Mail::to($user_create->email, $user_create->name)->send(new SendCode($data));
            } catch (\Throwable $th) {
                // throw $th;
            }
            Auth::login($user_create);
            return redirect()->route('site.verification_code')->with('success', __("Message has been sent to your email"));
        }else {
            Auth::login($user_create);
            return redirect()->back()->with('error', __("Sending Faild"));
        }
        Auth::login($user_create);
        return redirect()->route('site.verification_code')->with('success',__('Registered Successfully'));
    }

    public function verification_codePage() {
        return view('site.auth.verification_code');
    }

    public function verfy_code(VerficationPanelRequest $request) {
        if (Auth::user()->verification_code != $request->verification_code) {
            return redirect()->back()->with('error',__('Code Is Not Correct'));
        }else{
            Auth::user()->update(['email_verified_at'=>now()]);
            return redirect()->route('home')->with('success',__('Verified successfully'));
        }
    }

    public function resend_codePage() {
        
        $generator_verification_code = generator_verification_code();
        Auth::user()->update(['verification_code'=>$generator_verification_code]);
        $data['logo'] = app_settings()->logo_path;
        $data['project_name'] = "أنا إيجابى";
        $data['home_link'] = route('home');
        $data['user_name'] = Auth::user()->name;
        $data['verification_code'] = $generator_verification_code;
        if (isset(Auth::user()->email)) {
            try {
                Mail::to(Auth::user()->email, Auth::user()->name)->send(new SendCode($data));
            } catch (\Throwable $th) {
                // throw $th;
            }
            return redirect()->back()->with('success', __("Code resent to your email"));
        }else {
            return redirect()->back()->with('error', __("Sending Faild"));
        }
    }

    public function forgetPage()
    {
        return view('site.auth.forget', get_defined_vars());
    }

    public function forgetAuth(ForgetPanelRequest $request)
    {
        if (is_numeric($request->phone_email)) {
            $user = User::wherePhone($request->phone_email)->first();
            DevToken($user->id,$request->dev_token, $request->dev_type);
            $msg_send = api_msg($request , 'رقم التأكيد هو  ' ,'Verfication Code Is  ');
            try {
                SendSms::Sendsms($user->phone, $msg_send. $user->verification_code);
            } catch (\Throwable $th) {
                //throw $th;
            }
            return redirect()->back()->with('success', "تم إرسال رسالة إلى هاتفك");
        }elseif (filter_var($request->phone_email, FILTER_VALIDATE_EMAIL)) {
            $token = \Illuminate\Support\Str::random(60);
            $user = User::whereEmail($request->phone_email)->first();
            $to_email = $user->email;
            $checktoken = \DB::table('password_resets')->where('email', $to_email)->first();
            if($checktoken){
                \DB::table('password_resets')->where('email', $to_email)->update([
                    'email' => $to_email,
                    'token' => $token,
                ]);
            }else{
                \DB::table('password_resets')->insert([
                    'email' => $to_email,
                    'token' => $token,
                ]);
            }
            $data['link'] = route('site.reset_password', $token);
            $data['user_name'] = $user->name;
            $data['logo'] = app_settings()->logo_path;
            $data['project_name'] = "أنا إيجابى";
            $data['home_link'] = route('home');
            if (isset($to_email)) {
                try {
                    Mail::to($to_email, $user->name)->send(new SendMail($data));
                } catch (\Throwable $th) {
                    // throw $th;
                }
                return redirect()->back()->with('success', __("Message has been sent to your email"));
            }else {
                return redirect()->back()->with('error', __("Sending Faild"));
            }
        }
    }

    public function reset_passwordPage($token)
    {
        $token = \DB::table('password_resets')->where('token', 'LIKE', '%' . $token. '%')->first();
        if($token){
            return view('site.auth.reset_password', get_defined_vars());
        }else {
            abort(404, 'Token Expired');
        }
    }

    public function reset_passwordAuth(ResetPanelRequest $request)
    {
        $token = \DB::table('password_resets')->where('token', 'LIKE', '%' . $request->token. '%')->first();
        $user = User::where('email', $token->email)->first();
        $user->update([
            'password' => bcrypt($request->password)
        ]);
        return redirect()->route('site.login')->with('success', __("Change Password Success Please Login Now"));
    }

    public function logout() {
        Auth::user()->update(['fcm_token'=>Null]);
        Auth::logout();
        return redirect()->route('home')->with('success',__('LogOut has been successfully'));
    }
}