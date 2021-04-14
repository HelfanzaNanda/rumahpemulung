@extends('layout.main')
@section('title', 'Client')

@section('content')
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
<main id="main">
    <!-- ======= profile Section ======= -->
    <section id="profile" class="profile">
        <div class="container">
            <h4>PROFIL</h4>
            <form action="{{ route('client.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Username</label>
                                    <input type="text" name="username" class="form-control" value="{{ old('username') ?? $user->username }}" >
                                    @error('username') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Lengkap</label>
                                    <input type="text" name="fullname" class="form-control" value="{{ old('fullname') ?? $user->fullname_client }}" >
                                    @error('fullname') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" name="email" readonly class="form-control" value="{{ $user->email_client }}" >
                                </div>
                                <div class="form-group">
                                    <label for="">Foto</label>
                                    <input type="file" name="photo" class="form-control" value="{{ old('photo') ?? $user->photo }}" >
                                    @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">No Hp</label>
                                    <input type="text" name="phone" class="form-control" value="{{ old('phone') ?? $user->phone_client }}" >
                                    @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <textarea name="address" class="form-control">{{ $user->address_client }}</textarea>
                                    @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <div class="row justify-content-between">
                                        <div class="mx-3">
                                            <label for="">Alamat Google</label>
                                        </div>
                                        <div class="mx-3">
                                            <a href="#" id="btn-open-maps">Buka Maps</a>
                                        </div>
                                    </div>
                                    <textarea id="address-google" name="address_google" readonly class="form-control">{{ $user->address_google }}</textarea>
                                    @error('address_google') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Latitude</label>
                                    <input type="text" id="lat" name="lat" class="form-control" value="{{ $user->latitude }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Longitude</label>
                                    <input type="text" id="lng" name="lng" class="form-control" value="{{ $user->longitude }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-2">
                    <button class="btn float-right btn-primary" type="submit">Update</button>
                    <a href="{{ route('client.profile') }}" class="btn float-right mr-2 btn-warning">Batal</a>
                </div>
            </form>
        </div>
    </section>
    <x-modal-maps/>
</main>
@endsection

@push('scripts')
    
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYY-wMcvr6cGuSynbDsfyABKsGzOlz9X0&libraries=places&callback=initMap">
</script>

<script>
    let map
    $(document).ready(function() {
        $('#btn-open-maps').on('click', function(e){
            e.preventDefault()
            let lat = "{{ $user->latitude ?? '-6.200000' }}"
            let lng = "{{ $user->longitude ?? '106.816666' }}"
            init(new google.maps.LatLng(lat, lng));
            $('#mapsModal').modal('show')
        })
    })
    
    function init(myLoc) {
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
        $('#address-google').val(address)
        // $('#input-lat').val('')
        // $('#input-lng').val('')
        // $('#input-address').val('')
        $('#mapsModal').modal('hide')
    });

    // $(document).on('show.bs.modal', '.modal', function () {
    //     google.maps.event.trigger(map, "resize");
    // });

    let form_data
    let url = "{{ url('client/') }}";
    $('form#form-add').submit( function(e) {
        e.preventDefault();
        addressSelected()
        form_data = new FormData( this );
        let date =$('#date').val()
        let qty = $('.qty').val()
        if (date == '') {
            $('.text-error').html('<p>tanggal tidak boleh kosong</p>')
            $('#modal-error').modal('show')
        }else if ($('#rbaddress3').is(':checked') && $('#rbaddress3val').val() == '') {
            $('.text-error').html('<p>Alamat tidak boleh kosong</p>')
            $('#modal-error').modal('show')
        }else if (qty == 0) {
            $('.text-error').html('<p>data sampah silahkan di isi lebih dari 0, minimal salah satu</p>')
            $('#modal-error').modal('show')
        }else{
            $('#modal-confirm-submit').modal('show')
        }
    })

    $(document).on('click', '.btn-submit', async function(e) {
        e.preventDefault()
        
        $('#modal-confirm-submit').modal('hide')
        $.ajax({
            type: 'post',
            url: url,
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            beforeSend: function() {
            },
            success: function(res) {
                if(res.status){
                    $('#modal-success').modal('show')
                    setTimeout(() => {
                        $('#modal-success').modal('hide')
                        window.location.href = "{{ url('history') }}"
                    }, 1000);
                } 
            }
        })
    })

    $('.btn-cancel').on('click', function(){
        window.location.href = "{{ url('history') }}"
    })

    

    function addressSelected() 
    {
        var addtermp = "";
        if (document.getElementById('rbaddress1').checked) {
            addtermp  = document.getElementById('rbaddress1val').innerHTML;
        } else if (document.getElementById('rbaddress2').checked) {
            addtermp  = document.getElementById('rbaddress2val').value;
        } else if (document.getElementById('rbaddress3').checked) {
            addtermp  = document.getElementById('rbaddress3val').value;
        }
        document.getElementById('address_pickup').value = addtermp;   
    }

</script>
@endpush