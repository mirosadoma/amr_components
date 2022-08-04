<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('site.layouts.inc.styles')
    <link rel = "icon" href = "{{app_settings()->logo_path}}" type = "image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Almarai&display=swap" rel="stylesheet">
    <title>@lang(env('APP_NAME')) - @lang("Reset Password Page")</title>
</head>
<body>
    <!-- start authentication -->
    <section class="authentication login">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="logo_auth d-flex justify-content-center align-items-center">
                        <img src="{{asset('assets')}}/site/images/Environment-bro.png" alt="{{asset('assets')}}/site/images/Environment-bro.png">
                    </div>
                </div>
                <div class="col-lg-6">
                    <form method="post" action="{{route('site.reset_passwordAuth')}}" class="general_form row mt-5">
                        @csrf
                        <input type="hidden" name="token" value="{{$token->token}}">
                        <h2> @lang("Welcome Back !")  </h2>
                        <h4> @lang("New Password") </h4>
                        <div class="col-12 mb-4 position-relative">
                            <label for="" class="form-label label_custom"> @lang("Password") </label>
                            <input type="password" name="password" class="form-control input_custom password" id="" aria-describedby="" required>
                            @error('password')
                                <div class="invalid-feedback" style="display: block">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                            <i class="far fa-eye eye"></i>
                        </div>
                        <div class="col-12 mb-4 position-relative">
                            <label for="" class="form-label label_custom"> @lang("Password Confirmation") </label>
                            <input type="password" name="password_confirmation" class="form-control input_custom password" id="" aria-describedby="" required>
                            @error('password_confirmation')
                                <div class="invalid-feedback" style="display: block">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                            <i class="far fa-eye eye"></i>
                        </div>
                        <button type="submit" class="btn button_custom"> @lang("Sign") </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- start authentication -->
    @include('site.layouts.inc.scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Site\Auth\ResetPanelRequest') !!}
</body>
</html>