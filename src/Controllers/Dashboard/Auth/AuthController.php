<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\Auth\LoginPanelRequest;
use App\Models\Admin;
use Auth;

class AuthController extends Controller {

    public function loginPage() {
        if(!Auth::guard('admin')->user()) {
            return view('admin.auth.login');
        }
        if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->type == "admin"){
            return redirect()->route('app.dashboard');
        }
        return redirect()->route('home');
    }

    public function loginAuth(LoginPanelRequest $request) {
        $user = Admin::where('email', request('email'))->withTrashed()->first();
        if($user && $user->type != "admin"){
            return redirect()->route('login')->with('error',__('You Not A Administration'));
        }
        if($user && $user->deleted_at){
            return redirect()->route('login')->with('error',__('You Deleted By Adminstratore'));
        }
        if($user && $user->is_active != 1){
            return redirect()->route('login')->with('error',__('You Are Not Active From Administrator'));
        }
        $credential = [
            'email'     => $request->email,
            'password'  => $request->password,
        ];
        $remember_me = (!empty($request->remember_me))? true : false;
        if(Auth::guard('admin')->attempt($credential)) {
            Auth::guard('admin')->login($user, $remember_me);
            return redirect()->intended('/ar/app')->with('success',__('Login has been successfully'));
        } else {
            return redirect()->route('login')->with('error',__('Email Or Password Is Rong'));
        }
    }

    public function logout(Request $request) {
        Auth::guard('admin')->logout();
        return redirect()->route('login')->with('success',__('LogOut has been successfully'));
    }
}
