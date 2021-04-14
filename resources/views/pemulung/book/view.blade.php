@extends('layout.main')
@section('title', 'Detil Penjemputan')

@section('content')

<!--
https://www.w3schools.com/cssref/tryit.asp?filename=trycss3_background_hero
-->
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
<style>
.hero-image {
  background-image: url("https://belanjaikan.com/download/2020-02-22-1.jpg");
  background-color: #cccccc;
  height: 150px;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
}

.hero-text {
  text-align: center;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: white;
}
</style>

    <section class="section-header bg-1">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="text-center">
						<h1 class="text-capitalize mb-4 font-lg text-white">Detil Penjemputan</h1>
					</div>
				</div>
			</div>
		</div>
	</section>

    <br>
    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" readonly class="form-control" value="{{ $x->username }}">
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        <label>HP</label>
                        <input type="text" readonly class="form-control" value="{{ $x->phone_client }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea rows="2" readonly class="form-control">{{ $x->address_client }}</textarea>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" readonly class="form-control" value="{{ $x->email_client }}">
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-6 col-xs-12">
                    <div class="row">
                        <div class="col-12">
                            <label>Lokasi Penjemputan</label>
                            <textarea rows="2" readonly class="form-control">{{ $x->caddress }}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <label>Jemput</label>
                            <input type="text" readonly class="form-control" value="{{ $x->cdate }}">
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <label>Jam</label>
                            <input type="text" readonly class="form-control" value="{{ $x->ctime }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label>Keterangan</label>
                            <textarea rows="2" readonly class="form-control">{{ $x->cketerangan }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div id="maps" style="width:100%;height:380px;"></div>

            <div class="row" style="margin-top: -10px">
                <div class="col-md-12">
                    <form id="form-add" enctype="multipart/form-data" action="#" method="post">
                        @csrf
                            @php
                                $qty = ['qty_plastik','qty_kertas','qty_besi'];
                                $harga = ['harga_plastik','harga_kertas','harga_besi'];
                                $c = ['a','b','c']
                            @endphp


                        <div class="row mt-4">
                            @foreach ($rubbish as $i => $y)

                                @if ($y->id_rubbish == 1 && $x->cplastik > 0)

                                    <div class="col-md-3 col-xs-12">
                                            <label><b>{{ $y->typeof_rubbish }} {{ $y->prices }}/kg</b></label>
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <div class="col" style="border: 0px solid black; width=100px height=100px;">
                                                    <div class="form-group text-center" style="border: 0px solid black; width=100px height=100px;">
                                                        <img src="{{ url('assets/img/sales/'.$x->cphoto1) }}" style="vertical-align: middle;  max-height: 200px; max-width: 200px;" alt="">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 col-xs-12">
                                                        <table style="width:100%">
                                                            <tr>
                                                                <td>
                                                                    <label><strong>Kg</strong></label>
                                                                    <input type="tel" readonly class="form-control qty" 
                                                                    name="" value="{{ $x->cplastik }}" min="0" style="width: 4em">
                                                                </td>
                                                                <td><label class="control-label"><b>Rp</b></label>
                                                                    <input type="text" class="form-control" value="Rp {{ $x->ctotal_plastik }}" readonly></td>
                                                                <td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <label><strong>Kg</strong></label>
                                                                    <input type="tel" class="form-control qty"
                                                                    data-type="{{ $harga[$i] }}"
                                                                    data-price="{{ $y->prices }}"
                                                                    name="{{ $qty[$i] }}" value="0" min="0" style="width: 4em">
                                                                    <input type="hidden" name="{{ $harga[$i] }}" value="{{ $y->prices }}">
                                                                </td>
                                                                <td><label class="control-label"><b>Rp</b></label>
                                                                    <input type="text" readonly value="Rp.00" id="tot{{ $harga[$i] }}" class="form-control">
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>    
                                            <div class="card-footer">
                                                <div class="form-group foto">
                                                    <img src="#" width="100%" height="150px"
                                                        id="gambar">
                                                    <input type="file" onchange="previewImage(this, 'gambar')" class="form-control" id="preview" name="foto">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @if ($y->id_rubbish == 1 && $x->ckertas <= 0)
                                        <div class="col-md-3 col-xs-12">
                                                <label><b>Location</b></label>
                                            <div class="card h-100">
                                                <div class="card-body">
                                                    <div class="col" style="border: 5px solid black">
                                                        <div class="form-group text-center">
                                                            <img src="{{ url('assets/img/sales/'.$x->cpoto4) }}" width="100px" alt="">
                                                        </div>
                                                    </div>
                                                    <a href="#" class="card-img-top">
                                                        <br><br>
                                                        <p style="font-size: 28pt; text-align: center;">{{ $x->hasil }}</p>
                                                        <p style="font-size: 28pt; text-align: center;">{{ $x->ctotal_harga }}</p>
                                                        <br><br>
                                                    </a>
                                                    <textarea type="text" name="address_google" onclick="mapsnyaWe()" readonly class="form-control" placeholder="Address"></textarea>
                                                    @error('address_google') <small class="text-danger">{{ $message }}</small> @enderror
                                                    <input type="hidden" name="latitude">
                                                    <input type="hidden" name="longtitude">
                                                </div>
                                                <div class="card-footer">
                                                    <div class="form-group foto">
                                                        <img src="#" width="100%" height="150px"
                                                            id="gambar3">
                                                        <input type="file" onchange="previewImage(this, 'gambar3')" class="form-control" id="preview3" name="foto3">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif

                                @if ($y->id_rubbish == 2 && $x->ckertas > 0)

                                    <div class="col-md-3 col-xs-12 mt-2">
                                            <label><b>{{ $y->typeof_rubbish }} {{ $y->prices }}/kg</b></label>
                                        <div class="card h-100">
                                        
                                        <div class="card-body">
                                            <div class="col" style="border: 0px solid black; width=100px height=100px;">
                                                <div class="form-group text-center" style="border: 0px solid black; width=100px height=100px;">
                                                        <img src="{{ url('assets/img/sales/'.$x->cpoto2) }}" style="vertical-align: middle;  max-height: 200px; max-width: 200px;" alt="">
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-xs-12">
                                                <table style="width:100%">
                                                    <tr>
                                                        <td>
                                                            <label><strong>Kg</strong></label>
                                                            <input type="tel" readonly class="form-control qty"
                                                            name="" value="{{ $x->ckertas }}" min="0" style="width: 4em">
                                                        </td>
                                                        <td><label class="control-label"><b>Rp</b></label>
                                                            <input type="text" class="form-control" value="Rp {{ $x->ctotal_kertas }}" readonly></td>
                                                        <td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label><strong>Kg</strong></label>
                                                            <input type="tel" class="form-control qty"
                                                            data-type="{{ $harga[$i] }}"
                                                            data-price="{{ $y->prices }}"
                                                            name="{{ $qty[$i] }}" value="0" min="0" style="width: 4em">
                                                            <input type="hidden" name="{{ $harga[$i] }}" value="{{ $y->prices }}">
                                                        </td>
                                                        <td><label class="control-label"><b>Rp</b></label>
                                                            <input type="text" readonly value="Rp.00" id="tot{{ $harga[$i] }}" class="form-control">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="card-footer">
                                            <div class="form-group foto">
                                                <img src="#" width="100%" height="150px"
                                                    id="gambar1">
                                                <input type="file" class="form-control" onchange="previewImage(this, 'gambar1')" id="preview1" name="foto1">
                                            </div>
                                        </div>
                                        </div>
                                    </div>

                                    @if ($y->id_rubbish == 2 && $x->cbesi <= 0)
                                        <div class="col-md-3 col-xs-12">
                                            <label><b>Location</b></label>
                                            <div class="card h-100">
                                                <div class="card-body">
                                                    <div class="col mb-1"
                                                        style="border: 5px solid black">
                                                        <div class="form-group text-center">
                                                            <img src="{{ url('assets/img/sales/'.$x->cpoto4) }}" width="100px" alt="">
                                                        </div>
                                                    </div>
                                                        <p style="font-size: 20pt; text-align: center;">{{ $x->hasil }}</p>
                                                        <p style="font-size: 20pt; text-align: center;">{{ $x->ctotal_harga }}</p>
                                                    <textarea type="text" name="address_google" onclick="mapsnyaWe()" readonly class="form-control" placeholder="Address"></textarea>
                                                    @error('address_google') <small class="text-danger">{{ $message }}</small> @enderror
                                                    <input type="hidden" name="latitude">
                                                    <input type="hidden" name="longtitude">
                                            </div>

                                            <div class="card-footer">
                                                <div class="form-group foto">
                                                    <img src="#" width="100%" height="150px"
                                                        id="gambar3">
                                                    <input type="file" onchange="previewImage(this, 'gambar3')" class="form-control" id="preview3" name="foto3">
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif

                                @if ($y->id_rubbish == 3 && $x->cbesi > 0)
                                    <div class="col-md-3 col-xs-12">
                                            <label><b>{{ $y->typeof_rubbish }} {{ $y->prices }}/kg</b></label>
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <div class="col" style="border: 0.px solid black; width=100px height=100px;">
                                                    <div class="form-group text-center">
                                                            <img src="{{ url('assets/img/sales/'.$x->cpoto3) }}" style="vertical-align: middle;  max-height: 200px; max-width: 200px;" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-xs-12">
                                                    <table style="width:100%">
                                                        <tr>
                                                            <td>
                                                                <label><Strong>Berat</Strong></label>
                                                                <input type="tel" readonly class="form-control"
                                                                name="" value="{{ $x->cbesi }}" style="width: 4em">
                                                            </td>
                                                            <td><label class="control-label"><b>Total Besi</b></label>
                                                                <input type="text"class="form-control" readonly value="Rp {{ $x->ctotal_besi }}">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                {{-- {{ dd($y->typeof_rubbish, $y->prices) }} --}}
                                                                <label><strong>Berat</strong></label>
                                                                <input type="tel" class="form-control qty" 
                                                                data-type="{{ $harga[$i] }}"
                                                                data-price="{{ $y->prices }}"
                                                                name="{{ $qty[$i] }}"  value="0" style="width: 4em">
                                                                <input type="hidden" name="{{ $harga[$i] }}" value="{{ $y->prices }}">
                                                            </td>
                                                            <td><label class="control-label"><b>Total {{ $y->typeof_rubbish }}</b></label>
                                                                <input type="text" readonly value="Rp.00" id="tot{{ $harga[$i] }}" class="form-control">
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="card-footer">
                                                <div class="form-group foto">
                                                    <img src="#" width="100%" height="150px"
                                                        id="gambar2">
                                                    <input type="file" onchange="previewImage(this, 'gambar2')" class="form-control" id="preview2" name="foto2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-xs-12">
                                        <label><b>Location</b></label>
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <div class="col"
                                                    style="border: 5px solid black">
                                                    <div class="form-group text-center">
                                                        <img src="{{ url('assets/img/sales/'.$x->cpoto4) }}" width="100px" alt="">
                                                    </div>
                                                </div>
                                                <a href="#" class="card-img-top">
                                                    <br><br>
                                                    <p style="font-size: 28pt; text-align: center;">{{ $x->hasil }}</p>
                                                    <p style="font-size: 28pt; text-align: center;">Rp. <span data-total-price="{{ $x->ctotal_harga }}" id="total_price">{{ number_format($x->ctotal_harga) }}</span></p>
                                                    <br><br>
                                                </a>
                                                    <textarea type="text" name="address_google" id="address_google" readonly class="form-control" placeholder="Address"></textarea>
                                                    @error('address_google') <small class="text-danger">{{ $message }}</small> @enderror
                                                    <input type="hidden" name="latitude" id="lat">
                                                    <input type="hidden" name="longtitude" id="lng">
                                            </div>

                                            <div class="card-footer">
                                                <div class="form-group foto">
                                                    <img src="#" width="100%" height="150px"
                                                        id="gambar3">
                                                    <input type="file" class="form-control" onchange="previewImage(this, 'gambar3')" id="preview3" name="foto3">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                
                            @endforeach
                        </div>
                    </div>
                            
                        <div class="col-md-12" style="margin-top:50px">                        
                            <div class="text-center">
                                <button type="button" class="btn btn-warning btn-back" >KEMBALI</button>
                                <button type="submit" class="btn btn-warning"  style="width=200px;">AMBIL</button>
                            </div>
                        </div>
                        
                </form>
            </div>
        </div>
    </section>

    <x-modal-maps/>
    <x-modal-confirm-submit/>
    <x-modal-success/>
    <x-modal-error/>
    
@endsection

@push('scripts')
    
    <script>
        function previewImage(input, img){
            if (input.files && input.files[0]) {
                var reader  = new FileReader();
                reader.onload = function(e){
                    $('#'+img).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script>
        let price_paper = 0;
        let price_plastic = 0;
        let price_iron = 0;

        $('.qty').on('keyup', function() {
            $(this).val(isNumberAndDot($(this).val()))
            let qty = isNaN($(this).val()) ? 0 : $(this).val()
            let price = $(this).data('price')
            let type = $(this).data('type')
            let total_price = $('#total_price').data('total-price')
            let subprice = qty * price;
            if (type == 'harga_plastik') {
                price_plastic = subprice
            }else if (type == 'kertas') {
                price_paper = subprice
            }else{
                price_iron = subprice
            }
            $('#tot'+type).val( subprice == 0 ? 0 : (subprice/1000).toFixed(3))
            let subpricefinal = $('#tot'+type).val().replace('.','')
            const finalprice = parseInt(subpricefinal) + price_paper + price_plastic + price_iron;
            $('#total_price').text((finalprice/1000).toFixed(3))
        })

        function isNumberAndDot(str) {
            const regex = /[^\d.]|\.(?=.*\.)/g;
            const subst=``;
            return str.replace(regex, subst);
        }
    </script>

    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYY-wMcvr6cGuSynbDsfyABKsGzOlz9X0&libraries=places&callback=initMap">
    </script>

    <script>
        let map
        $(document).ready(function() {
            init(false)
            $('#address_google').on('click', function() {
                init(true);
                $('#mapsModal').modal('show')
            })
        })
        
        function init(modal) {
            let lat = '{{ $x->clat }}'
            let lng = '{{ $x->clng }}'
            myLoc = new google.maps.LatLng(lat, lng)
            let opt = {
                    center: myLoc,
                    zoom: 13,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            if (!modal) {
                map = new google.maps.Map(document.getElementById('maps'), opt);
                const marker = new google.maps.Marker();
                showMarker(marker, myLoc, map);
            }else{
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
            }
            
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
        let url = "{{ url('pemulung/mybook/'.$x->id) }}";
        $('form#form-add').submit( function(e) {
            e.preventDefault();
            //addressSelected()
            form_data = new FormData( this );
            // let date =$('#date').val()
            // let qty = $('.qty').val()
            $('#modal-confirm-submit').modal('show')
            // if (date == '') {
            //     $('.text-error').html('<p>tanggal tidak boleh kosong</p>')
            //     $('#modal-error').modal('show')
            // }else if ($('#rbaddress3').is(':checked') && $('#rbaddress3val').val() == '') {
            //     $('.text-error').html('<p>Alamat tidak boleh kosong</p>')
            //     $('#modal-error').modal('show')
            // }else if (qty == 0) {
            //     $('.text-error').html('<p>data sampah silahkan di isi lebih dari 0, minimal salah satu</p>')
            //     $('#modal-error').modal('show')
            // }else{
            //     $('#modal-confirm-submit').modal('show')
            // }
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
                            window.location.href = "{{ url('pemulung/mybook') }}"
                        }, 1000);
                    } 
                }
            })
        })

        $('.btn-back').on('click', function(){
            window.location.href = "{{ url('pemulung/mybook') }}"
        });
        

        // function addressSelected() 
        // {
        //     var addtermp = "";
        //     if (document.getElementById('rbaddress1').checked) {
        //         addtermp  = document.getElementById('rbaddress1val').innerHTML;
        //     } else if (document.getElementById('rbaddress2').checked) {
        //         addtermp  = document.getElementById('rbaddress2val').value;
        //     } else if (document.getElementById('rbaddress3').checked) {
        //         addtermp  = document.getElementById('rbaddress3val').value;
        //     }
        //     document.getElementById('address_pickup').value = addtermp;   
        // }

    </script>
@endpush

