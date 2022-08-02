
<!DOCTYPE html>
<html dir="ltr">

<head>
    <title> الموقع في الصيانة {{ config('app.name', 'Laravel') }} </title>
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ URL::asset('public/admin/css/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/admin/css/bootstrap-rtl.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ URL::asset('public/admin/css/bootstrap-switch-rtl.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/admin/css/components-rounded-rtl.min.css') }}">
    <style>
        @media (max-width: 650px) {
            .error-box .error-title {
                font-size: 70px;
            }
        }
    </style>
</head>

<body>
<div class="main-wrapper">
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div class="error-box">
        <div class="error-body text-center">
            <h1 class="error-title text-danger">Maintenance</h1>
            <h3 class="text-uppercase error-subtitle">الموقع في الصيانة</h3>
            <p class="text-muted m-t-30 m-b-30">نأسف لعد اتاحة الموقع في الفترة الحالية ، لأعمال صيانة في الموقع ، عاود الزيارة مرة أخرى</p>
            <a href="" class="btn btn-danger btn-rounded waves-effect waves-light m-b-40">شرفتنا زيارتك</a>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- All Required js -->
<!-- ============================================================== -->
<script src="{{asset('adminpanel/assets/libs/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{asset('adminpanel/assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{asset('adminpanel/assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- ============================================================== -->
<!-- This page plugin js -->
<!-- ============================================================== -->
<script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
</script>
</body>

</html>
