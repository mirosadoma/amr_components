@extends('admin.layouts.master')
@section('head_title'){{$PageTitle}}@endsection
@section('content')
    @include('admin.layouts.inc.breadcrumb', ['array' => $Breadcrumb,'button' => $Button??[]])
    @push('styles')
        <style>
            svg.feather.feather-loader.spinner {
                width: 25px !important;
                height: 25px !important;
            }
        </style>
    @endpush
    <div class="card">
        @include('INPUTS::base',["data"=>$data])
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest($ValidaionPath) !!}
@endpush
