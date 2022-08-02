@extends('admin.layouts.master')
@section('head_title'){{__('General Settings')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('General Settings'),
        'route' =>  ['settings.index','config'],
    ],
]])

<form role="form" action="{{route('app.settings.update','config')}}" method="post" enctype="multipart/form-data" Files>
    @csrf
    <div class="card">
        <div class="card-header">
            <h5 class="card-title"> @lang("Edit General Settings") </h5>
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
                            <div class="form-group row">
                                {!! Inputs('text', $key.'[title]', 'Title', 'form-control ', old($key.'.title', $setting->translate($key)->title??'')) !!}
                            </div>
                        </div>
                        <div class="form-body">
                            <div class="form-group row {{$errors->first($key.'.*') ? 'text-danger' : ''}}">
                                {!! TextArea($key.'[description]', 'Description', 'form-control', old($key.'.description', $setting->translate($key)->description??'')) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-2">@lang('Keywords')</label>
                            <div class="tag-field js-tags col-sm-10 ">
                                <input type="text" id="tag-input-{{$key}}" value="{{old($key.'.keywords', $setting->translate($key)->keywords??'')}}" name="{{$key.'[keywords]'}}">
                            </div>
                            @error($key.'.keywords')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                @endforeach
                <hr/>
                <div class="form-body">
                    <div class="form-group row">
                        {!! Inputs('text', 'address', 'Address', 'form-control', $setting->address??'') !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('email', 'email', 'Email', 'form-control', $setting->email??'') !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('number', 'phone', 'Phone', 'form-control', $setting->phone??'') !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('number', 'whatsapp', 'WhatsApp', 'form-control', $setting->whatsapp??'') !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('text', 'appstore', 'App Store', 'form-control', $setting->appstore??'') !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('text', 'googleplay', 'Google Play', 'form-control', $setting->googleplay??'') !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('file', 'logo', 'Logo', 'file-input logo form-control', $setting->logo_path) !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('file', 'footer_logo', 'Footer Logo', 'file-input footer_logo form-control', $setting->footer_logo_path) !!}
                    </div>
                </div>
                @if(permissionCheck('settings.update'))
                    <div class="text-right">
                        {!! SubmitButton('Update') !!}
                    </div>
                @endif
            </fieldset>
        </div>
    </div>
</form>
@endsection
@push('scripts')
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <script>
        @foreach(app_languages() as $key=>$one)
            var data = $('#tag-input-'+"{{$key}}").val();
            if (data.length != 0) {
                data = $('#tag-input-'+"{{$key}}").val().split(",");
            }
            var tagInput = new TagsInput({
                selector: 'tag-input-'+"{{$key}}",
                duplicate : false,
                max : 10
            }).addData(data);
        @endforeach
    </script>
    {{-- Logo --}}
    <script>
        $(".logo").fileinput({
            allowedFileExtensions: ['jpg', 'png', 'gif', 'svg'],
            initialCaption: "@lang('No File Selected')",
            overwriteInitial: false,
            initialPreview: [
                "{{$setting->logo_path}}"
            ],
            initialPreviewAsData: true,
            initialPreviewFileType: 'image',
            initialPreviewConfig: [
                {caption: "{{$setting->logo}}", url: _url_+"app/settings/remove_logo/{{$setting->id}}"}
            ],
        }).on("filepredelete", function(jqXHR) {
            var abort = true;
            if (confirm("{{__('Are you sure you want to delete this image?')}}")) {
                abort = false;
            }
            return abort;
        });
    </script>
    {{-- Footer Logo --}}
    <script>
        $(".footer_logo").fileinput({
            allowedFileExtensions: ['jpg', 'png', 'gif', 'svg'],
            initialCaption: "@lang('No File Selected')",
            overwriteInitial: false,
            initialPreview: [
                "{{$setting->footer_logo_path}}"
            ],
            initialPreviewAsData: true,
            initialPreviewFileType: 'image',
            initialPreviewConfig: [
                {caption: "{{$setting->footer_logo}}", url: _url_+"app/settings/remove_footer_logo/{{$setting->id}}"}
            ],
        }).on("filepredelete", function(jqXHR) {
            var abort = true;
            if (confirm("{{__('Are you sure you want to delete this image?')}}")) {
                abort = false;
            }
            return abort;
        });
    </script>
@endpush
