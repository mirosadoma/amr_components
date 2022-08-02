<?php

namespace App\Components\ContactUs\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Requests
use App\Components\ContactUs\Requests\Api\SendContactUsRequest;
// Models
use App\Components\ContactUs\Models\ContactUs;

class ContactUsController extends Controller {

    public $successStatus = 200;
    public $errorStatus = 422;

    public function create(SendContactUsRequest $request)
    {
        ContactUs::create($request->all());
        $msg = api_msg(request() , 'تم إرسال رسالتك إلى الإدارة' ,'Your message has been sent to management');
        return response()->json(api_response( 1 , $msg), $this->successStatus);
    }
}
