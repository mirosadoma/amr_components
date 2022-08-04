<link rel="stylesheet" href="{{asset('assets')}}/site/css/all.min.css">
<link rel="stylesheet" href="{{asset('assets')}}/site/css/animate.css">
<link rel="stylesheet" href="{{asset('assets')}}/site/css/bootstrap.min.css">
<link rel="stylesheet" href="{{asset('assets')}}/site/css/owl.carousel.min.css">
<link rel="stylesheet" href="{{asset('assets')}}/site/css/owl.theme.default.min.css">
<link rel="stylesheet" href="{{asset('assets')}}/site/css/main.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
<link href="https://fonts.googleapis.com/css2?family=Almarai&display=swap" rel="stylesheet">
@stack('styles')
<style>
    .error-help-block{
        color: red
    }
</style>
<script>
    var _token_ = "{{ csrf_token() }}";
    var _url_ = "{!! url('/') . '/' . app()->getLocale() . '/' !!}";
    var base_url = "{{asset('assets')}}/site/";
</script>