<?php

namespace Amr\AmrComponents\Common\Controller\Dashboard;

use Amr\AmrComponents\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Components\User\Requests\Front\LoginRequest;
use App\Components\User\Requests\Front\CheckCodeRequest;
use App\User;
use session;

class AuthController extends Controller {

    //LOGIN Area
    public function open_account(CheckCodeRequest $request) {
        $request = $request->all();
        $user = User::where(
                        [
                            'mobile' => sanitize_mobile(session('mobile')),
                            'actived_code' => $request['active_code'],
                        ]
                )->first();
        if (is_null($user)) {
            return redirect()->back()->with('blade_error', blade_request_message(__('actived code wrong')));
        } else {
            \Auth::login($user);
            return redirect()->route('home')->with('blade_error', blade_request_message(__('Welcome Back'), 'success'));
        }
    }

    public function open_account_view() {
        if(!is_null(session('mobile'))) {
            if (is_null(Auth::user())) {
                return view('this::checkCode', get_defined_vars());
            }
        }
        return redirect()->route('login')->with('blade_error', blade_request_message(__('Please enter mobile number first'),'error'));
    }

    //LOGIN Area
    
    public function login(LoginRequest $request) {
        $user = User::where('mobile', sanitize_mobile($request->input('mobile')))->first();
        if (is_null($user)) {
            return redirect()->back()->with('blade_error', blade_request_message(__('this mobile not found')));
        } else {
            if ($user->status == 0) {
                return redirect()->back()->with('blade_error', blade_request_message(__('Sorry Your Account Is Blocked')));
            }
            $user->smsLogin();
            $request->session()->put('mobile', $user->mobile);
            return redirect()->route('open_account')->with('blade_error', blade_request_message(__('Please Check Your Phone'), 'info'));
        }
    }

    public function login_view() {
        if (is_null(Auth::user())) {
            return view('this::login', get_defined_vars());
        }
        return redirect()->route('home');
    }

    public function Logout() {
        Auth::logout();
        return redirect()->route('login');
    }

}
