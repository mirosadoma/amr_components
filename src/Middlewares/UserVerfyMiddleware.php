<?php

namespace Amr\AmrComponents\Middlewares;

use Illuminate\Http\Request;
use Closure;
use Auth;
use Mail;
use App\Mail\SendCode;

class UserVerfyMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && !Auth::user()->email_verified_at || Auth::check() && empty(Auth::user()->email_verified_at)) {
            $generator_verification_code = generator_verification_code();
            Auth::user()->update(['verification_code'=>$generator_verification_code]);
            $data['logo'] = app_settings()->logo_path;
            $data['project_name'] = env('APP_NAME',__('Ana Egaby'));
            $data['home_link'] = route('home');
            $data['user_name'] = Auth::user()->name;
            $data['verification_code'] = $generator_verification_code;
            if (isset(Auth::user()->email)) {
                try {
                    Mail::to(Auth::user()->email, Auth::user()->name)->send(new SendCode($data));
                } catch (\Throwable $th) {
                    // throw $th;
                }
            }
            return redirect()->route('site.verification_code')->with('error', 'يجب تفعيل الحساب أولا');
        }
        return $next($request);
    }

}
