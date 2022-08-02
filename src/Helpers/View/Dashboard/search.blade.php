@if(isset($search) && count($search['inputs']))
    <div class="card-header border-bottom">
        <h4 class="card-title">@lang('Advanced Search')</h4>
        <div class="card-title">
            <button class="btn btn-primary btn-round waves-effect waves-float waves-light" title="{{__("Search")}}" style="padding: 10px 25px;" type="button" onclick="$('.dt_adv_search').submit()"><i data-feather="database"></i></button>
            <button class="btn btn-warning btn-round waves-effect waves-float waves-light form-reset" title="{{__("Reset Search Data")}}" style="padding: 10px 25px;" type="button" onclick="resetForm();"><i data-feather="minus-circle"></i></button>
        </div>
    </div>
    <div class="card-body mt-2">
        <form class="dt_adv_search" method="GET">
            <div class="row g-1 mb-md-1">
                @foreach ($search['inputs'] as $item)
                    @if ($item['type'] == 'select')
                        @if(!request()->has('type') || (request('type') != "active" && request('type') != "unactive"))
                            <div class="col-md-4">
                                <label class="form-label" for="select2-basic">@lang('Status')</label>
                                <select class="select-search" id="select2-basic" name="is_active">
                                    <option value="">@lang("Choose")</option>
                                        @foreach ($item['value'] as $key => $val)
                                            <option value="{{$key}}" @if(!is_null(request($item['name'])) && request($item['name']) == $key) selected @endif>{{$val}}</option>
                                        @endforeach
                                </select>
                            </div>
                        @endif
                    @elseif ($item['type'] == 'date')
                        <div class="col-md-4">
                            <label class="form-label">@lang($item['label'])</label>
                            <input type="{{$item['type']}}" name="{{$item['name']}}" class="form-control dt-input" data-column="6" value="{{old($item['name'], request($item['name']))}}" data-column-index="5" />
                        </div>
                    @else
                        <div class="col-md-4">
                            <label class="form-label">@lang($item['label'])</label>
                            <input type="{{$item['type']}}" name="{{$item['name']}}" class="form-control dt-input dt-full-{{$item['name']}}" value="{{old($item['name'], request($item['name']))}}" data-column="1" placeholder="{{$item['label']}}" data-column-index="0" />
                        </div>
                    @endif
                @endforeach
            </div>
            <input type="hidden" name="filter" value="1"/>
        </form>
    </div>
    <hr class="my-0" />
@endif
