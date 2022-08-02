<?php 
    $array = [];
    if(isset($_GET['coun'])) {
        $array = explode(',',$_GET['coun']);
    }
?>
<div class="col-lg-12">
    <div class="form-group">
        <label for="profile-parent" class="control-label col-lg-2">@lang('Area')</label>
        <div class="col-lg-10">
            <select id="profile-parent" class="form-control" name="countries[]">
                @foreach ($lists as $country)
                    <option @if(in_array($country->id,$array)) selected @endif value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>