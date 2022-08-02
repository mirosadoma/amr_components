<?php

namespace App\Components\Clients\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
// Resources
use App\Components\Clients\Resources\Api\ClientResources;
use App\Components\Clients\Resources\Api\ProfileResources;
use App\Components\Clients\Resources\Api\WalletHistoriesResources;
use App\Components\Advertises\Resources\Api\AdvertisesResources;
use Hash;
// Requests
use App\Components\Clients\Requests\Api\UserRatesRequest;
use App\Components\Clients\Requests\Api\UserUpdateApiRequest;
use App\Components\Clients\Requests\Api\NewPasswordRequest;
// Models
use App\Models\User;
use  App\Components\Clients\Models\WalletHistory;
use  App\Components\Clients\Models\UserRates;
use  App\Components\Advertises\Models\Advertise;

class ClientsController extends Controller {

    public $successStatus = 200;
    public $errorStatus = 422;

    public function get_profile(){
        $user = Auth::user();
        $my_advs = $user->advertises;
        $msg = api_msg(request() , 'عرض بياناتى' ,'Show My Data');
        return response()->json(api_response(1 , $msg , ['my_data' => new ProfileResources($user), 'my_advertises' => AdvertisesResources::collection($my_advs)]), $this->successStatus);
    }

    public function profile(UserUpdateApiRequest $request) {
        $data = $request->all();
        $user = Auth::user();
        if ($request->has('image') && !empty($data['image'])) {
            $data['image'] = imageUpload($request->image, 'users', [], false, true, $user->image);
        }else{
            unset($data['image']);
        }
        $user->update($data);
        DevToken($user->id,$request->dev_token, $request->dev_type);
        $msg = api_msg($request , 'تم تحديث البيانات بنجاح' ,'The data has been successfully updated');
        return response()->json(api_response( 1 , $msg , new ClientResources($user)), $this-> successStatus);
    }

    public function new_password(NewPasswordRequest $request){
        $user = Auth::user();
        if(!$user) {
            $user->update(['api_token' => generator_api_token()]);
            $msg = api_msg($request , 'المستخدم غير موجود' ,'User not found');
            return response()->json(api_response( 0 , $msg), $this-> errorStatus);
        }
        if (!Hash::check($request->old_password ,$user->password)) {
            $msg = api_msg($request , 'كلمة المرور القديمة غير متطابقة' ,'Old password does not match');
            return response()->json(api_response( 0 , $msg), $this-> errorStatus);
        }
        if ($request->password == $request->old_password) {
            $msg = api_msg($request , 'كلمة المرور القديمة والجديدة يجب أن لا يكونوا متماثلين' ,'Old and new password must not be the same');
            return response()->json(api_response( 0 , $msg), $this-> errorStatus);
        }
        $user->update(['password' => bcrypt($request->password)]);
        $msg = api_msg($request , 'تم إعادة تعيين كلمة المرور بنجاح' ,'successfully Reset Password');
        return response()->json(api_response( 1 , $msg, new ClientResources($user)), $this-> successStatus);
    }

    public function get_wallet(){
        $user = Auth::user();
        $msg = api_msg(request() , 'محفظتى' ,'My Wallet');
        $all_histories = WalletHistory::where('user_id', $user->id)->get();
        $add_histories = WalletHistory::where('user_id', $user->id)->where("type", "add")->get();
        $discount_histories = WalletHistory::where('user_id', $user->id)->where("type", "discount")->get();
        return response()->json(api_response(1 , $msg , [
            'wallet' => $user->wallet,
            'all_histories' => WalletHistoriesResources::collection($all_histories),
            'add_histories' => WalletHistoriesResources::collection($add_histories),
            'discount_histories' => WalletHistoriesResources::collection($discount_histories),
        ]), $this->successStatus);
    }

    public function recharge_wallet(Request $request){
        $validator = Validator::make($request->all(),[
            'balance'    => 'required|numeric|min:0',
        ]);
        if($validator->fails()){
            return response()->json(api_response(0 , $validator->errors()->first()), $this->errorStatus);
        }
        $user = Auth::user();
        $fatoora = myfatoorah($request->balance,url('api/wallet/'.$user->id.'/payment/success?balance='.$request->balance),url('api/wallet/'.$user->id.'/payment/error'),$user->name,$user->phone,$user->email);
        // return redirect($fatoora['paymentLink'].'?invoiceID='.$fatoora['invoiceId']);
        $msg = api_msg(request() , 'بيانات الشحن' ,'Charge Data');
        return response()->json(api_response( 1 , $msg , ['link' => $fatoora['paymentLink'].'?invoiceID='.$fatoora['invoiceId']] ), $this->successStatus);
    }

    public function success(Request $request, User $user){
        $balance = $request->balance;
        $wallet = $user->wallet + $balance;
        $user->update([
            'wallet'        => $wallet
        ]);
        WalletHistory::create([
            'user_id'       => $user->id,
            'balance'       => $balance,
            'type'          => 'add',
            'invoice_id'    => (int)$request->paymentId
        ]);
        return redirect()->route('payment_succes');
    }

    public function error(Request $request, User $user){
        return redirect()->route('payment_error');
    }

    public function rate_provider(UserRatesRequest $request, $provider){
        $user = Auth::user();
        $provider = User::where('id', $provider)->where('type', 'client')->where('id', '<>', $user->id)->first();
        if (!$provider) {
            $msg = api_msg($request , 'صاحب المزاد غير موجود' ,'Advirtise Owner Not Found');
            return response()->json(api_response(0 , $msg), $this->errorStatus);
        }
        UserRates::create([
            'client_id' => $user->id,
            'provider_id' => $provider->id,
            'value' => $request->value,
        ]);
        $msg = api_msg($request , 'تم تقييم صاحب المزاد' ,'Ratinng Advirtise Owner Done');
        return response()->json(api_response(0 , $msg), $this->errorStatus);
    }
}