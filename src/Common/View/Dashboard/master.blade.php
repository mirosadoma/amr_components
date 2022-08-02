<!DOCTYPE html>
<html lang="en" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">
        <title>
            @if(View::hasSection('head.title'))
            @yield('head.title')
            @else
            @yield('title')
            @endif
            | @lang(env('APP_NAME'))
        </title>
        <!-- Global stylesheets -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
        {!! AssetsAdmin('icons/icomoon/styles.css') !!}
        {!! AssetsAdmin('bootstrap.css') !!}
        {!! AssetsAdmin('core.css') !!}
        {!! AssetsAdmin('components.css') !!}
        {!! AssetsAdmin('colors.css') !!}
        @stack('styles')
        <style>
            *{
                font-family: 'Cairo', sans-serif;
            }
            ::-webkit-scrollbar {
                width: 10px;
            }
            ::-webkit-scrollbar-track {
                background: #f1f1f1; 
            }
            ::-webkit-scrollbar-thumb {
                background: #339eee; 
            }
            ::-webkit-scrollbar-thumb:hover {
                background: #555; 
            }
            .pagination li {
                color: black;
                display: inline-block;
                padding: 8px 16px;
                text-decoration: none;
            }
            .panel .pagination{
                display: block;
                text-align: center;
            }
            .navbar-default .navbar-brand{
                color: white;
                font-size: 20px;
            }
            .navbar-brand{
                padding: 15px 8px;
            }
            .navbar-default .navbar-brand:hover, .navbar-default .navbar-brand:focus{
                color: white;
            }
            .navigation .navigation-header, .navigation .navigation-header a{
                margin: 0;
                padding: 0;
            }
            .navigation-header input{
                width: 97%;
                border: 1px solid;
                display: block;
                margin: 0 auto;
                height: 31px;
                padding: 10px;
                color: black;
            }
            .header-highlight{
                background: linear-gradient( 0deg, rgb(13,135,228) 0%, rgb(73,171,244) 100%);
            }
            @media (min-width: 769px) {
                .sidebar-xs .header-highlight .navbar-header .navbar-brand {
                    background: none !important;
                    margin-right: 7px;
                }
            }
            .delete_list_table{
                background: none;
                border: 0px;
            }
            #PageLoader{
                z-index: 99999;
                position: fixed;
                background: #359fef;
                width: 100%;
                height: 100vh;
                top: 0px;
                padding-top: 20%;
                padding-right: 42%;
            }
        </style>
        @include('admin.styles')
        <!-- /global stylesheets -->
        <!-- Core JS files -->
        {!! AssetsAdmin('plugins/loaders/pace.min.js','js') !!}
        {!! AssetsAdmin('core/libraries/jquery.min.js','js') !!}
        {!! AssetsAdmin('core/libraries/bootstrap.min.js','js') !!}
        {!! AssetsAdmin('plugins/loaders/blockui.min.js','js') !!}
        {!! AssetsAdmin('core/app.js','js') !!}
        <!-- /core JS files -->
        <script>
            var _token = '<?php echo csrf_token() ?>';
        </script>
        @routes
    </head>
    <body>
        <!-- Main navbar -->
        <div class="navbar navbar-default header-highlight">
            <div class="navbar-header">
                <a class="navbar-brand" target="_blank" href="{{ route('dashboard.Dindex') }}">
                    @lang(env('APP_NAME'))
                </a>
                <ul class="nav navbar-nav visible-xs-block">
                    <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
                    <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
                </ul>
            </div>
            <div class="navbar-collapse collapse" id="navbar-mobile">
                <ul class="nav navbar-nav">
                    <li><a class="sidebar-control sidebar-main-toggle hidden-xs legitRipple" style="color: white;"><i class="icon-paragraph-justify3"></i></a></li>
                </ul>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="{{ url('/') }}" style="color: white;">
                                <i class=" icon-home2"></i>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="{{ route('Dlogout') }}" style="color: white;">
                                <i class=" icon-switch2"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Page container -->
        <div class="page-container">
            <!-- Page content -->
            <div class="page-content">
                <!-- Main sidebar -->
                <div class="sidebar sidebar-main">
                    <div class="sidebar-content">
                        <!-- User menu -->
                        <div class="sidebar-user-material">
                            <div class="category-content">
                                <div class="sidebar-user-material-menu">
                                    <a href="{{ route('dashboard.DProfile.index') }}"><span>@lang('My profile')</span></a>
                                </div>
                            </div>
                        </div>
                        @include('DCommon::layouts.menu')
                        @include('DCommon::layouts.styles')
                    </div>
                </div>
                <div class="content-wrapper">
                    @include('DCommon::layouts.page_header')
                    @component('admin.breadcrumb',['array'=>$array??[],'new'=>$new??[]])@endcomponent
                    <div class="content">
                        @yield('content')
                        <div class="footer text-muted">
                            &copy; {{ date('Y') }}.
                            <a href="#">
                                @lang(env('APP_NAME'))
                            </a> @lang('Design And Development By')
                            <a href="https://sadoma.com.sa" target="_blank">
                                @lang('Sadoma')
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page content -->
        </div>
        <div id="PageLoader">
            <img src="{{ url('assets/admin/assets/images/logo.png') }}" alt="@lang(env('APP_NAME'))" style="width: 30%;">
        </div>
        <!-- /page container -->
        @include('DCommon::validator')
        <script>
            $('.delete-record').click(function (e) {
                if (!confirm("@lang('Are You sure?')")) {
                    e.preventDefault();
                }
            });
        </script>
        <script>
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip(); 
            });
            $(window).on("load",function(){$("#PageLoader").css("display","none")});
        
        </script>
        <script>
            if (localStorage.getItem('has-sidebar') === "false") {
                $('body').addClass('sidebar-xs');
            } else {
                $('body').removeClass('sidebar-xs');
            }
            $('.sidebar-main-toggle').click(function () {
                localStorage.setItem('has-sidebar', $('body').hasClass('sidebar-xs'));
            });
            //Search in navigation
            $('.navigation-header input').keyup(function () {
                var inputValue = $(this).val();
                $('.navigation > li').not('.navigation-header').each(function (i, el) {
                    var _el = $(el);
                    var text = _el.find('span').first().text();
                    if(text.trim() === ""){
                        _el.show();
                        return;
                    }
                    console.log(text.search(inputValue));
                    if (text.search(inputValue) === -1) {
                        _el.hide();
                    } else {
                        _el.show();
                    }
                });
            });
        </script>
        @include('admin.scripts')
        @stack('scripts')
        @stack('footer_scripts')
    </body>
</html>
