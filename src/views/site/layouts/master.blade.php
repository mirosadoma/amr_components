<!DOCTYPE html>
<html lang="{{app()->getLocale()}}" dir="{{app()->getLocale() == 'ar' ? 'rtl' : 'ltr'}}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "icon" href = "{{app_settings()->logo_path}}" type = "image/x-icon">
    @include('site.layouts.inc.styles')
    <title>@lang(env('APP_NAME')) - @yield('head_title')</title>
</head>
<body>
    @include('site.layouts.nav')
    @if(\Route::currentRouteName() == "home") 
        @include('site.layouts.header')
    @endif

    @yield('content')

    @include('site.layouts.footer')
        <div class="modal fade modal-degree" id="modaltest" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-header">
                    <h5 class="modal-title" id="popup_title"></h5>
                </div>
                <div class="courses-btns header-btns">
                    <a href="" class="button_custom" rel="noopener noreferrer" id="popup_link"> </a>
                </div>
            </div>
            </div>
        </div>
    @include('site.layouts.inc.scripts')
    <script>
        $(function(){
            $(".be_egaby_box").mouseenter(function() {
                $( this).find('.be_egaby-info').animate({opacity:0},500);
            });
            $(".be_egaby_box").mouseleave(function() {
                $( this).find('.be_egaby-info').animate({opacity:1},500);
            });
            $(".modalpopup").on('click', function() {
                $('#popup_title').html($(this).attr('data-popup-title'));
                $('#popup_link').html($(this).attr('data-popup-link-title')).attr('href', $(this).attr('data-popup-link'));
                $('#modaltest').modal('show');
            });
            $(".btn-close").on('click', function() {
                $('#modaltest').modal('hide');
            });
        });
    </script>
</body>
</html>