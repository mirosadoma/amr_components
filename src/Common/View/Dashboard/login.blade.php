<!DOCTYPE html>
<html lang="{{App::getLocale()}}" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@lang(env('APP_NAME')) - <?php echo __('The control panel'); ?> </title>
        {!! AssetsAdmin('icons/icomoon/styles.css') !!}
        {!! AssetsAdmin('bootstrap.css') !!}
        {!! AssetsAdmin('core.css') !!}
        {!! AssetsAdmin('components.css') !!}
        {!! AssetsAdmin('colors.css') !!}
        <!-- /global stylesheets -->
        <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
        <!-- Core JS files -->
        {!! AssetsAdmin('plugins/loaders/pace.min.js','js') !!}
        {!! AssetsAdmin('core/libraries/jquery.min.js','js') !!}
        {!! AssetsAdmin('core/libraries/bootstrap.min.js','js') !!}
        {!! AssetsAdmin('plugins/loaders/blockui.min.js','js') !!}
        <style>
            *{
                font-family: 'Cairo', sans-serif;
            }
            body{
                background: linear-gradient( 0deg, rgb(13,135,228) 0%, rgb(73,171,244) 100%);
            }
        </style>
    </head>
    <body class="login-container bg-slate-800">
        <div class="page-container">
            <div class="page-content">
                <div class="content-wrapper">
                    <div class="content" style="text-align: center;">
                        <form action="{{ Route('loginCheck') }}" method="post">
                            @csrf
                            <img src="{{ url('assets/admin/assets/images/logo.png') }}" alt="@lang(env('APP_NAME'))" style="width: 13%;margin-bottom: 50px;margin-top: 50px;">
                            <div class="panel panel-body login-form">
                                <div class="text-center">
                                    <h5 class="content-group-lg"><?php echo __('The control panel'); ?> <small class="display-block"><?php echo __('Please sign in'); ?></small></h5>
                                </div>

                                <div class="form-group has-feedback has-feedback-left">
                                    <input type="text" class="form-control" name="username" placeholder="<?php echo __('Username'); ?>">
                                    <div class="form-control-feedback">
                                        <i class="icon-user text-muted"></i>
                                    </div>
                                    @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group has-feedback has-feedback-left">
                                    <input type="password" class="form-control" name="password" placeholder="<?php echo __('Password'); ?>">
                                    <div class="form-control-feedback">
                                        <i class="icon-lock2 text-muted"></i>
                                    </div>
                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group has-feedback has-feedback-left">
                                    @if (session('falde'))
                                    <span class="invalid-feedback" role="alert-danger">
                                        <strong style="color: #a30000;">{{ session('falde') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn bg-blue btn-block" style="rgb(15, 39, 136)"> 
                                        <?php echo __('Login'); ?> 
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('Amr\AmrComponents\Common\Requests\Dashboard\LoginRequest') !!}
