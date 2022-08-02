<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// Requests
use App\Components\Clients\Requests\Api\RegisterRequest;
use App\Components\Clients\Requests\Api\LoginRequest;
use App\Components\Clients\Requests\Api\ResendCodeRequest;
use App\Components\Clients\Requests\Api\CheckRequest;
use App\Components\Clients\Requests\Api\NewPasswordRequest;
use App\Components\Clients\Requests\Api\ForgetRequest;
use App\Components\Clients\Requests\Api\ResetRequest;
// Resources
use App\Components\Clients\Resources\Api\ClientResources;
// Models
use App\Models\SendSms;
use App\Models\User;
use Hash;

class AuthController extends Controller {

    public $successStatus = 200;
    public $errorStatus = 422;

    public function login(LoginRequest $request)
    {
        $user = User::wherePhone($request->phone)->first();

        if(!$user) {
            $msg = api_msg($request , 'المستخدم غير موجود' ,'The user not found');
            return response()->json(api_response( 0 , $msg ), $this->errorStatus);
        }
        if($user->is_active == 0) {
            $user->update(['api_token' => generator_api_token()]);
            $msg = api_msg($request , 'هذا المستخدم غير مفعل' ,'This user not active');
            return response()->json(api_response( 1 , $msg , new ClientResources($user)), $this-> successStatus);
        }
        if(Auth::attempt(['phone' => request('phone'), 'password' => request('password')])){
            $user = Auth::user();
            $user->update(['api_token' => generator_api_token()]);
            DevToken($user->id,$request->dev_token, $request->dev_type);
            $msg = api_msg($request , 'تم تسجيل الدخول بنجاح' ,'You are logged in successfully');
            return response()->json(api_response( 1 , $msg , new ClientResources($user)), $this-> successStatus);
        }else{
            $msg = api_msg($request , 'بيانات الدخول غير صحيحة' ,'The login information is incorrect');
            return response()->json(api_response( 0 , $msg ), $this->errorStatus);
        }
    }

    public function register(RegisterRequest $request)
    {
        $info = [
            'name'              =>  $request->name,
            'email'             =>  $request->email,
            'phone'             =>  $request->phone,
            'password'          =>  bcrypt($request->password),
            'is_active'         =>  0,
            'verification_code' =>  generator_verification_code(),
            'api_token'         =>  generator_api_token()
        ];
        if ($request->has('image') && !empty($request->image)) {
            $info['image'] = imageUpload($request->image, 'users');
        }
        $user = User::create($info);
        DevToken($user->id,$request->dev_token, $request->dev_type);
        $msg_send = api_msg($request , 'رقم التأكيد هو  ' ,'Verfication Code Is  ');
        SendSms::Sendsms($user->phone, $msg_send. $user->verification_code);
        $msg = api_msg($request , 'تم استلام بياناتك من فضلك قم بتأكيد رقم الهاتف' ,'Your data has been received, please confirm the phone number');
        return response()->json(api_response( 1 , $msg), $this->successStatus);
    }
    
    public function resend_code(ResendCodeRequest $request)
    {
        $user = User::wherePhone($request->phone)->first();
        if(!$user) {
            $msg = api_msg($request , 'المستخدم غير موجود' ,'The user not found');
            return response()->json(api_response( 0 , $msg ), $this->errorStatus);
        }
        $verification_code = generator_verification_code();
        $user->update(['verification_code' => $verification_code]);
        $msg_send = api_msg($request , 'رقم التأكيد هو  ' ,'Verfication Code Is  ');
        SendSms::Sendsms($user->phone, $msg_send. $user->verification_code);
        $msg = api_msg($request , 'تم إعادة إرسال كود التفعيل بنجاح' ,'The activation code has been successfully sent back');
        return response()->json(api_response(1 , $msg), $this->successStatus);
    }

    public function check(CheckRequest $request)
    {
        $user = User::wherePhone($request->phone)->first();
        if(!$user) {
            $msg = api_msg($request , 'المستخدم غير موجود' ,'The user not found');
            return response()->json(api_response(0 , $msg), $this->errorStatus);
        }
        if($user->verification_code == $request->verification_code){
            $user->update([
                'phone_verified_at' => Carbon::now(),
                'is_active' => 1,
                ]);
            $msg = api_msg($request , 'تم تأكيد كود التفعيل بنجاح' ,'The activation code has been confirmed successfully');
            return response()->json(api_response(1 , $msg , new ClientResources($user)), $this->successStatus);
        }
        else{
            $msg = api_msg($request , 'كود التفعيل غير صحيح' ,'invalid verification code');
            return response()->json(api_response(0 , $msg), $this->errorStatus);
        }
    }

    public function forget(ForgetRequest $request)
    {
        $user = User::wherePhone($request->phone)->first();
        if(!$user) {
            $msg = api_msg($request , 'المستخدم غير موجود' ,'The user not found');
            return response()->json(api_response( 0 , $msg ), $this->errorStatus);
        }
        $verification_code = generator_verification_code();
        $user->update(['verification_code' => $verification_code]);
        $msg_send = api_msg($request , 'رقم التأكيد هو  ' ,'Verfication Code Is  ');
        SendSms::Sendsms($user->phone, $msg_send. $user->verification_code);
        $msg = api_msg($request , 'تم إرسال كود التفعيل بنجاح' ,'Activation code has been sent successfully');
        return response()->json(api_response( 1 , $msg), $this->successStatus);
    }

    public function reset(ResetRequest $request)
    {
        $user = User::wherePhone($request->phone)->first();
        if(!$user) {
            $msg = api_msg($request , 'المستخدم غير موجود' ,'The user not found');
            return response()->json(api_response( 0 , $msg ), $this->errorStatus);
        }
        $user ->update([
            'password' => bcrypt($request->password),
        ]);
        $msg = api_msg($request , 'تم إعادة تعيين كلمة المرور بنجاح' ,'successfully Reset Password');
        return response()->json(api_response( 1 , $msg), $this-> successStatus);
    }
}
