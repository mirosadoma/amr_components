@extends('admin.layouts.master')
@section('head_title'){{__('Send Notification')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Notifications'),
        'route' =>  'notifications.index',
    ],
    [
        'name'  =>  __('Send Notification'),
        'route' =>  'notifications.create',
    ],
],'button' => [
        'title' => __('Back To Notifications'),
        'route' =>  'notifications.index',
        'icon'  => 'arrow-left'
]])

<form class="form-horizontal" action="{{route('app.notifications.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-header">
            <h5 class="card-title"> @lang("Send Notification") </h5>
            <ul class="nav nav-tabs" role="tablist">
                @foreach(app_languages() as $key=>$one)
                    <li class="nav-item {{ $key == app()->getLocale() ? 'active' : '' }} tab-lang" data-id="tab-{{$key}}">
                        <a class="nav-link {{$errors->first($key.'.*') ? 'text-danger' : ''}}"  data-toggle="tab" href="#" role="tab">
                            <span class="hidden-sm-up"></span> <span class="hidden-xs-down">{{ $one['native'] }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="card-body table-responsive">
            <fieldset>
                @foreach(app_languages() as $key=>$one)
                    <div class="tab-pane {{ $key == app()->getLocale() ? 'active' : '' }}" id="tab-{{$key}}" role="tabpanel">
                        <div class="form-body">
                            <div class="form-group row {{$errors->first($key.'.*') ? 'text-danger' : ''}}">
                                {!! Inputs('text', $key.'[title]', 'Title', 'form-control ', old($key.'.title')) !!}
                            </div>
                            <div class="form-group row {{$errors->first($key.'.*') ? 'text-danger' : ''}}">
                                {!! TextArea($key.'[message]', 'Message', 'form-control ', old($key.'.message'), true) !!}
                            </div>
                        </div>
                    </div>
                @endforeach
                <hr/>
                <div class="form-body">
                    <div class="form-group row">
                        <label class="form-label col-sm-2" for="select2-basic">@lang('Clients')</label>
                        <div class="input-icon right col-sm-10">
                            <select class="select-search form-control {{ $errors->has('users') ? ' is-invalid' : '' }}" id="select1-basic" name="clients[]" id="clients" multiple>
                                <option value="0" disabled>@lang("Choose")</option>
                                <option value="all">@lang("All Clients")</option>
                                @forelse($clients as $client)
                                    <option value="{{$client->id}}">{{$client->name}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    {!! BackButton('Back', route('app.notifications.index')) !!}
                    {!! SubmitButton('Save') !!}
                </div>
            </fieldset>
        </div>
    </div>
</form>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Components\Notifications\Requests\Dashboard\StoreRequest') !!}
@endpush