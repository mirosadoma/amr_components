@if($type != 'textarea')
    <div class='form-group'>
        <label for='{{$name}}' class='control-label col-lg-2'>{{$label}}</label>
        <div class='col-md-10'>
            @error("{$name}")<p class="text-danger">{{ $message ?? '' }}</p>@enderror
            <input dir='auto' id='{{$name}}' type='{{$type}}' $autocomplete class='form-control' name='{{$name}}'
            value='{{$value}}' />
        </div>
    </div>
@else
    <div class='form-group'>
        <label for='{{$name}}' class='control-label col-lg-2'>{{$label}}</label>
        <div class='col-md-10'>
            @error("{$name}")<p class="text-danger">{{ $message ?? '' }}</p>@enderror
            <textarea dir='auto' id='{{$name}}' class='form-control' name='{{$name}}'
                rows="7">{{$value}}</textarea>
        </div>
    </div>
@endif