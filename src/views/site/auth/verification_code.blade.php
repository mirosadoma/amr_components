<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('site.layouts.inc.styles')
    <link rel = "icon" href = "{{app_settings()->logo_path}}" type = "image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Almarai&display=swap" rel="stylesheet">
    <title>@lang(env('APP_NAME')) - @lang("Verfication Code")</title>
</head>
<body>
    <!-- start authentication -->
    <section class="authentication login">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="logo_auth d-flex justify-content-center align-items-center">
                        <img src="{{asset('assets')}}/site/images/22h_1.gif" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="code-vertification text-center">
                        <h2>@lang("Type the code to activate the account")</h2>
                        <form method="post" action="{{route('site.verfy_code')}}" class="general_form row">
                            @csrf
                            <input maxlength='6' name="verification_code"/>
                            <button type="submit d-block" class="btn button_custom"> @lang("Save") </button>
                        </form>
                        <a href="{{route('site.resend_code')}}">@lang("Resend Code")</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- start authentication -->
    @include('site.layouts.inc.scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Site\Auth\VerficationPanelRequest') !!}
</body>
</html>