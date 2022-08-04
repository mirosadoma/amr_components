<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('site.layouts.inc.styles')
    <link rel = "icon" href = "{{app_settings()->logo_path}}" type = "image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Almarai&display=swap" rel="stylesheet">
    <title>@lang(env('APP_NAME')) - @lang("Sign up")</title>
</head>
<body>
    <!-- start authentication -->
    <section class="authentication signup">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="logo_auth d-flex justify-content-center align-items-center">
                        <img src="{{asset('assets')}}/site/images/1h_1.gif" alt="{{asset('assets')}}/site/images/1h_1.gif">
                    </div>
                </div>
                <div class="col-lg-6">
                    <form method="post" action="{{route('site.signupAuth')}}" class="general_form row">
                        @csrf
                        <h2> @lang("Welcome") </h2>
                        <h4> @lang("Create Account") </h4>
                        <p> @lang("Already have an account?") <a href="{{route('site.login')}}"> @lang("Sign in") </a> </p>
                        <div class="col-12 mb-4">
                            <label for="" class="form-label label_custom"> @lang("Name") </label>
                            <input type="text" name="name" class="form-control input_custom" id="" aria-describedby="" required>
                            @error('name')
                                <div class="invalid-feedback" style="display: block">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="col-12 mb-4 input-group">
                            <label for="" class="form-label label_custom"> @lang("Phone") </label>
                            <input type="number" name="phone" maxlength="9" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control input_custom" id="" aria-describedby="" required>
                            <span class="input-group-text" style="direction: ltr;">+966</span>
                            @error('phone')
                                <div class="invalid-feedback" style="display: block">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="col-12 mb-4">
                            <label for="" class="form-label label_custom"> @lang("Email") </label>
                            <input type="email" name="email" class="form-control input_custom" id="" aria-describedby="" required>
                            @error('email')
                                <div class="invalid-feedback" style="display: block">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="" class="form-label label_custom"> @lang("City") </label>
                            <select name="city_id" class="form-select select_custom" aria-label="Default select example">
                                <option selected disabled> @lang("Choose City") </option>
                                @foreach($cities as $city)
                                    <option value="{{$city->id}}" @if($city->id == old('city_id')) selected @endif>{{$city->name}}</option>
                                @endforeach
                            </select>
                            @error('city_id')
                                <div class="invalid-feedback" style="display: block">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="" class="form-label label_custom"> @lang("Gender") <sup> ( @lang("Optional") ) </sup> </label>
                            <select name="gender" class="form-select select_custom" aria-label="Default select example">
                                <option selected disabled> @lang("Choose Gender") </option>
                                <option value="male"> @lang("Male") </option>
                                <option value="female"> @lang("Female") </option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback" style="display: block">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="col-12 mb-4 position-relative">
                            <label for="" class="form-label label_custom"> @lang("Password") </label>
                            <input type="password" name="password" class="form-control input_custom password" id="" aria-describedby="" required>
                            <i class="far fa-eye eye"></i>
                            @error('password')
                                <div class="invalid-feedback" style="display: block">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="col-12 mb-4 position-relative">
                            <label for="" class="form-label label_custom"> @lang("Password Confirmation") </label>
                            <input type="password" name="password_confirmation" class="form-control input_custom password" id="" aria-describedby="" required>
                            <i class="far fa-eye eye"></i>
                            @error('password_confirmation')
                                <div class="invalid-feedback" style="display: block">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="col-12 mb-4">
                            <label for="code" class="form-label label_custom"> @lang("Practitioner Code")  <sup> (@lang("if found")) </sup> </label>
                            <input type="number" name="code" class="form-control input_custom" id="code" aria-describedby="">
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
    {!! JsValidator::formRequest('App\Http\Requests\Site\Auth\SignUpPanelRequest') !!}
</body>
</html>