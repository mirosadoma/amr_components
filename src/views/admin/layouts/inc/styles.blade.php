<style>
    :root{
        --primary-color: #16A085;
        --secondry-color: #25AE60;
    }
    /*.vertical-layout.vertical-menu-modern .main-menu .navigation .menu-content li a{
                linear-gradient(-118deg, var(--primary-color), var(--secondry-color));
        box-shadow: 0 0 10px 1px var(--primary-color);
        color:#fff;
    }*/
</style>
<!-- BEGIN: loader-->
{!! assetAdmin('app-assets/loader/loader.css','css') !!}
<!-- END: loader-->
<link rel="apple-touch-icon" href="{{app_settings()->logo_path}}">
<link rel="shortcut icon" type="image/x-icon" href="{{app_settings()->logo_path}}">
@if (\App::getLocale() == "en")
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">
    {!! assetAdmin('app-assets/css/bootstrap.css','css') !!}
    {!! assetAdmin('app-assets/css/bootstrap-extended.css','css') !!}
    {!! assetAdmin('app-assets/css/colors.css','css') !!}
    {!! assetAdmin('app-assets/css/components.css','css') !!}
    {!! assetAdmin('app-assets/css/themes/dark-layout.css','css') !!}
    {!! assetAdmin('app-assets/css/themes/bordered-layout.css','css') !!}
    {!! assetAdmin('app-assets/css/themes/semi-dark-layout.css','css') !!}
    {!! assetAdmin('app-assets/css/core/menu/menu-types/vertical-menu.css','css') !!}
    {!! assetAdmin('app-assets/vendors/css/vendors.min.css','css') !!}
    {!! assetAdmin('app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css','css') !!}
    {!! assetAdmin('app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css','css') !!}
    {!! assetAdmin('assets/css/style.css','css') !!}
    <style>
        .main-menu.menu-light .navigation>li ul li>a {
            padding: 10px 15px 10px 50px !important;
        }
        .button_in_navbar {
            float: right;
            padding: 10px 15px;
        }
        .button_in_navbar svg.feather.feather-arrow-left{
            transform: rotate(180deg);
        }
    </style>
@else
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap" rel="stylesheet">
    {!! assetAdmin('app-assets/css-rtl/bootstrap.css','css') !!}
    {!! assetAdmin('app-assets/css-rtl/bootstrap-extended.css','css') !!}
    {!! assetAdmin('app-assets/css-rtl/colors.css','css') !!}
    {!! assetAdmin('app-assets/css-rtl/components.css','css') !!}
    {!! assetAdmin('app-assets/css-rtl/themes/dark-layout.css','css') !!}
    {!! assetAdmin('app-assets/css-rtl/themes/bordered-layout.css','css') !!}
    {!! assetAdmin('app-assets/css-rtl/themes/semi-dark-layout.css','css') !!}
    {!! assetAdmin('app-assets/css-rtl/core/menu/menu-types/vertical-menu.css','css') !!}
    {!! assetAdmin('app-assets/vendors/css/vendors-rtl.min.css','css') !!}
    {!! assetAdmin('app-assets/css-rtl/custom-rtl.css','css') !!}
    {!! assetAdmin('assets/css/style-rtl.css','css') !!}
    {!! assetAdmin('app-assets/css-rtl/components.css','css') !!}
    {!! assetAdmin('app-assets/css-rtl/components.css','css') !!}
    <style>
        body {
            font-family: 'Cairo', sans-serif !important;
        }
        .navigation {
            font-family: 'Cairo', sans-serif !important;
        }
        .main-menu.menu-light .navigation>li ul li>a {
            padding: 10px 50px 10px 15px !important;
        }
        .button_in_navbar {
            float: left;
            padding: 10px 15px;
        }
    </style>
@endif
<link rel="preconnect" href="https://fonts.gstatic.com">
{!! assetAdmin('app-assets/vendors/css/extensions/toastr.min.css','css') !!}
{!! assetAdmin('app-assets/vendors/css/forms/select/select2.min.css','css') !!}
{!! assetAdmin('app-assets/css-rtl/plugins/extensions/ext-component-toastr.css','css') !!}
<!-- BEGIN: tag input-->
{!! assetAdmin('app-assets/InputTags/InputTags.css','css') !!}
<!-- END: tag input-->
<style>
    .toast{
        position: absolute !important;
        top: 70px !important;
        left: 0 !important;
    }
    .toast:before{
        right: 86% !important;
    }
    html .content.app-content {
        padding: calc(1rem + 4.45rem + 1.3rem) 2rem 0;
    }
    .select2-selection__arrow b{
        height: 100% !important;
        border: none !important;
    }
    .error-help-block{
        color: red
    }
    .form-group{
        padding: 7px;
    }
    .pagination-section ul.pagination {
        background: linear-gradient(
        -118deg
        , var(--primary-color), var(--secondry-color));
        min-width: 9% !important;
        padding: 0 5px;
        border-radius: 20PX;
        display: inline-block;
        margin: 15px 0 0 0;
    }
    .pagination-section .pagination li {
        margin-right: 3px !important;
        font-size: 13px;
        padding: 6px 6px;
        display: inline-block;
        color:#fff
    }
    .pagination-section .pagination li.active {
        background: linear-gradient(
        -118deg
        , #de6d0c, #de6d0c);
    }
    .pagination-section li a{
        color: #fff
    }
    .tab-pane {
        display: none;
    }
    .tab-pane.active {
        display: block;
    }
    .nav-tabs .nav-item.active {
        background: linear-gradient(-118deg, var(--primary-color), var(--secondry-color));
    }
    .nav-tabs .nav-item.active a {
        color: #fff;
    }
    .select2-container--default[dir="rtl"] .select2-selection--multiple .select2-selection__choice__remove{
        margin-left: 5px !important;
        margin-right: 5px !important;
    }
    .table > :not(caption) > * > *{
        padding: 0.72rem 1rem !important;
    }
    .navbar-container .bookmark-input{
        width: 15% !important;
    }
    ul.nav.navbar-nav.bookmark-icons {
        min-height: 200px !important;
        max-height: 500px !important;
        max-width: 100% !important;
        overflow-y: scroll;
    }
    ul.nav.navbar-nav.bookmark-icons li a {
        font-size: 15px;
        font-weight: bold;
    }
    .vertical-layout.vertical-menu-modern.menu-collapsed .main-menu:not(.expanded) .navigation li.active a{
        background: linear-gradient(-118deg, var(--primary-color), var(--secondry-color)) !important;
        color: #fff !important;
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
{!! assetAdmin('app-assets/fileinput/css/fileinput.min.css','css') !!}
<!-- END: Custom CSS-->
{{--<!-- /global stylesheets -->--}}
@stack('styles')
<script>
    var _token_ = "{{ csrf_token() }}";
    var _url_ = "{!! url('/') . '/' . app()->getLocale() . '/' !!}";
    var base_url = "{{asset("/")}}";
</script>

