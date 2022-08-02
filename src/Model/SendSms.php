<?php

namespace App\Models;

use App\Notifications\AccountNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Notification;

class SendSms extends Model
{
    public static function Sendsms($RecepientNumber , $Message){
        if (app_sms()->package == "yamamah") {
            return self::Send4yamamah($RecepientNumber , $Message);
        }elseif (app_sms()->package == "jawaly") {
            return self::Send4jawaly($RecepientNumber , $Message);
        }
    }
    public static function Send4yamamah($RecepientNumber , $Message)
    {
        // if( !empty(env("SMS_USERNAME")) &&  !empty(env("SMS_PASSWORD")) && !empty(env("SMS_TAGNAME")) ){
            $response = Http::post('http://api.yamamah.com/SendSMSV3', [
                "Username"          => app_sms()->username ?? env("SMS_USERNAME"),
                "Password"          => app_sms()->password ?? env("SMS_PASSWORD"),
                "Tagname"           => app_sms()->tagname ?? env("SMS_TAGNAME"),
                "RecepientNumber"   => $RecepientNumber,
                "VariableList"      => "0",
                "ReplacementList"   => "",
                "Message"           => $Message ,
                "SendDateTime"      => "0",
                "EnableDR"          => false,
                "SentMessageID"     => true
            ]);
            $response = json_decode($response)  ;
            $result['status'] = $response->Status;
            $result['StatusDescription'] = $response->StatusDescription;;
            if($response->Status == 40 ){
                $notify_ar = 'تم إنتهاء رصيد باقة الرسائل يرجي التجديد';
                $notify_en = 'The SMS bundle balance has expired. Please renew';
                Notification::send(app_admins() , new AccountNotification( $notify_ar , $notify_en,'settings' , '' ));
                $result['ar'] = $notify_ar;
                $result['en'] = $notify_en;
            }else{
                $result['ar'] = 'تم ارسال الرسالة بنجاح';
                $result['en'] = 'SMS Sent Successfully';
            }
            return $result;
        // }
    }

    public static function Balance4yamamah(){
        $response = Http::post('http://api.yamamah.com/GetCredit/'.app_sms()->username ?? env("SMS_USERNAME").'/'.app_sms()->password ?? env("SMS_PASSWORD"));
        $response = json_decode($response)  ;
        if ( isset($response->GetCreditPostResult)){
            $credit = $response->GetCreditPostResult->Credit;
        }else {
            $credit = 0;
        }
        return $credit;
    }

    public static function Send4jawaly($RecepientNumber , $Message )
    {
        // if( !empty(env("SMS_USERNAME")) &&  !empty(env("SMS_PASSWORD")) && !empty(env("SMS_TAGNAME")) ){
            $response = Http::get('http://4jawaly.net/api/sendsms.php?username='.env("SMS_USERNAME").
                '&password='.app_sms()->password ?? env("SMS_PASSWORD").
                '&sender='.app_sms()->tagname ?? env("SMS_TAGNAME").
                '&numbers='.$RecepientNumber.
                '&message='.$Message.
                '&unicode=e'.
                '&Rmduplicated=0'.
                '&return=Json'
            );
            $response = json_decode($response)  ;
            if($response == 105 ){
                $notify_ar = 'تم إنتهاء رصيد باقة الرسائل يرجي التجديد';
                $notify_en = 'The SMS bundle balance has expired. Please renew';
                Notification::send(app_admins() , new AccountNotification( $notify_ar , $notify_en,'settings' , '' ));
                $result['ar'] = $notify_ar;
                $result['en'] = $notify_en;
            }elseif($response == 100 ){
                $result['ar'] = 'تم ارسال الرسالة بنجاح';
                $result['en'] = 'SMS Sent Successfully';
            }else{
                $result['ar'] = 'هناك خطأ في البيانات';
                $result['en'] = 'There is an error in the data';
            }
            return $result;
        // }
    }

    public static function Balance4jawaly(){
        // if( !empty(env("SMS_USERNAME")) &&  !empty(env("SMS_PASSWORD")) ){
            $response = Http::get('http://4jawaly.net/api/getbalance.php?username='.env("SMS_USERNAME").
                '&password='.env("SMS_PASSWORD").
                // '&hangedBalance=true'.
                '&return=Json'
            );
            $response = json_decode($response)  ;
        // }else{
        //     $response = 0 ;
        // }
        return $response;
    }
}