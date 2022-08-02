<div class="form-group row">
    <label for="location" class="control-label col-sm-2">@lang("Geographical location")</label>
    <div class="input-div col-lg-10">
        <input type="hidden" id="map-lat" name="lat">
        <input type="hidden" id="map-lng" name="lng">
        <input required name="address" value="{{old('address', isset($client) ? $client->address : '')}}" class="aFixx form-control mapButton" id="map-address" placeholder="{{__('Enter the geographic location')}}" style="padding-inline-start: 5px; border-radius: 0;">
        <input type="hidden" id="locationBtn">
        <div id="mapi" style="height:300px;">
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript"
        src='//maps.google.com/maps/api/js?key={{env('MAP_KEY')}}&sensor=false&libraries=places&language=ar'>
    </script>
    <!-- map -->
    <script>
        var mapDiv = document.getElementById('mapi');
    var geocoder = new google.maps.Geocoder;
    var infoWindow = new google.maps.InfoWindow;
    // Set the Map
    var itemlat = parseFloat("{{ $client->lat ?? '24.69023' }}");
    var itemlng = parseFloat("{{ $client->lng ?? '46.685' }}");
    var map = new google.maps.Map(mapDiv, {
        center: {
            lat: itemlat,
            lng: itemlng
        },
        zoom: 10
    });
    // Set the Markers
    var marker = new google.maps.Marker({
        position: {
            lat: itemlat,
            lng: itemlng
        },
        map: map,
        icon: "{{ asset('assets/marker.png') }}",
        draggable: true,
        animation: google.maps.Animation.xo
    });
    //auth complete box
    var defaultBounds = new google.maps.LatLngBounds(
        new google.maps.LatLng(itemlat, itemlng),
        new google.maps.LatLng(itemlat, itemlng));
    var input = document.getElementById('map-address');
    var options = {
        bounds: defaultBounds,
        types: ['establishment']
    };
    autocomplete = new google.maps.places.Autocomplete(input, options);
    autocomplete.addListener('place_changed', fillInAddress);
    function fillInAddress() {
        marker.setPosition(autocomplete.getPlace().geometry.location);
        var lat = autocomplete.getPlace().geometry.location.lat();
        var lng = autocomplete.getPlace().geometry.location.lng();
        $('#map-lat').val(lat);
        $('#map-lng').val(lng);
        var center = new google.maps.LatLng(lat, lng);
        map.setCenter(center);
    }
    function run_map() {
        setLocation(map, geocoder, marker);
        start_location();
        google.maps.event.addListener(map, 'click', function (event) {
            marker.setPosition(event.latLng);
            setLocation(map, geocoder, marker);
        });
        // Set Address manually
        google.maps.event.addListener(marker, 'dragend', function () {
            setLocation(map, geocoder, marker);
        });
        google.maps.event.addListener(marker, 'center_changed', function () {
            setLocation(map, geocoder, marker);
        });
    }
    function setLocation(map, geocoder, marker) {
        var lat = marker.getPosition().lat();
        var lng = marker.getPosition().lng();
        $('#map-lat').val(lat);
        $('#map-lng').val(lng);
        $('#map-address').trigger('change');
        map.setZoom(map.getZoom() + 1);
        geocoder.geocode({
            'latLng': marker.getPosition()
        }, function (results, status) {
            $('#map-address').val(results[0]['formatted_address']);
        });
    }
    run_map();
    @if(isset($client) && $client->id && $client->lat && $client->lng)
        $(this).removeClass('openMap');
        function start_location(){
            var myPosition = new google.maps.LatLng("{{ $client->lat }}", "{{ $client->lng }}");
                    map.setCenter(myPosition);
                    marker.setPosition(myPosition);
            geocoder.geocode({
                'latLng': myPosition
            }, function (results, status) {
                $('#map-address').val(results[0]['formatted_address']);
            });
        }
        // console.log(itemlng);
        
    @else
        function start_location(){
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    var myPosition = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                    map.setCenter(myPosition);
                    marker.setPosition(myPosition);
                    geocoder.geocode({
                        'latLng': myPosition
                    }, function (results, status) {
                        $('#map-address').val(results[0]['formatted_address']);
                    });
                }, function () {
                    try {
                    handleLocationError(true, infoWindow, map.getCenter());
                    }
                    catch(err) {
                    console.log(err.message);
                    }

                });
            } else {
                // Browser doesn't support Geolocation
                try {
                    handleLocationError(false, infoWindow, map.getCenter());
                }
                catch(err) {
                console.log(err.message);
                }
                
            }
        }
    @endif

    </script>
@endpush