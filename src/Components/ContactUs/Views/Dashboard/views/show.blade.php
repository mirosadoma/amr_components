@extends('admin.layouts.master')
@section('head_title'){{__('Show ContactUs')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => $Breadcrumb,'button' => $Button])
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endpush
<div class="content-body">
    <!-- Advanced Search -->
    <section id="advanced-search-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title"> @lang("Show ContactUs") </h5>
                    </div>
                    <div class="card-body table-responsive">
                        <fieldset>
                            <table class="table datatable-basic">
                                <thead>
                                    <tr>
                                        <th {!! \table_width_head(10) !!}>@lang("ID")</th>
                                        <td>{{$contact_us->id}}</td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(10) !!}>@lang("Sender Name")</th>
                                        <td>{{$contact_us->name ?? '----------'}}</td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(10) !!}>@lang("Sender Email")</th>
                                        <td>{{$contact_us->email ?? '----------'}}</td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(10) !!}>@lang("Sender Phone")</th>
                                        <td>{{$contact_us->phone ?? '----------'}}</td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(10) !!}>@lang("Message Content")</th>
                                        <td>{{$contact_us->message ?? '----------'}}</td>
                                    </tr>
                                    @if(permissionCheck('contact_us.update'))
                                        <tr>
                                            <th {!! \table_width_head(10) !!}>@lang("Replay")</th>
                                            <td>
                                                @if(isset($contact_us->reply))
                                                    <div class="form-control" style="background-color: #e9ecef;">{!! $contact_us->reply !!}</div>
                                                @else
                                                    <form class="form-horizontal" method="POST" action="{{ route('app.contactus.update',[$contact_us->id]) }}">
                                                        {!! isset($contact_us) ? method_field('PATCH') : '' !!}
                                                        @csrf
                                                        <textarea class="form-control" name="reply" id="reply" placeholder="{{__("Reply")}}">{!! $contact_us->reply !!}</textarea>
                                                        @error('reply')
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <div class="border-top">
                                                            <div class="card-body text-left">
                                                                <button type="submit" class="btn btn-primary">@lang('Send')</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th {!! \table_width_head(10) !!}>@lang("Message Timing")</th>
                                        <td>{{ isset($contact_us->created_at) ? $contact_us->created_at->diffForHumans() :__('Not Found') }}</td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(10) !!}>@lang("Message Date")</th>
                                        <td>{{ isset($contact_us->created_at) ? $contact_us->created_at->format('Y-m-d') : __('Not Found') }}</td>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <br/>
                            <div class="text-right">
                                {!! BackButton('Back', route('app.contactus.index')) !!}
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Components\ContactUs\Requests\Dashboard\UpdateRequest') !!}
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <script>
        // CKEDITOR.replace('reply');
    </script>
@endpush
