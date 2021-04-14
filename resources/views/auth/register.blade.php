@extends('layout.main')
@section('title', 'Register')

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
<br><br>
<div class="container" style="margin-top:20px">
    <br><br>
    <div class="heading-title text-center">
        <h3>Sign Up Account</h3>
    </div>
    
    @if( Session('gagal') )
    <div class="alert alert-danger notifku">
        <div>{{ Session('gagal') }}</div>
    </div>
    @endif
    @if( Session('berhasil'))
    <div class="alert alert-success notifku">
        <div>{{ Session('berhasil') }}</div>
    </div>
    @endif

    <form id="form" action="#" method="post" class="form-horizontal" 
    enctype="multipart/form-data">
        @csrf
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="form-group has-error">
                    <label for="fullname" class="col-md-4 control-label"><b>Nama</b></label>
                    <input id="fullname" type="text" class="form-control" 
                    name="fullname" value="{{ old('fullname') }}" required 
                    placeholder="Fullname" autofocus>
                    @error('fullname') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                            
                <div class="form-group">
                    <label for="username" class="col-md-4 control-label"><b>Username</b></label>
                    <input id="username" type="text" class="form-control" name="username" 
                    value="{{ old('username') }}" required placeholder="Fullname" autofocus>
                    @error('username') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                            
                <div class="form-group">
                    <label for="phone" class="col-md-4 control-label"><b>no. Telepon</b></label>
                    <input id="phone" type="number" class="form-control" name="phone" 
                    placeholder="No.Telepon" required autofocus>
                    @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                            
                <div class="form-group">
                    <label for="pickup_country" class="col-md-4 control-label"><b>Alamat</b></label>
                    <textarea name="address" rows="3" class="form-control" required> </textarea>
                    {{-- <input type="text" id="pickup_country" name="address" rows="3" class="form-control" placeholder="Address" autofocus> --}}
                    @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="photo" class="col-md-4 control-label"><b>Photo</b></label>
                    <input id="photo" type="file" class="form-control" required 
                    name="photo" placeholder="" autofocus>
                    @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-md-6 border-left">
                <div class="form-group">
                    <label class="col-md-4 control-label"><b>Address Maps</b></label>
                    <textarea name="address_google" id="address_google" 
                    required class="form-control" readonly  rows="2"></textarea>
                    @error('address_google') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <input type="hidden" id="lat" name="latitude" placeholder="latitude ..." 
                class="form-control form-control-user" readonly value="{{@$address->latitude}}">
                     
                <input type="hidden" id="lng" name="longitude" placeholder="longitude..." 
                class="form-control form-control-user" readonly value="{{@$address->longitude}}">
                <div class="form-group">
                    <label for="email" class="col-md-4 control-label"><b>E-Mail</b></label>
                    <input id="email" type="text" class="form-control" name="email" required
                    placeholder="Email" value="{{ old('email') }}" autofocus>
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                            
                <div class="form-group">
                    <label for="password" required class="col-md-4 control-label"><b>Password</b></label>
                    <input id="password" type="password" class="form-control" name="password" 
                    placeholder="Password" autofocus required>
                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                            
                <div class="form-group">
                    <label for="password-confirm"  class="col-md-6 control-label"><b>Confirm Password</b></label>
                    <input id="password-confirm" required type="password" class="form-control" 
                    name="password_confirmation" placeholder="confirm password">
                    @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group" align="left">
                    <p>To create an account you have to agree our 
                    <a class="btn-link" target="_blank" href="https://rumahpemulung.com/id/privacy.html">
                    Terms & Privacy</a>.</p> 
                </div>

				<div class="col-md-12">
					<div class="submit-button text-center">
						<button class="btn btn-regis" id="submit" type="submit"
                        data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Loading ..."
                        >Daftar</button>
						{{-- <div id="msgSubmit" class="h3 text-center hidden"></div>
						<div class="clearfix"></div> --}}
					</div>
				</div>
            </div>
        </form>
    </div>
</div>

<x-modal-maps/>
<x-modal-confirm-submit/>
<x-modal-success-register/>
<x-modal-error/>
<br><br><br>
@endsection

@push('scripts')
<script>
    let map
    $(document).ready(function() {
        $('#address_google').on('click', function() {
            let lat = -6.200000
            let lng = 106.816666
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
        $('#address_google').val(address)
        // $('#input-lat').val('')
        // $('#input-lng').val('')
        // $('#input-address').val('')
        $('#mapsModal').modal('hide')
    });

    // $(document).on('show.bs.modal', '.modal', function () {
    //     google.maps.event.trigger(map, "resize");
    // });

    let form_data
    let url = "{{url('/register')}}";
    $('form#form').submit( function(e) {
        e.preventDefault();
        form_data = new FormData( this );
        $('#modal-confirm-submit').modal('show')
    })

    $(document).on('click', '.btn-submit', async function(e) {
        let loading = $('.btn-regis').data('loading-text');
        $('.btn-regis').html(loading).attr('disabled', true)
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
                $('.btn-regis').html('Daftar').attr('disabled', false)
                if(res.status){
                    $('.text-successfully').text(res.message)
                    $('#modal-success-register').modal('show')
                    // setTimeout(() => {
                    //     $('#modal-success-register').modal('hide')
                    //     window.location.reload()
                    // }, 1000);
                }
            },
            error : function(xhr) {
                $('.btn-regis').html('Daftar').attr('disabled', false)
                if (xhr.status == 422) {
                    $('.text-error').html('<p>'+Object.entries(xhr.responseJSON.errors)[0][1]+'</p>')
                    $('#modal-error').modal('show')
                }
            }
        })
    })

    $('.btn-success-register').on('click', function() {
        window.location.href = "{{ url('register') }}"
    })

</script>
@endpush
