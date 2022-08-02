<hr>
@foreach ($data as $item)
    <div class="form-group row {!! displayErrorMessage($errors,$item['name'],false,true) !!}">
        <label class="col-lg-2 control-label text-semibold">@lang($item['label'])</label>
        <div class="col-lg-10">
            <input type="file" name="{{ $item['name'] }}" class="file-input form-control {{ $item['class'] }}" data-show-caption="true" data-show-upload="false" @if($item['multiple'] == true) multiple @endif>
            {!! displayErrorMessage($errors,$item['name']) !!}
        </div>
    </div>
@endforeach
