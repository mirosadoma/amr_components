<?php

namespace App\Components\ContactUs\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Models
use App\Components\ContactUs\Models\ContactUs;
use Mail;
use App\Mail\SendReply;
use Carbon\Carbon;
// Requests
use App\Components\ContactUs\Requests\Dashboard\StoreRequest;
use App\Components\ContactUs\Requests\Dashboard\UpdateRequest;

class ContactUsController extends Controller {

    public function index() {
        if (!permissionCheck('contact_us.view')) {
            return abort(403);
        }
        $PageTitle = __('All ContactUs');
        $Breadcrumb = [
            [
                'name'  =>  $PageTitle,
                'route' =>  'contactus.index',
            ],
        ];
        $search  = ContactUs::FORM_SEARCH();
        $lists = ContactUs::query();
        if (request()->has('filter') && request('filter') != 0) {
            if (request()->has('name') && !empty(request('name'))) {
                $lists->where('name', 'LIKE', '%'.request('name').'%');
            }
            if (request()->has('email') && !empty(request('email'))) {
                $lists->where('email', 'LIKE', '%'.request('email').'%');
            }
            if (request()->has('phone') && !empty(request('phone'))) {
                $lists->where('phone', 'LIKE', '%'.request('phone').'%');
            }
            if (request()->has('created_at') && !empty(request('created_at'))) {
                $lists->whereDate('created_at', request('created_at'));
            }
        }
        $lists = $lists->orderBy('id', "DESC")->paginate();
        return view('ContactUs_Dashboard::index',get_defined_vars());
    }

    public function show($contact_us) {
        if (!permissionCheck('contact_us.view')) {
            return abort(403);
        }
        $PageTitle = __('Show ContactUs');
        $Breadcrumb = [
            [
                'name'  =>  __('All ContactUs'),
                'route' =>  'contactus.index',
            ],
            [
                'name'  =>  $PageTitle,
                'route' =>  'contactus.show',
            ],
        ];
        $Button = [
            'title' => __('Back To ContactUs'),
            'route' =>  'contactus.index',
            'icon'  => 'arrow-left'
        ];
        $contact_us = ContactUs::find($contact_us);
        return view('ContactUs_Dashboard::show',get_defined_vars());
    }

    public function update(UpdateRequest $request, $contact_us) {
        if (!permissionCheck('contact_us.update')) {
            return abort(403);
        }
        $contact_us = ContactUs::find($contact_us);
        $contact_us->update([
            'reply'         => $request->reply,
            'reply_date'    => Carbon::now()
        ]);
        $data['reply'] = $request->reply;
        $data['link'] = route('site.reset_password', $token);
        $data['user_name'] = $contact_us->name;
        $data['logo'] = app_settings()->logo_path;
        $data['project_name'] = "أنا إيجابى";
        $data['home_link'] = route('home');
        try {
            // hint send code to mail
            Mail::to($contact_us->email, $contact_us->name)->send(new SendReply($data));
        }catch (\Exception $e){
            return $e->getMessage();
        }
        return redirect()->back()->with('success', __('The contact has been answered successfully'));
    }

    public function destroy($contact_us) {
        if (!permissionCheck('contact_us.delete')) {
            return abort(403);
        }
        $contact_us = ContactUs::find($contact_us);
        $contact_us->delete();
        return redirect()->route('app.contactus.index')->with('success', __('Data Deleted Successfully'));
    }
}
