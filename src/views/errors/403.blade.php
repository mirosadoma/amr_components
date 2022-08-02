<!DOCTYPE html>
<html>
<head>
    <title>403 FORBIDDEN</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ URL::asset('public/admin/css/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/admin/css/bootstrap-rtl.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ URL::asset('public/admin/css/bootstrap-switch-rtl.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/admin/css/components-rounded-rtl.min.css') }}">

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            color: #B0BEC5;
            display: table;
            font-weight: 100;
            font-family: 'Lato', sans-serif;
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 72px;
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <div class="title">403 FORBIDDEN</div>
        <div class="text-right">
            <a class="btn sbold green" href="{{ route('app.dashboard') }}">@lang('Back To Main Page')
                <i class="fa fa-arrow-left"></i>
            </a>
        </div>
    </div>
</div>
</body>
</html>
