@foreach ($view_config as $key=>$values)
@if(!empty($values))
@push($key)
@foreach ($values as $item)
@if($key == 'styles')
{!! AssetsAdmin($item) !!}
@else
{!! AssetsAdmin($item,'js') !!}
@endif
@endforeach
@endpush
@endif
@endforeach