@extends('admin.layouts.master')
@section('head_title'){{__('Socials Settings')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Socials Settings'),
        'route' =>  ['settings.index','social'],
    ],
]])
<div class="card">
    <div class="card-header">
        <h5 class="card-title"> @lang("Edit Socials Settings") </h5>
    </div>
    <div class="card-body table-responsive">
        <form role="form" action="{{route('app.settings.update','social')}}" method="post" enctype="multipart/form-data" Files>
            @csrf
            <div class="form-body">
                <div class="form-group row">
                    <div class="col-sm-4">@lang("Social Type")</div>
                    <div class="col-sm-4">@lang("Social Link")</div>
                    <div class="col-sm-4">@lang("Showing Title")</div>
                </div>
                @if($contacts->count())
                    @foreach($contacts as $cn)
                        <div class="form-group row social_{{ $cn->id }}">
                            <div class="col-sm-3">
                                <select class="form-control norselect" name="type[]">
                                    @foreach(contactTypes() as $key=>$ct)
                                        <option @if($cn->type==$key) selected @endif value="{{$key}}">
                                                {{ $ct }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <input value="{{$cn->value}}" class="form-control" name="value[]" type="text">
                            </div>
                            <div class="col-sm-4">
                                <input value="{{$cn->class}}" class="form-control" name="class[]" type="text">
                            </div>
                            <div class="col-sm-1">
                                <a class="btn btn-danger remove-contact" data-id="{{ $cn->id }}">
                                    <center><b>X</b></center>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="add-other-content @if($contacts) style-0 @endif">
                    <?php $n = rand(1,50); ?>
                    <div class="form-group row social_{{ $n }}">
                        <div class="col-sm-3">
                            <select class="form-control norselect" name="type[]">
                                <option selected disabled>@lang("Choose")</option>
                                @foreach(contactTypes() as $key=>$ct)
                                    <option value="{{$key}}">
                                        {{ $ct }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <input class="form-control" name="value[]" type="text">
                        </div>
                        <div class="col-sm-4">
                            <input class="form-control" name="class[]" type="text">
                        </div>
                        <div class="col-sm-1">
                            <a class="btn btn-danger remove-contact" data-id="{{$n}}">
                                <center><b>X</b></center>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="other-contacts"></div>
                <div class="form-group row">
                    <a class="btn btn-success add-other col-sm-3" style="margin: 10px 40px;"> + @lang("Add Another Social")</a>
                </div>
            </div>
            @if(permissionCheck('settings.update'))
                <div class="form-actions right" style="clear:both">
                    {!! SubmitButton('Update') !!}
                </div>
            @endif

        </form>
    </div>
</div>
@endsection
@push("scripts")
    <script>
        // $(document).on('click', '.add-other',function () {
        //     var ct = $('.add-other-content').html();
        //     $('.other-contacts').append(ct);
        //     return false;
        // });

        $(document).on('click', '.add-other',function () {
            var parent = $(this).data('parent');
            var random = Math.floor(Math.random() * 100) + 1;
            var ct = '<div class="form-group row social_'+random+'">';
            ct += '<div class="col-sm-3">';
            ct += '<select class="form-control norselect" name="type[]">';
            ct += '<option selected disabled>@lang("Choose")</option>';
                @foreach(contactTypes() as $key=>$ct)
                    ct += '<option value="{{$key}}">';
                    ct += "{{ $ct }}";
                    ct += '</option>';
                @endforeach
            ct += '</select>';
            ct += '</div>';
            ct += '<div class="col-sm-4">';
            ct += '<input class="form-control" name="value[]" type="text">';
            ct += '</div><div class="col-sm-4">';
            ct += '<input class="form-control" name="class[]" type="text">';
            ct += '</div><div class="col-sm-1">';
            ct += '<a class="btn btn-danger remove-contact" data-id="'+random+'">';
            ct += '<center><b>X</b></center>';
            ct += '</a>';
            ct += '</div>';
            console.log(ct);
            $('.other-contacts').append(ct);
        });

        $(document).on('click', '.remove-contact',function () {
            var id = $(this).attr('data-id');
            $('.social_'+id+' select').val('');
            $('.social_'+id+' input[name="value[]"]').val('');
            $('.social_'+id+' input[name="class[]"]').val('');
            $('.social_'+id).hide();
        });

    </script>
@endpush
