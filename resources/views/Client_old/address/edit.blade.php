@extends('Client.layouts.layout')
@section('content')

    <div class="top_img py-4" style="height: 100px">
        <div class="container"></div>
    </div>

    <div class="cart_2 my-4">
        <div class="container">
            <div class="row my-4">
                <div class="col-12 col-md-6">
                    <div class="m-2">
                        <form method="POST" action="{{ route('Client.address.update', $address['id']) }}">
                            @csrf
                            
                            @php($country_id = $address->region['country_id'])


                            @method('PUT')
                            <input id="lat" type="hidden" name="lat" required value="{{ $address['lat'] }}">
                            <input id="long" type="hidden" name="long" required value="{{ $address['long'] }}">
                            <div class="my-2">
                                <span class="main_bold p-2">@lang('trans.country')</span>
                                <select name="country_id" id="country_id" class="border rounded p-2 w-100">
                                    <option value="" disabled hidden selected>@lang('trans.Select')</option>
                                    @foreach(Countries() as $Country)
                                        <option {{ $country_id == $Country['id'] ? 'selected' : '' }} value="{{ $Country['id'] }}">{{ $Country['title_' . lang()] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="my-2">
                                <span class="main_bold p-2 {{ $country_id != 2 ? 'd-none' : '' }} BahrainCountry">@lang('trans.region')</span>
                                <span class="main_bold p-2 {{ $country_id == 2 ? 'd-none' : '' }} OtherCountries">@lang('trans.city')</span>
                                <select name="region_id" id="region_id" class="border rounded p-2 w-100">
                                    <option value="" disabled hidden selected>@lang('trans.Select')</option>
                                    @foreach($regions as $region)
                                        <option {{ $address['region_id'] == $region['id'] ? 'selected' : '' }} value="{{ $region['id'] }}">{{ $region['title_' . lang()] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="my-2">
                                <span class="main_bold p-2 {{ $country_id != 2 ? 'd-none' : '' }} BahrainCountry">@lang('trans.block')</span>
                                <span class="main_bold p-2 {{ $country_id == 2 ? 'd-none' : '' }} OtherCountries">@lang('trans.district')</span>
                                <input type="text" name="block" class="border rounded p-2 w-100" value="{{ $address['block'] }}">
                            </div>
                            <div class="my-2">
                                <span class="main_bold p-2 {{ $country_id != 2 ? 'd-none' : '' }} BahrainCountry">@lang('trans.road')</span>
                                <span class="main_bold p-2 {{ $country_id == 2 ? 'd-none' : '' }} OtherCountries">@lang('trans.street')</span>
                                <input type="text" name="road" class="border rounded p-2 w-100" value="{{ $address['road'] }}">
                            </div>
                            <div class="my-2">
                                <span class="main_bold p-2">@lang('trans.building_no')</span>
                                <input type="text" name="building_no" class="border rounded p-2 w-100" value="{{ $address['building_no'] }}">
                            </div>
                            <div class="my-2">
                                <span class="main_bold p-2">@lang('trans.floor_no')</span>
                                <input type="text" name="floor_no" class="border rounded p-2 w-100" value="{{ $address['floor_no'] }}">
                            </div>
                            <div class="my-2">
                                <span class="main_bold p-2">@lang('trans.apartmentNo')</span>
                                <input type="text" name="apartment" class="border rounded p-2 w-100" value="{{ $address['apartment'] }}">
                            </div>
                            <div class="my-2">
                                <span class="main_bold p-2">@lang('trans.type')</span>
                                <input type="text" name="type" class="border rounded p-2 w-100" value="{{ $address['type'] }}">
                            </div>
                            <div class="my-2">
                                <span class="main_bold p-2">@lang('trans.additionalDirection')</span>
                                <textarea name="additional_directions" class="border rounded p-2 w-100" rows="6">{{ $address['additional_directions'] }}</textarea>
                            </div>
                            
                            
                            
                            
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="submit" class="mx-2 main_btn transition_me w-100 py-3 border-0 rounded">@lang('trans.save')</button>
                                <button href="{{ route('Client.address.index') }}" class="mx-2 bt_details_reverce transition_me w-100 py-3 border-0 rounded text-center">@lang('trans.cancel')</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mx-2 my-4">
                        <div class="form-group" id="map" style="height: 600px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    
<script>
    var map;
    var markers = [];

    function initMap() {
        var haightAshbury = {lat: parseFloat('{{ $address['lat'] }}'), lng: parseFloat('{{ $address['long'] }}')};

        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: haightAshbury,
            mapTypeId: 'terrain'
        });

        $('#lat').val('{{ $address['lat'] }}');
        $('#long').val('{{ $address['long'] }}');
        // This event listener will call addMarker() when the map is clicked.
        map.addListener('click', function(event) {
            addMarker(event.latLng);
            var latitude = event.latLng.lat();
            var longitude = event.latLng.lng();
            $('#lat').val(latitude);
            $('#long').val(longitude);

        });

        // Adds a marker at the center of the map.
        addMarker(haightAshbury);
    }

    // Adds a marker to the map and push to the array.
    function addMarker(location) {
        clearMarkers();
        var marker = new google.maps.Marker({
            position: location,
            map: map
        });
        markers.push(marker);
    }

    // Sets the map on all markers in the array.
    function setMapOnAll(map) {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
        }
    }

    // Removes the markers from the map, but keeps them in the array.
    function clearMarkers() {
        setMapOnAll(null);
    }

    // Shows any markers currently in the array.
    function showMarkers() {
        setMapOnAll(map);
    }

    // Deletes all markers in the array by removing references to them.
    function deleteMarkers() {
        clearMarkers();
        markers = [];
    }

    $(document).ready(function () {


        $("#lat").on("input", function(){
            // // Print entered value in a div box
            var lat=$("#lat").val();
            var lang=$("#long").val();

            var haightAshbury =  {lat: parseFloat('{{ $address['lat'] }}'), lng: parseFloat('{{ $address['long'] }}')};
            haightAshbury["lat"]=Number(lat);
            haightAshbury["lng"]=Number(lang);

            // Adds a marker at the center of the map.
            addMarker(haightAshbury);


            console.log(haightAshbury);
        });


        $("#long").on("input", function(){
            // // Print entered value in a div box
            var lat=$("#lat").val();
            var lang=$("#long").val();

            var haightAshbury =  {lat: parseFloat('{{ $address['lat'] }}'), lng: parseFloat('{{ $address['long'] }}')};
            haightAshbury["lat"]=Number(lat);
            haightAshbury["lng"]=Number(lang);

            // Adds a marker at the center of the map.
            addMarker(haightAshbury);


            console.log(haightAshbury);
        });
    });
</script>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_KEY') }}&callback=initMap">
</script>
<script>
    $(document).on("change", "#country_id", function () {
        if($('#country_id option:selected').val() == 2){
            $('.BahrainCountry').removeClass('d-none');
            $('.OtherCountries').addClass('d-none');
        }else{
            $('.BahrainCountry').addClass('d-none');
            $('.OtherCountries').removeClass('d-none');
        }
        $.ajax({
            type:'POST',
            url:'/country_regions/'+$('#country_id option:selected').val(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            },
            success:function(data){
                $('#region_id').empty().append(data);
            },
            error: function (xhr, exception) {
                var msg = "";
                if (xhr.status === 0) {
                    msg = "Not connect.\n Verify Network." + xhr.responseText;
                } else if (xhr.status == 404) {
                    msg = "Requested page not found. [404]" + xhr.responseText;
                } else if (xhr.status == 500) {
                    msg = "Internal Server Error [500]." +  xhr.responseText;
                } else if (exception === "parsererror") {
                    msg = "Requested JSON parse failed.";
                } else if (exception === "timeout") {
                    msg = "Time out error." + xhr.responseText;
                } else if (exception === "abort") {
                    msg = "Ajax request aborted.";
                } else {
                    msg = "Error:" + xhr.status + " " + xhr.responseText;
                }
               console.log(msg);
            }
        }); 
    });
</script>

@endpush