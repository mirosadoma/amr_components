<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('site.layouts.inc.styles')
    <link rel = "icon" href = "{{app_settings()->logo_path}}" type = "image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Almarai&display=swap" rel="stylesheet">
    <title>@lang(env('APP_NAME')) - @lang("Forget Page")</title>
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
                    <form method="post" action="{{route('site.forgetAuth')}}" class="general_form row mt-5">
                        @csrf
                        <h4> @lang("Password recovery")</h4>
                        <div class="col-md-12 mb-4">
                            <label for="" class="form-label label_custom">@lang("Phone Or Email")</label>
                            <input type="text" name="phone_email" class="form-control input_custom" id="" aria-describedby="" required>
                            @error('phone_email')
                                <div class="invalid-feedback" style="display: block">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn button_custom"> @lang("Send") </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- start authentication -->
    @include('site.layouts.inc.scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Site\Auth\ForgetPanelRequest') !!}
</body>
</html>