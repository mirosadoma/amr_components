@extends('admin.layouts.master')
@section('head_title'){{__('Add Role')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Roles'),
        'route' =>  'roles.index',
    ],
    [
        'name'  =>  __('Add Role'),
        'route' =>  'roles.create',
    ],
],'button' => [
        'title' => __('Back To Roles'),
        'route' =>  'roles.index',
        'icon'  => 'arrow-left'
]])
<form class="form-horizontal" action="{{route('app.roles.store')}}" method="post" enctype="multipart/form-data">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title"> @lang("Add Role") </h5>
        </div>
        <div class="card-body table-responsive">
            <fieldset>
                @csrf
                <div class="form-body">
                    <div class="form-group row">
                        <label class="control-label col-lg-2">@lang("Name")</label>
                        <div class="col-lg-10">
                            <input type="text" name="name" onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122)" placeholder="{{__("Name")}}" class="form-control" value="{{old('name')}}">
                        </div>
                        @error('name')<p class="text-danger">{{ $message }}</p>@enderror
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
    <div class="row">
        @forelse(get_permissions() as $item => $permissions)
            <div class="col-lg-4 col-md-6 col-sm-12 col-xl-3">
                <div class="card">
                    <div class="btn btn-primary check-all" data-num="{{count($permissions)}}">
                        <h4 class="card-title text-white m-0">@lang(ucfirst($item))</h4>
                    </div>
                    <div class="comment-widgets">
                        <div class="card-body">
                            @forelse($permissions as $permission)
                                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                    <input name="permissions[]" type="checkbox" class="custom-control-input" id="{{$item.'.'.$permission}}" value="{{$item.'.'.$permission}}">
                                    <label class="custom-control-label" for="{{$item.'.'.$permission}}">
                                    @lang(ucfirst($permission))
                                    </label>
                                </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        @empty
        @endforelse
    </div>
    <div class="text-right">
        {!! BackButton('Back', route('app.roles.index')) !!}
        {!! SubmitButton('Save') !!}
    </div>
</form>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Components\Roles\Requests\Dashboard\StoreRequest') !!}
    <script>
        $('.check-all').on('click',function(){
            var _this = this;
            if ($(_this).hasClass('btn-primary')) {
                $(_this).parents('.card').children().find('input[type=checkbox]').prop("checked", true);
                $(_this).removeClass('btn-primary');
                $(_this).addClass('btn-warning');
            }else{
                $(_this).parents('.card').children().find('input[type=checkbox]').prop("checked", false);
                $(_this).removeClass('btn-warning');
                $(_this).addClass('btn-primary');
            }
        });
    </script>
@endpush