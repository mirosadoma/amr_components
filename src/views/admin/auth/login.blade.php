@extends('admin.auth.master')

@section('auth_title')
    @lang('Login Page')
@endsection

@section('auth_content')
    <form class="auth-login-form mt-2" action="{{ route('loginAuth') }}" method="post">
        @csrf
        @if(\Session::has('msg'))
            <div class="alert alert-danger">
                <button class="close" data-close="alert"></button>
                <span class="error_span"> {{\Session::get('msg')}} </span>
            </div>
        @endif
        <div class="mb-1">
            <label for="login-name" class="form-label">@Lang("Email")</label>
            <input type="email" class="form-control" id="login-email" name="email" placeholder="example@example.com" aria-describedby="login-email" tabindex="1" autofocus />
            @error('email')
                <div class="invalid-feedback" style="display: block">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
        </div>
        <div class="mb-1">
            <div class="d-flex justify-content-between">
                <label class="form-label" for="login-password">@lang("Password")</label>
            </div>
            <div class="input-group input-group-merge form-password-toggle">
                <input type="password" class="form-control form-control-merge" id="login-password" name="password" tabindex="2" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="login-password" />
                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                @error('password')
                    <div class="invalid-feedback" style="display: block">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>
        </div>
        <div class="mb-1">
            <div class="form-check">
                <input class="form-check-input" name="remember_me" value="1" type="checkbox" id="remember-me" tabindex="3" />
                <label class="form-check-label" for="remember-me"> @lang('Remember Me') </label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary w-100" tabindex="4">@lang('Sign in')</button>
    </form>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Dashboard\Auth\LoginPanelRequest') !!}
@endpush