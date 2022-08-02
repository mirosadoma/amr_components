<?php

if (!function_exists('vue_srcs')) {
    function vue_srcs()
    {
        echo <<<HTML
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.11/lodash.min.js"></script>
HTML;
    }
}

if (!function_exists('assetAdmin')) {
    function assetAdmin($value, $type = 'css')
    {
        return ($type == 'css') ? '<link href="' . asset('assets/admin/' . $value) . '" rel="stylesheet" type="text/css">' : '<script src="' . asset('assets/admin/' . $value) . '"></script>';
    }
}

if (!function_exists('_fixDirSeparator')) {
    function _fixDirSeparator($path)
    {
        return str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $path);
    }
}

if (!function_exists('displayErrorMessage')) {
    function displayErrorMessage($errors, $name, $input = false, $class = false)
    {

        if (strpos($name, '[') !== false) {
            $name = str_replace("[", ".", substr($name, 0, -1));
        }


        if ($errors->has($name)) {

            if ($input) {
                return 'style="border: 1px solid red;"';
            } else if ($class) {
                return 'has-error has-feedback';
            } else {
                return "<div class='form-control-feedback'><i class='icon-cancel-circle2'></i></div><span class='help-block'>" . $errors->first($name) . "</span>";
            }
        }
    }
}

// if (!function_exists('get_array_from_model')) {
//     function get_array_from_model($info)
//     {
//         if(count($info)){
//             $model      = new $info[0];
//             $function   = $info[1];
//             return $model::$function();
//             // return $model::$function();
//         }else{
//             return [];
//         }
//     }
// }

if (!function_exists('SELECTINPUT')) {
    function SELECTINPUT($name, $label, $info, $value = '', $errors, $multiple)
    {
        $multiple = $multiple === true ? "multiple" : "";
        // $lists = get_array_from_model($info);
        $return  = '<div class="form-group row ' . displayErrorMessage($errors, $name, false, true) . '">
            <label for="profile-' . $name . '" class="control-label col-lg-2">' . __($label) . '</label>
            <div class="col-lg-10">
                <select id="profile-' . $name . '" ' . displayErrorMessage($errors, $name, true) . ' class="form-control" name="' . $name . '" ' . $multiple . ' ">
                    ';
        if ($value == '') {
            $return  .= '<option selected value="0">' . __('Choose') . '</option>';
        } else {
            $return  .= '<option value="0">' . __('Choose') . '</option>';
        }
        foreach ($info as $key => $list) {
            if (is_numeric($key)) {
                $value_id = $list->id;
                $value_name = $list->name;
                $selected = ($value == $value_id) ? "selected" : "";
            }else{
                $value_id = $key;
                $value_name = $list;
                $selected = ($value == $list) ? "selected" : "";
            }
            $return  .= '<option ' . $selected . ' value="' . $value_id . '">' . $value_name . '</option>';
        }
        $return  .= '</select>' . displayErrorMessage($errors, $name) . '</div></div>';
        return $return;
    }
}

if (!function_exists('inputForm')) {
    function inputForm($name, $label, $type = 'text', $value = '', $errors, $editor = false, $autocomplete = "off", $id_name = '')
    {
        if ($type == 'password') {
            $value = '';
        }
        if ($type == 'textarea') {
            // $summernote = $editor  ? 'summernote' : '';
            $editor = $editor  ? $id_name : '';
            return '<div class="form-group row' . displayErrorMessage($errors, $name, false, true) . '">'.TextArea($name, $label, 'form-control', old($name, $value), true, $editor) . displayErrorMessage($errors, $name) . '</div>';
        }
        $value = ($type == 'date' && $value) ? date('Y-m-d',strtotime($value)) : $value;
        return '<div class="form-group row ' . displayErrorMessage($errors, $name, false, true) . '">'.Inputs($type, $name, $label, 'form-control', old($name, $value)) . displayErrorMessage($errors, $name) . '</div>';
    }
}

if (!function_exists('get_client_ip')) {
    function get_client_ip() {
        $ip = $_SERVER['REMOTE_ADDR'];
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        return $ip;
    }
}

if (!function_exists('getTimeZoneFromIpAddress')) {
    function getTimeZoneFromIpAddress(){
        $clientsIpAddress = get_client_ip();
        $curlSession = curl_init();
        curl_setopt($curlSession, CURLOPT_URL, 'http://ip-api.com/json/' . $clientsIpAddress);
        curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

        $ipInfo = json_decode(curl_exec($curlSession));
        curl_close($curlSession);

      	// $ipInfo = file_get_contents('http://ip-api.com/json/' . $clientsIpAddress);
        // $ipInfo = json_decode($ipInfo);
        return $timezone = $ipInfo->timezone;
    }
}

if (!function_exists('getMyDateZone')) {
    function getMyDateZone($date){
        if (request()->headers->has('Timezone')) {
            $my_timezone = request()->header('Timezone');
        }else {
            $my_timezone = getTimeZoneFromIpAddress();
        }
        $default_timezone = date_default_timezone_get();
        if($my_timezone != $default_timezone){
            $date->timezone($my_timezone);
        }
        return $date;
    }
}

if (!function_exists('generatString')) {
    function generatString($string)
    {
        $string = Illuminate\Support\Str::slug($string, "_");
        return '@'.$string.'_'.random_int(1000000, 9999999);
    }
}

if (!function_exists('generator_verification_code')) {
    function generator_verification_code() {
        return random_int(100000, 999999);
        // return 123456;
    }
}

if (!function_exists('table_width_head')) {
    function table_width_head($count)
    {
        return "style=\"text-align:right;width: calc({$count} * 25px);\"";
    }
}

if (!function_exists('editSeparator')) {
    function editSeparator($path)
    {
        return str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $path);
    }
}

if (!function_exists('app_languages')) {
    function app_languages()
    {
        $languages = config('laravellocalization.supportedLocales');
        return $languages;
    }
}
if (!function_exists('permissionCheck')) {
    function permissionCheck($permission)
    {
        if (\Auth::guard('admin')->user() && \Auth::guard('admin')->user()->roles->first() && \Auth::guard('admin')->user()->roles->first()->permissions) {
            return in_array($permission,\Auth::guard('admin')->user()->roles->first()->permissions->pluck('name')->toArray());
        }else {
            return false;
        }
    }
}

if (!function_exists('PushNotifcation')) {
    function PushNotifcation($device_token, $data)
    {
        $fields = [
            'registration_ids' => (is_array($device_token)) ? $device_token : [$device_token],
            'notification' => [
                'title'         => $data['title']??'',
                'body'          => $data['message']??'',
                // 'tickerText'    => '',
                'vibrate'       => '1',
                'badge'         => '1',
                'sound'         => 'default',
            ],
            'data'          => [
                'type'          => $data['type']??'',
                'adv_id'        => $data['adv_id']??'',
                'price'         => $data['price']??'',
                'transfer_id'   => $data['transfer_id']??'',
                'icon'          => app_settings()->logo_path??'',
            ],
        ];
        $headers = [
            'Authorization: key=' . env('FCM_SERVER_KEY'),
            'Content-Type: application/json'
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}

if (!function_exists('push_send')) {
    function push_send($data = ['title'=>'','message'=>''],$tokens = []) {
        $pp = [];
        if(count($tokens) > 500) {
            $arrays = array_chunk($tokens,500);
            foreach($arrays as $array) {
              $pp[] = PushNotifcation($array, $data , 1);
            }
        } else {
            $arrays = $tokens;
        }
        if(!empty($arrays)) {
            $pp[] = PushNotifcation($arrays, $data , 1);
        }
        return $pp;
    }
}

if (!function_exists('PushDeskTopNotifcation')) {
    function PushDeskTopNotifcation($device_token, $data)
    {
        $fields = [
            'registration_ids' => (is_array($device_token)) ? $device_token : [$device_token],
            'data' => [
                'type'              => $data['type']??'',
                'type_id'           => $data['type_id']??'',
            ],
            'notification' => [
                'title'             => $data['title']??'',
                'body'              => $data['message']??'',
                'sound'             => 'default',
                'content-available' => 1,
                'icon'              => app_settings()->logo_path??'',
            ],
        ];
        $headers = [
            'Authorization: key=' . env('FCM_SERVER_KEY'),
            'Content-Type: application/json'
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}

if (!function_exists('push_send_desktop')) {
    function push_send_desktop($tokens = [], $data = ['title'=>'','message'=>'']) {
        $pp = [];
        if(is_array($tokens) && count($tokens) > 500) {
            $arrays = array_chunk($tokens,500);
            foreach($arrays as $array) {
              $pp[] = PushDeskTopNotifcation($array, $data , 1);
            }
        } else {
            $arrays = $tokens;
        }
        if(!empty($arrays)) {
            $pp[] = PushDeskTopNotifcation($arrays, $data , 1);
        }
        return $pp;
    }
}

if (!function_exists('getReports')) {
    function getReports()
    {
        $glob = glob(app_path() . '/Components/**/Views/Dashboard/resourses/main.php');
        $f = collect($glob)->groupBy(
            function ($el) {
                return pathinfo($el)['filename'];
            }
        );
        $f->transform(
            function ($item) {
                $data = [];
                foreach ($item as $value) {
                    $data[] = include $value;
                }
                return collect(array_filter($data));
            }
        );
        $array = [];
        foreach($f->get('main') as $val) {
            if(count($val) < 6){
                foreach ($val as $v) {
                    array_push($array, $v);
                }
            }else{
                array_push($array, $val);
            }
        }
        return $array;
    }
}

if (!function_exists('admin_can_any')) {
    function admin_can_any($table)
    {
        $user_permissions = \Auth::guard('admin')->user()->getPermissionsViaRoles()->pluck('name')->toArray();
        $ch = 'false';
        foreach ($user_permissions as $value) {
            if(str_contains($value, $table)){
                $ch = 'true';
            }
        }
        return $ch;
    }
}
if (!function_exists('admin_can_item')) {
    function admin_can_item($table, $val)
    {
        $user_permissions = \Auth::guard('admin')->user()->getPermissionsViaRoles()->pluck('name')->toArray();
        $ch = 'false';
        foreach ($user_permissions as $value) {
            if($value == $table.'.'.$val){
                $ch = 'true';
            }
        }
        return $ch;
    }
}

if (!function_exists('getTopNavbar')) {
    function getTopNavbar()
    {
        $glob = glob(app_path() . '/Components/**/Views/Dashboard/resourses/top.php');
        $f = collect($glob)->groupBy(
            function ($el) {
                return pathinfo($el)['filename'];
            }
        );
        $f->transform(
            function ($item) {
                $data = [];
                foreach ($item as $value) {
                    $data[] = include $value;
                }
                return collect(array_filter($data));
            }
        );
        $array = [];
        foreach($f->get('top') as $val) {
            if(count($val) < 4){
                foreach ($val as $v) {
                    array_push($array, $v);
                }
            }else{
                array_push($array, $val);
            }
        }
        return $array;
    }
}

if (!function_exists('getRightNavbar')) {
    function getRightNavbar()
    {
        $glob = glob(app_path() . '/Components/**/Views/Dashboard/resourses/rightNavbar.php');
        $f = collect($glob)->groupBy(
            function ($el) {
                return pathinfo($el)['filename'];
            }
        );
        $f->transform(
            function ($item) {
                $data = [];
                foreach ($item as $value) {
                    $data[] = include $value;
                }
                return collect(array_filter($data));
            }
        );
        $orderNum = $f->get('rightNavbar')->toArray();
        $checkRoles = [];
        foreach ($orderNum as $value) {
            array_push($checkRoles, $value);
        }
        $array = bubbleSort($checkRoles);
        return $array;
    }
}

if (!function_exists('bubbleSort')) {
    function bubbleSort($array)
    {
        if (!$length = count($array)) {
            return $array;
        }
        for ($outer = 0; $outer < $length; $outer++)
        {
            for ($inner = 0; $inner < $length; $inner++)
            {
                if ($array[$outer]['order'] < $array[$inner]['order'])
                {
                    $tmp = $array[$outer];
                    $array[$outer] = $array[$inner];
                    $array[$inner] = $tmp;
                }
            }
        }
        return $array;
    }
}

if (!function_exists('layout_data')) {
    function layout_data()
    {
        static $config = null;
        if ($config == null) {
            $config = \App\Components\Settings\Models\SiteConfig::first();
        }
        $data['config'] = $config;
        $data = (object) $data;
        return $data;
    }
}

if (!function_exists('DevToken')) {
    function DevToken($user_id,$dev_token, $dev_type) {
        $check = \App\Models\Token::where([
            'user_id'           => $user_id,
            'device_token'      => $dev_token,
            'device_type'       => $dev_type,
        ])->first();
        if(is_null($check)) {
            \App\Models\Token::create([
                'user_id'           => $user_id,
                'device_token'      => $dev_token,
                'device_type'       => $dev_type,
            ]);
        }
    }
}

if (!function_exists('generator_api_token')) {
    function generator_api_token()
    {
        $random = \Illuminate\Support\Str::random(60);
        $check = App\Models\User::where(['api_token' => $random])->first();
        if (!is_null($check)) {
            generator_api_token();
        }
        return $random;
    }
}
if (!function_exists('contactTypes')) {
    function contactTypes()
    {
        return [
            'email' => 'البريد الإلكترونى',
            'phone' => 'الهاتف',
            'mobile' => 'الجوال',
            'fax' => 'الفاكس',
            'mail' => 'صندوق البريد',
            'address' => 'العنوان',
            'whats' => 'واتس اب',
            'facebook' => 'فيس بوك',
            'twitter' => 'تويتر',
            'google' => 'جوجل بلس',
            'youtube' => 'يوتيوب',
            'instagram' => 'انستجرام',
            'linkedin' => 'لينك ان',
            'snapchat-ghost' => 'سناب شات'
        ];
    }
}

if (!function_exists('contactIcons')) {
    function contactIcons()
    {
        return [
            'email' => 'fas fa-envelope',
            'phone' => 'fas fa-phone',
            'mobile' => 'fas fa-mobile-alt',
            'fax' => 'fas fa-fax',
            'mail' => 'fas fa-envelope',
            'address' => 'fas fa-map-marker-alt',
            'whats' => 'fab fa-whatsapp',
            'facebook' => 'fab fa-facebook',
            'twitter' => 'fab fa-twitter',
            'google' => 'fab fa-google-plus-g',
            'youtube' => 'fab fa-youtube',
            'instagram' => 'fab fa-instagram',
            'linkedin' => 'fab fa-linkedin-in',
            'snapchat-ghost' => 'fab fa-snapchat-ghost',
        ];
    }
}

if (!function_exists('timer')) {
    function timer($datetime)
    {
        $houres = 0;
        date_default_timezone_set('Asia/Riyadh');
        $now = new DateTime;
        $untile = new DateTime($datetime);
        $diff = $untile->diff($now);
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
        if ($diff->w > 0) {
            $houres = $houres + ($diff->w * 7 * 24);
        }
        if ($diff->d > 0) {
            $houres = $houres + ($diff->d * 24);
        }
        if ($diff->h > 0) {
            $houres = $houres + $diff->h;
        }
        return $houres;
    }
}
if (!function_exists('time_remaining')) {
    function time_remaining($datetime, $full = false)
    {
        date_default_timezone_set('Asia/Riyadh');
        $now = new DateTime;
        $untile = new DateTime($datetime);
        $diff = $untile->diff($now);
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
        $string = array(
            'y' => 'سنة',
            'm' => 'شهر',
            'w' => 'أسبوع',
            'd' => 'يوم',
            'h' => 'ساعة',
            'i' => 'دقيقة',
            's' => 'ثانية',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
            } else {
                unset($string[$k]);
            }
        }
        if (!$full)
            $string = array_slice($string, 0, 1);
        return $string ? 'بعد ' . implode(', ', $string) : 'الآن';
    }
}

if (!function_exists('time_ago')) {
    function time_ago($datetime, $full = false)
    {
        date_default_timezone_set('Asia/Riyadh');
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
        $string = array(
            'y' => 'سنة',
            'm' => 'شهر',
            'w' => 'أسبوع',
            'd' => 'يوم',
            'h' => 'ساعة',
            'i' => 'دقيقة',
            's' => 'ثانية',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
            } else {
                unset($string[$k]);
            }
        }
        if (!$full)
            $string = array_slice($string, 0, 1);
        return $string ? 'قبل ' . implode(', ', $string) : 'الآن';
    }
}
if (!function_exists('get_site_contacts')) {
    function get_site_contacts($type)
    {
        return DB::table('site_contacts')
            ->where('type', $type)
            ->first()->value ?? '#';
    }
}

if (!function_exists('get_contact_url')) {
    function get_contact_url($contact)
    {
        $url = $contact->value;
        if ($contact->type == 'email') {
            $url = 'mailto:' . $contact->value;
        }
        if ($contact->type == 'whats') {
            $url = "https://api.whatsapp.com/send?phone={$contact->value}";
        }

        return $url;
    }
}

if (!function_exists('has_unseen_messages')) {
    function has_unseen_messages($from = null)
    {
        if (auth()->check()) {
            if ($from) {
                return \App\Models\Chat::where('to_id', auth()->user()->id)->where('from_id', $from)->where('seen', 0)->exists();
            }
            return \App\Models\Chat::where('to_id', auth()->user()->id)->where('seen', 0)->exists();
        }
        return false;
    }
}

function getCategoriesParentsID($category) {
    $array   = [];
    if(!is_null($category)) {
        if($category->myParent) {
            $arr = getCategoriesParents($category, 0);
            foreach($arr as $v) {
                $array[] = $v;
            }
        }
    }
    return $array;
}

function getCategoriesParents($parent, $loop = 0) {
    $arr = [];
    $arr[] = $parent->id;
    if($parent->myParent) {
        $x = getCategoriesParents($parent->myParent, $loop++);
        foreach($x as $c) {
            $arr[] = $c;
        }
    }
    return $arr;
}

function GetCategories($ID) {
    $array   = [];
    $dept = \App\Components\Categories\Models\Category::find($ID);
    if(!is_null($dept)) {
        if($dept->myParent) {
            $arr = GetParents($dept, 0);
            foreach($arr as $v) {
                $array[] = $v;
            }
        }
    }
    return $array;
}

function GetParents($parent, $loop = 0) {
    $arr = [];
    $arr[] =['name'=>$parent->name,'id'=>$parent->id];
    if($parent->myParent) {
        $x = GetParents($parent->myParent, $loop++);
        foreach($x as $c) {
            $arr[] = $c;
        }
    }
    return $arr;
}

function GetAdvCategories($ID) {
    $array   = [];
    $dept = \App\Components\Categories\Models\Category::find($ID);
    if(!is_null($dept)) {
        if($dept->myChild) {
            $arr = GetChilds($dept, 0);
            foreach($arr as $v) {
                $array[] = $v;
            }
        }
    }
    return $array;
}

function GetChilds($child, $loop = 0) {
    $arr = [];
    $arr[] =['name'=>$child->name,'id'=>$child->id];
    if($child->myChild) {
        $x = GetChilds($child->myChild, $loop++);
        foreach($x as $c) {
            $arr[] = $c;
        }
    }
    return $arr;
}

if (!function_exists('get_permissions')) {

    function get_permissions() {
        $glob = glob(app_path() . '/Components/**/Views/Dashboard/resourses/permission.php');
        $f = collect($glob)->groupBy(
            function ($el) {
                return pathinfo($el)['filename'];
            }
        );
        $f->transform(
            function ($item) {
                $data = [];
                foreach ($item as $value) {
                    $data[] = include $value;
                }
                return collect(array_filter($data));
            }
        );
        $permission = [];
        if ($f->count()) {
            foreach ($f['permission'] as $key =>$items) {
                foreach ($items as $key => $value) {
                    $permission[$key] = $value;
                }
            }
        }
        return $permission;
    }
}
if (!function_exists('app_admins')) {
    function app_admins(){
        $admins = App\Models\Admin::whereHas("roles", function($q){ $q->where("name", "admin"); })->get();
        return $admins;
    }
}
if (!function_exists('app_settings')) {
    function app_settings(){
        static $settings = null;
        if ($settings == null) {
            $settings = \App\Components\Settings\Models\SiteConfig::first();
        }
        return $settings;
    }
}
if (!function_exists('app_mail')) {
    function app_mail(){
        static $mail = null;
        if ($mail == null) {
            $mail = \App\Components\Settings\Models\SiteMail::first();
        }
        return $mail;
    }
}
if (!function_exists('app_sms')) {
    function app_sms(){
        static $sms = null;
        if ($sms == null) {
            $sms = \App\Components\Settings\Models\SiteSms::first();
        }
        return $sms;
    }
}
if (!function_exists('app_privacy')) {
    function app_privacy(){
        static $privacy = null;
        if ($privacy == null) {
            $privacy = \App\Components\Pages\Models\Page::where(['id'=>2, 'is_active'=>1 ])->first();
        }
        return $privacy;
    }
}

if (!function_exists('api_response')) {
    function api_response( $status , $msg = '' , $data = [] , $pagination = null ){
        if ( $data == [] ){
            return ['status'  => $status ,
                    'message' => $msg ,
            ];
        }
        if ($pagination == null ){
            return ['status'  => $status ,
                'message' => $msg ,
                'data'    => $data
            ];
        }else{
            return [
                'status'    => $status ,
                'message'   => $msg ,
                'data'      => $data ,
                'pagination' => [
                    'total' => $pagination->total(),
                    'count' => $pagination->count(),
                    'per_page' => $pagination->perPage(),
                    'current_page' => $pagination->currentPage(),
                    'total_pages' => $pagination->lastPage(),
                    'has_more_pages' => $pagination->hasMorePages(),
                ]
            ];
        }

    }
}
if (!function_exists('api_msg')) {
    function api_msg($request,$ar,$en){
        if($request->header('Api-Lang')=="ar"){
            app()->setLocale('ar');
            $msg = $ar;
        }else{
            app()->setLocale('en');
            $msg = $en;
        }
        return $msg ;
    }
}

if (!function_exists('api_notify')) {
    function api_notify( $ar = '' , $en = '' , $url = '')
    {
        return [
            'ar' => $ar ,
            'en' => $en,
            'url' => $url ,
            'notify_id' => random_int(1000000, 9999999)
        ];
    }
}

if (!function_exists('api_lang')) {
    function api_lang()
    {
        if(request()->header('Api-Lang') && request()->wantsJson()){ App::setLocale(request()->header('Api-Lang'));}
    }
}

if (!function_exists('userNearLocation')) {
    function userNearLocation($lat, $lng, $distance = 20){
        $query = <<<EOF
        SELECT * FROM (
          SELECT *,
              (
                  (
                      (
                          acos(
                              sin(( $lat * pi() / 180))
                              *
                              sin(( `lat` * pi() / 180)) + cos(( $lat * pi() /180 ))
                              *
                              cos(( `lat` * pi() / 180)) * cos((( $lng - `lng`) * pi()/180)))
                      ) * 180/pi()
                  ) * 60 * 1.1515 * 1.609344
              )
          as distance FROM `users`
      ) users
      WHERE distance <= $distance && is_active = 1 && type = 'client' && id in (SELECT client_id FROM photographers)
      LIMIT 15
EOF;
        $clients = DB::select($query);
        $array = [];
        foreach ($clients as $client) {
            $photographer = \App\Components\Photographers\Models\Photographer::where('client_id', $client->id)->first();
            if ($photographer) {
                $array[] = $photographer;
            }
        }
        return $array;
    }
}

if (!function_exists('examinationNearLocation')) {
    function examinationNearLocation($lat, $lng, $distance = 20){
        $query = <<<EOF
        SELECT * FROM (
          SELECT *,
              (
                  (
                      (
                          acos(
                              sin(( $lat * pi() / 180))
                              *
                              sin(( `lat` * pi() / 180)) + cos(( $lat * pi() /180 ))
                              *
                              cos(( `lat` * pi() / 180)) * cos((( $lng - `lng`) * pi()/180)))
                      ) * 180/pi()
                  ) * 60 * 1.1515 * 1.609344
              )
          as distance FROM `users`
      ) users
      WHERE distance <= $distance && is_active = 1 && type = 'client' && id in (SELECT client_id FROM examinations)
      LIMIT 15
EOF;
        $clients = DB::select($query);
        $array = [];
        foreach ($clients as $client) {
            $photographer = \App\Components\Examinations\Models\Examination::where('client_id', $client->id)->first();
            if ($photographer) {
                $array[] = $photographer;
            }
        }
        return $array;
    }
}

// if (!function_exists('findKeysInFiles')) {
//     function findKeysInFiles($path = [], $name = "", $component = ""): array
//     {
//         // $path = glob(app_path() . '/Components/**/Views/Dashboard/views');
//         $functions =  ['\$t', 'i18n.t', '@lang', '__', 'trans'];
//         $pattern =
//             "[^\w|>]".                          // Must not have an alphanum or _ or > before real method
//             "(".implode('|', $functions) .")".  // Must start with one of the functions
//             "\(".                               // Match opening parenthese
//             "[\'\"]".                           // Match " or '
//             "(".                                // Start a new group to match:
//             "([^\1)]+)+".                       // this is the key/value
//             ")".                                // Close group
//             "[\'\"]".                           // Closing quote
//             "[\),]";                            // Close parentheses or new parameter
//         $finder = new Symfony\Component\Finder\Finder();
//         if (!empty($name)) {
//             $name = $name.'.php';
//         }else{
//             $name = '*.php';
//         }
//         $finder->in($path)->exclude('storage')->name([$name])->files();
//         $keys = [];
//         foreach ($finder as $file) {
//             if (preg_match_all("/$pattern/siU", $file->getContents(), $matches)) {

//                 if (count($matches) < 2) {
//                     continue;
//                 }
//                 foreach ($matches[2] as $key) {
//                     if (strlen($key) < 2) {
//                         continue;
//                     }
//                     $locals = [];
//                     if (!empty($component)) {
//                         $locals = json_decode(trim(file_get_contents(app_path() . '/Components/'.$component.'/Views/Lang/ar.json')));
//                     }else{
//                         $locals = json_decode(trim(file_get_contents(resource_path('lang/ar.json'))));
//                     }
//                     if (array_key_exists($key, $locals) == false) {
//                         // $locals = get_object_vars($locals);
//                         // $value = $locals[$key];
//                         // $keys[$key] = $value;
//                         $keys[$key] = "";
//                     }
//                 }
//             }
//         }
//         uksort($keys, 'strnatcasecmp');
//         return [$component, $keys];
//     }
// }
