@extends('layoutadmin.main')

@section('title','Tambah Pemulung')
    
@section('contents')
<style>
    .pac-container { z-index: 100000 !important; }
    .search-address {
        z-index: 0;
        width: 55%;
        position: absolute;
        left: 175px;
        top: 0px;
        margin-top: 10px;
    }
</style>
    <!-- Begin Page Content -->
    <div class="container-fluid">

    

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header">
            <h3 class="card-title">Tambah Pemulung</h3>
        </div>
        <div class="card-body">
        <div class="table-responsive">
           <form action="{{ route('pemulung.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Nama Pemulung</label>
                                <input type="text" value="{{ old('nameof_collector') }}" name="nameof_collector" class="form-control">
                                @error('nameof_collector') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" value="{{ old('phone_collector') }}" name="phone_collector" class="form-control">
                                @error('phone_collector') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" value="{{ old('email_collector') }}" name="email_collector" class="form-control">
                                @error('email_collector') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Address</label>
                                <textarea name="address_collector" class="form-control" rows="2">{{ old('address_collector') }}</textarea>
                                @error('address_collector') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Photo</label>
                                <input type="file" name="photo" class="form-control" value="{{ old('photo') }}">
                                @error('photo') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <div class="row justify-content-between">
                                    <label>Google Address</label>
                                    <a href="#" id="gotomaps" title="Ambil Lokasi">Ambil Lokasi</i></a>
                                </div>                                
                                <textarea name="address_google" id="address_google" class="form-control"  rows="2">{{ old('address_google') }}</textarea>
                                @error('address_google') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-12">
                        <div class="form-group">
                          <label class="control-label">Latitude</label>
                          <div>
                            <input type="text" id="lat" value="{{ old('latitude') }}" name="latitude" placeholder="latitude ..." class="form-control form-control-user" readonly value="{{@$address->latitude}}">
                          </div>  
                        </div>
                      </div>
                      <div class="col-md-6 col-12">
                        <div class="form-group">
                          <label>Longitude</label>
                          <div>
                            <input type="text" id="lng" value="{{ old('longitude') }}" name="longitude" placeholder="longitude..." class="form-control form-control-user" readonly value="{{@$address->longitude}}">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group mt-5">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="{{ route('pemulung.index') }}" class="btn btn-secondary">Batal</a>
                                        </div>  
                                        <div class="col-md-6">
                                            <button type="reset" class="btn btn-danger btn-block">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group mt-5">
                                <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>

    <x-modal-maps/>

    </div>
    <!-- /.container-fluid -->
    <script>
            let lat = $('[name="latitude"]').val()
            let long = $('[name="longitude"]').val()
          //untuk mengambil maps
          var mapsnyaWe = () => {
              window.open(`<?php echo url('maps/?lat=${lat}&&long=${long}')?>`, 'popupwindow', 'scrollbars=yes, width=740,height=540');
              return false
          }
    
          function HandlePopupResult(hasil) {
              $('[name="latitude"]').val("" + hasil.lat);
              $('[name="longitude"]').val("" + hasil.lng);
              $('[name="address_google"]').val("" + hasil.address);
          }
    </script>


<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYY-wMcvr6cGuSynbDsfyABKsGzOlz9X0&libraries=places&callback=initMap">
</script>
    <script>

        $('#gotomaps').on('click', function() {
            init()
            $('#mapsModal').modal('show')
        })

        function init() {
            let lat = '-6.200000'
            let lng = '106.816666'
            myLoc = new google.maps.LatLng(lat, lng)
            let opt = {
                    center: myLoc,
                    zoom: 13,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById("map"), opt);
                const marker = new google.maps.Marker({ draggable: true});
                searchBox(marker, map);
                showMarker(marker, myLoc, map);

            map.addListener("click", (e) => {
                geocodePosition(e.latLng)
                showMarker(marker, e.latLng, map)
                
            });
            marker.addListener('dragend', function(e) {
                geocodePosition(e.latLng)
            })
            
        };

        function searchBox(marker, map) {
            let search_address = document.getElementById('search-address');
            const search_box = new google.maps.places.SearchBox(search_address);
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(search_address);
            map.addListener("bounds_changed", () => {
                search_box.setBounds(map.getBounds());
            });

            search_box.addListener('places_changed', function () {
                const places = search_box.getPlaces();
                let bounds = new google.maps.LatLngBounds();
                showMarker(marker, places[0].geometry.location, map);
                setLatLngView(places[0].geometry.location.lat(), places[0].geometry.location.lng())
                setAddressView(places[0].formatted_address);
                marker.bindTo('map', search_box, 'map');
                if (places[0].geometry.viewport) {
                    bounds.union(places[0].geometry.viewport);
                } else {
                    bounds.extend(places[0].geometry.location);
                }
                map.fitBounds(bounds);
                search_box.set('map', map);
                map.setZoom(Math.min(map.getZoom(),13));
            })
        }

        function showMarker(marker, myLoc, map){
            deleteMarkers(marker)
            marker.setPosition(myLoc);
            marker.setMap(map);
        }

        function deleteMarkers(marker) {
            marker.setMap(null)
        }

        function setLatLngView(lat, lng){
            $('#input-lat').val(lat);
            $('#input-lng').val(lng)
        }

        function setAddressView(address) {
            $('#input-address').val(address)
        }

        function  geocodePosition(pos) {
            const geocoder = new google.maps.Geocoder()
            geocoder.geocode({
                latLng: pos
            }, function(responses) {
                if (responses && responses.length > 0) {
                    setLatLngView(responses[0].geometry.location.lat, responses[0].geometry.location.lng)
                    setAddressView(responses[0].formatted_address)
                } else {
                    console.log('Cannot determine address at this location.');
                }
            });
        }

        $('#btn-ok').on('click', function() {
            let lat = $('#input-lat').val()
            let lng = $('#input-lng').val()
            let address = $('#input-address').val()
            $('#lat').val(lat)
            $('#lng').val(lng)
            $('#address_google').val(address)
            // $('#input-lat').val('')
            // $('#input-lng').val('')
            // $('#input-address').val('')
            $('#mapsModal').modal('hide')
        });
    </script>
@endsection