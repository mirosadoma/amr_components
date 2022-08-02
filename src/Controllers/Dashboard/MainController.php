<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Models
use App\Components\Settings\Models\SiteConfig;
use App\Models\Chat;
use App\Models\User;
use App\Components\Orders\Models\Order;

class MainController extends Controller {

    public function index() {
        // $setting = SiteConfig::first();
        // if(is_null($setting->chart_year)){
        //     $this_year = now()->year;
        // }else{
        //     $this_year = $setting->chart_year;
        // }
        // $orders = Order::query()->where('status', '<>', Order::STATUS_CART)->whereYear('created_at',$this_year)->get()->pluck('order_month')->toArray();
        // $order_counts = array_count_values($orders);
        // $all_monthes = ['1'=>__('January'), '2'=>__('February'), '3'=>__('March'), '4'=>__('April'), '5'=>__('May'), '6'=>__('June'), '7'=>__('July'), '8'=>__('August'), '9'=>__('September'), '10'=>__('October'), '11'=>__('November'), '12'=>__('December')];
        // $all_data = [];
        // foreach ($all_monthes as $key => $value) {
        //     $all_data[$key]['month'] = $value;
        //     $all_data[$key]['count'] = $order_counts[$key] ?? 0;
        // }
        // $years = range(1900, strftime("%Y", time()));
        return view('admin.index',get_defined_vars());
    }

    // public function get_year($year) {
    //     $setting = SiteConfig::first();
    //     $setting->update(['chart_year' => $year]);
    //     return true;
    // }

    public function maintenance() {
        return view('admin.maintenance',get_defined_vars());
    }

    // public function sendSms() {
    //     $VONAGE_API_KEY = "250c192b";
    //     $VONAGE_API_SECRET = "rqM5iiAEp6wQmg6w";
    //     $basic  = new \Vonage\Client\Credentials\Basic($VONAGE_API_KEY, $VONAGE_API_SECRET);
    //     $client = new \Vonage\Client($basic,[
    //         'base_api_url' => 'https://example.com'
    //     ]);

    //     $text = new \Vonage\SMS\Message\SMS("201276069689", 'Amr', 'The Message From Qariaty');
    //     $text->setClientRef('test-message');
    //     $response = $client->sms()->send($text);

    //     $message = $response->current();
    //     echo "Sent message to " . $message->getTo() . ". Balance is now " . $message->getRemainingBalance() . PHP_EOL;
    //     if ($message->getStatus() == 0) {
    //         echo "The message was sent successfully\n";
    //     } else {
    //         echo "The message failed with status: " . $message->getStatus() . "\n";
    //     }
    // }

    public function fast_trans(Request $request) {
        if (!permissionCheck('locales.create')) {
            return abort(403);
        }
        $data = [];
        foreach ($request->keys as $key => $value) {
            if (!is_null($value)) {
                $data[$key] = $value;
            }
        }
        if (!empty(request()->component)) {
            $file = json_decode(trim(file_get_contents(app_path() . '/Components/'.request()->component.'/Views/Lang/ar.json')));
            if (!file_exists(app_path() . '/Components/'.request()->component.'/Views/Lang/ar.json')) {
                $file = fopen(app_path() . '/Components/'.request()->component.'/Views/Lang/ar.json', 'w');
                fwrite($file, "{}");
            }
            $file = file_get_contents(app_path() . '/Components/'.request()->component.'/Views/Lang/ar.json');
            $file = json_decode($file, true);
            $file = json_encode(array_merge($data, $file), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            file_put_contents(app_path() . '/Components/'.request()->component.'/Views/Lang/ar.json', $file);
        }else{
            $file = json_decode(trim(file_get_contents(resource_path('lang/ar.json'))));
            if (!file_exists(resource_path('lang/ar.json'))) {
                $file = fopen(resource_path("lang/ar.json"), 'w');
                fwrite($file, "{}");
            }
            $file = file_get_contents(resource_path('lang/ar.json'));
            $file = json_decode($file, true);
            $file = json_encode(array_merge($data, $file), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            file_put_contents(resource_path('lang/ar.json'), $file);
        }
        return redirect()->back()->with('success', __('Data Saved Successfully'));
    }

}
