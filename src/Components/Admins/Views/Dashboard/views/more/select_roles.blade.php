<div class="form-group row">
    <label class="control-label col-sm-2">@lang('Roles')</label>
    <div class="input-icon right col-sm-10">
        <select class="select-search form-control" name="role_name">
            <option value="0"selected>@lang("Choose")</option>
            @foreach ($roles as $role)
                <option value="{{$role->name}}" @if($info && $info->hasRole($role->name) == $role->name) selected @endif>{{$role->name}}</option>
            @endforeach
        </select>
    </div>
</div>