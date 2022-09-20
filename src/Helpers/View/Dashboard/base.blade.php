<div class="card-header">
    <h5 class="card-title"> {{$PageTitle}} </h5>
    @if(isset($data['lang']))
        @include('INPUTS::lang_header',['data'=>$data['lang']])
    @endif
</div>
<div class="card-body table-responsive">
    <form class="form-horizontal" action="{{ $data['route'] }}" method="post" enctype="multipart/form-data">
        <fieldset class="content-group">
            @if(isset($data['lang']))
                @include('INPUTS::lang',['data'=>$data['lang']])
                <hr>
            @endif
            <div class="form-body">
                @if(isset($data['inputs']))
                    @include('INPUTS::inputs',['data'=>$data['inputs']])
                @endif
                @if(isset($data['files']))
                    @include('INPUTS::image',['data'=>$data['files']])
                @endif
                @if(isset($moreData))
                    @include($moreData)
                @endif
            </div>
            <div class="clearfix"></div>
            <hr/>
            @csrf
            @if (isset($data['method']))
                @method($data['method'])
            @endif
            <div class="text-right">
                @if (isset($data['back_route']))
                    {!! BackButton('Back', $data['back_route']) !!}
                @endif
                {!! SubmitButton('Save') !!}
            </div>
        </fieldset>
    </form>
</div>
@push('styles')
    @if(isset($data['editor']))
        {{-- {!! assetAdmin('app-assets/summernote/summernote-bs4.min.css','css') !!} --}}
    @endif
@endpush
@push('scripts')
    @if(isset($data['editor']))
        <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
        <script>
            CKEDITOR.replace('editor');
            @foreach(app_languages() as $key=>$one)
            var editor = 'editor-'+"{{$key}}"
            console.log(editor);
                CKEDITOR.replace(editor);
            @endforeach
        </script>
        {{-- {!! assetAdmin('app-assets/summernote/summernote-bs4.min.js','js') !!}
        {!! assetAdmin('app-assets/summernote/form-editor.init.js','js') !!} --}}
    @endif
    @if(isset($data['files']))
        @if(isset($data['type']) && $data['type'] == "create")
            @foreach ($data['files'] as $item)
                <script>
                    var type = 'image';
                    var allowedFileExtensions = [];
                    if ("{{$item['type']}}" == 'video') {
                        type = 'video';
                        allowedFileExtensions = ['mp4', 'flv', 'mpeg'];
                    }else if("{{$item['type']}}" == 'file'){
                        type = 'file';
                        allowedFileExtensions = ['pdf'];
                    }else{
                        type = 'image';
                        allowedFileExtensions = ['jpg', 'png', 'gif', 'jpeg'];
                    }
                    $("."+"{{$item['class']}}").fileinput({
                        allowedFileExtensions: allowedFileExtensions,
                        initialCaption: "@lang('No File Selected')",
                    });
                </script>
            @endforeach
        @elseif (isset($data['type']) && $data['type'] == "update")
            @foreach ($data['files'] as $item)
                <script>
                    var type = 'image';
                    var allowedFileExtensions = [];
                    var initialPreview = [];
                    var initialPreviewConfig = [];
                    if ("{{$item['type']}}" == 'video') {
                        type = 'video';
                        allowedFileExtensions = ['mp4', 'mkv', '3gp', 'mpeg', 'ogg', 'wmv'];
                    }else if("{{$item['type']}}" == 'file'){
                        type = 'file';
                        allowedFileExtensions = ['pdf'];
                    }else{
                        type = 'image';
                        allowedFileExtensions = ['jpg', 'png', 'gif', 'jpeg'];
                    }
                    @if(isset($info))
                        @if(!is_array($info->{$item['name']}))
                            initialPreview.push("{!!$info->{$item['path']}!!}");
                            initialPreviewConfig.push({caption: "{!!$info->{$item['name']}!!}", url: _url_+"app/"+"{{$item['delete_url'].$info->id}}"});
                        @else
                            @foreach($info->{$item['name']} as $image)
                                initialPreview.push("{!!$image->{$item['path']}!!}");
                                initialPreviewConfig.push({caption: "{{$image->image}}", url: _url_+"app/"+"{{$item['delete_url'].$image->id}}"});
                            @endforeach
                        @endif
                    @endif
                    console.log(initialPreview);
                    console.log(initialPreviewConfig);
                    $("."+"{{$item['class']}}").fileinput({
                        allowedFileExtensions: allowedFileExtensions,
                        initialCaption: "@lang('No File Selected')",
                        overwriteInitial: false,
                        initialPreview: initialPreview,
                        initialPreviewAsData: true,
                        initialPreviewFileType: type,
                        // maxFileSize: 100,
                        initialPreviewConfig: initialPreviewConfig,
                    }).on("filepredelete", function(jqXHR) {
                        var abort = true;
                        if (confirm("{{__('Are you sure you want to delete this image?')}}")) {
                            console.log(jqXHR);
                            abort = false;
                        }
                        return abort;
                    });
                </script>
            @endforeach
        @endif
    @endif
@endpush
