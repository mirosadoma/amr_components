<div class="col-lg-12">
<fieldset>
    <legend class="text-semibold"><i
            class="icon-map4 position-left"></i> @lang('Map')</legend>

    <div class="form-group">
        @if(!isset($info->location))
            <input type="hidden" name="location" value="" id="order-address">
            <input type="hidden" name="address_name" id="pac-input" style=" width: 100%; border: 0px; " placeholder="@lang('Search for your location')">
        @else
            <?php 
                $location = explode(',',$info->location);
                $address = [
                    'address_name'  => $info->address_name,
                    'lat'           => $location[0],
                    'lang'          => $location[1]
                ];
            ?>
            <input type="hidden" name="location" value="{{ json_encode($address) }}" id="order-address">
            <input type="hidden" 
            data_lat="{{ $address['lat'] ?? '24.654757' }}" 
            data_lang="{{ $address['lang'] ?? '46.588677' }}" 
            value="{{ $address['address_name'] ?? '' }}" 
            name="address_name" id="pac-input" style=" width: 100%; border: 0px; " placeholder="@lang('Search for your location')">
        @endif
        <div class="map" id="googleMap" style="width: 100%; height: 500px;"></div>
    </div>
    
</fieldset>
</div>
@push('scripts')
<script type="text/javascript"
src="https://maps.googleapis.com/maps/api/js?region=SA&language={{App::getLocale()}}&key=AIzaSyBwvVxeOwH1&libraries=places"></script>
@if(!isset($info->location))
    {!! assetAdmin2('js/map.js','js') !!}
@else
    {!! assetAdmin2('js/map2.js','js') !!}
@endif
@endpush