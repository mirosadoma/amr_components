@extends('admin.layouts.master')
@section('head_title'){{__('Main')}}@endsection
@push('styles')
    <style>
        span.select2-container.select2-container--default.select2-container--open {
            width: 100px !important;
        }
        svg.feather.feather-calendar {
            height: 23px;
            width: 2rem;
        }
    </style>
@endpush
@section('content')
    @include('admin.layouts.inc.breadcrumb', ['array' => []])
    <div class="row">
        @forelse (getReports() as $item)
            @if (admin_can_any($item['permission']) == "true")
                <div class="col-md-4 col-lg-3 col-sm-6">
                    <a href="{{$item['url']}}" style="color: #5E5873;">
                        <div class="card card-statistics">
                            <div class="card-body statistics-body">
                                <div class="row">
                                    <div class="">
                                        <div class="d-flex flex-row align-items-center">
                                            <div class="avatar bg-light-danger me-2">
                                                <div class="avatar-content">
                                                    <i data-feather="box" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="my-auto">
                                                <h4 class="fw-bolder mb-0">{{$item['count']}}</h4>
                                                <p class="card-text font-small-3 mb-0">{{$item['title']}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
        @empty
        @endforelse
    </div>
    {{-- <div class="row">
        <!--Bar Chart Start -->
        <div class="col-xl-12 col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                    <div class="header-left">
                        <h4 class="card-title">@lang("Order Charts")</h4>
                    </div>
                    <div class="header-right d-flex align-items-center mt-sm-0 mt-1">
                        <i data-feather="calendar"></i>
                        <select name="year" class="select2 get_year">
                            @foreach($years as $year)
                                <option value="{{$year}}" @if($this_year == $year) selected @endif>{{$year}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <canvas class="bar-chart-ex chartjs" data-height="500"></canvas>
                </div>
            </div>
        </div>
        <!-- Bar Chart End -->
    </div> --}}
@endsection
{{-- @push('styles')
    <link rel="stylesheet" type="text/css" href="admin/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="admin/app-assets/css-rtl/plugins/forms/pickers/form-flat-pickr.css">
@endpush
@push('scripts')
    <script>
        var monthes         = [];
        var orders_count    = [];
        @foreach($all_data as $monthe)
            monthes.push("{{$monthe['month']}}");
            orders_count.push("{{$monthe['count']}}");
        @endforeach
    </script>
    <script src="admin/app-assets/vendors/js/charts/chart.min.js"></script>
    <script src="admin/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <script src="admin/app-assets/js/scripts/charts/chart-chartjs.js"></script>
    <script>
        $(".get_year").on('change', function () {
            var year = $(this).val();
            var route = _url_+'app/get_year/'+year;
            $.get(route, function(data) {
                console.log(data);
                if (data = "true") {
                    window.location.reload();
                }
            });
        });
    </script>
@endpush --}}
