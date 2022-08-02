@extends('admin.layouts.master')
@section('head_title'){{__('Maintenance Mode')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Maintenance Mode'),
        'route' =>  ['settings.index','maintenance'],
    ],
]])
<div class="card">
    <div class="card-header">
        <h5 class="card-title"> @lang("Edit Maintenance Mode") </h5>
    </div>
    <div class="card-body table-responsive">
        <form class="form-horizontal" action="{{route('app.settings.update','maintenance')}}" method="post" enctype="multipart/form-data" Files>
            @csrf
            <fieldset>
                <div class="form-body">
                    <div class="form-group row">
                        <label class="control-label col-sm-2">@lang('Status')</label>
                        <div class="input-icon right col-sm-10">
                            <select class="select-search form-control" name="close">
                                <option value="0" @if(old('close', $setting->close) == 0) selected @endif>@lang('Open')</option>
                                <option value="1" @if(old('close', $setting->close) == 1) selected @endif>@lang('Close')</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! TextArea('close_msg', 'Close Messages', 'form-control', $setting->close_msg??'', true) !!}
                    </div>
                </div>
                @if(permissionCheck('settings.update'))
                    <div class="form-actions right" style="clear:both">
                        {!! SubmitButton('Update') !!}
                    </div>
                @endif
            </fieldset>
        </form>
    </div>
</div>
@endsection
@push('scripts')
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor');
    </script>
@endpush
