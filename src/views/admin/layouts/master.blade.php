<!DOCTYPE html>
<html class="loading light-layout {{\Auth::guard('admin')->user()->is_dark == 1 ? 'dark-layout' : ''}}" lang="{{app()->getLocale()}}" dir="{{app()->getLocale() == 'ar' ? 'rtl' : 'ltr'}}" data-textdirection="{{app()->getLocale() == 'ar' ? 'rtl' : 'ltr'}}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="X-CSRF-TOKEN" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <base href="{{asset('assets')}}/">
    <title>@lang('My_Dashboard') - @yield('head_title')</title>
    @include('admin.layouts.inc.styles')
    <!-- BEGIN: loader-->
    {!! assetAdmin('app-assets/loader/loader.css','css') !!}
    <!-- END: loader-->
    <!-- BEGIN: loader-->
    {!! assetAdmin('app-assets/loader/loader.js','js') !!}
    <!-- END: loader-->
</head>
{{-- <body class="vertical-layout vertical-menu-modern content-left-sidebar navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar"> --}}
<body class="vertical-layout vertical-menu-modern navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="">
    <!-- BEGIN: Loader-->
    <div class="loader">
        <div class="book">
            <div class="inner">
                <div class="left"></div>
                <div class="middle"></div>
                <div class="right"></div>
            </div>
            <ul>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
    </div>
    <!-- END: Loader-->
    <!-- BEGIN: Header-->
    @include('admin.layouts.topNavBar')
    <!-- END: Header-->
    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow {{\Auth::guard('admin')->user()->is_dark == 1 ? 'menu-dark' : 'menu-light'}}" data-scroll-to-active="true">
        <div class="navbar-header">
            <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                <i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i>
            </a>
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item me-auto">
                    <a class="navbar-brand" href="{{ route('app.dashboard') }}" @if (app_settings()->logo) style="margin-top: 5px;" @endif>
                        <span class="brand-logo">
                            <img src="{{app_settings()->logo_path}}" style="max-height: 50px;" alt="{{ __(env('APP_NAME')) }}">
                        </span>
                        <h2 class="brand-text">@lang(env('APP_NAME'))</h2>
                    </a>
                </li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            @include('admin.layouts.rightNavBar')
        </div>
    </div>
    <!-- END: Main Menu-->
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            @yield('breadcrumb')
            <div class="content-body">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- END: Content-->
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
    @include('admin.layouts.footer')
    @include('admin.layouts.inc.scripts')
    <div id="translate" class="modal fade out">
        <div class="modal-dialog">
            <div class="modal-content modal-dialog-scrollable">
                <div class="modal-header">
                    <div class="pull-right">
                        @if (count(trans()->notTranslated))
                            <button type="submit" class="btn btn-primary" form="translation-form" title="{{__('Save')}}">
                                <i data-feather="database" stroke-width="7"></i>
                            </button>
                        @endif
                        <button type="button" class="btn btn-danger " data-dismiss="modal" title="{{__('Close')}}">
                            <i data-feather="x" stroke-width="7"></i>
                        </button>
                    </div>
                    <h5 class="modal-title">@lang("Translation")</h5>
                </div>
                <div class="modal-body">
                    @if (count(trans()->notTranslated))
                    <form action="{{ route("app.fast_trans") }}" method="post" id="translation-form">
                        @csrf
                    @endif
                        @if (count(trans()->notTranslated))
                            <div class="col-md-12">
                                <input class="form-control translation-search" type="text" placeholder="{{ __("Write To Search !") }}" style=" width: 100%; margin-bottom: 15px; ">
                            </div>
                            {{-- <input type="hidden" name="component" value="{!!explode("\\",__NAMESPACE__,4)[2]!!}"> --}}
                            @foreach (trans()->notTranslated as $word)
                                <div class="translation-row row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input class="form-control translation-val" type="text" value="{{ $word }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="keys[{{ $word }}]">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="translation-row row">
                                <div class="col-md-12" style="text-align: center">
                                    <div class="form-group">
                                        <p class="form-control ">@lang("No Data Found")</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @if (count(trans()->notTranslated))
                    </form>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">@lang("Close")</button>
                    @if (count(trans()->notTranslated))
                        <button type="submit" form="translation-form" class="btn btn-primary">@lang("Save Changes")</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.translation-search').keyup(function () {
            let inputValue = $(this).val().toLowerCase();
            console.log(inputValue);
            $('.translation-val').each(function (i, el) {
                let _el = $(el);
                let text = _el.val().toLowerCase();
                if (text.trim() === "") {
                    _el.parents(".translation-row").show();
                    return;
                }
                if (text.search(inputValue) === -1) {
                    _el.parents(".translation-row").hide();
                } else {
                    _el.parents(".translation-row").show();
                }
            });
        });

    </script>
</body>
</html>
