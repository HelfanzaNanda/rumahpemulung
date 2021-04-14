@extends('layout.main')
@section('title', 'Detil Penjemputan')

@section('content')

<!--
https://www.w3schools.com/cssref/tryit.asp?filename=trycss3_background_hero
-->

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
                        <label>Tanggal</label>
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

        <div id="map" style="width:100%;height:380px;"></div>

        <div class="row" style="margin-top: -10px">
            <div class="col-md-12">
                <form enctype="multipart/form-data" action="{{ url('pemulung/mybook/'.$x->id) }}" method="post">
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
                                        {{-- <a href="#">
                                            <img class="card-img-top" src="{{ url('assets/img/sales/'.$x->cphoto1) }}"
                                                alt="" width="300px" height="150px"></a> --}}
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
                                                                <input type="number" readonly class="form-control" step="0.1"
                                                                name="" value="{{ $x->cplastik }}" min="0" style="width: 4em">
                                                            </td>
                                                            <td><label class="control-label"><b>Rp</b></label>
                                                                <input type="text" class="form-control" value="Rp {{ $x->ctotal_plastik }}" readonly></td>
                                                            <td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <label><strong>Kg</strong></label>
                                                                <input type="number" class="form-control" step="0.1"
                                                                name="{{ $qty[$i] }}" onkeyup="{{ $c[$i] }}(this.value)" value="0" min="0" style="width: 4em">
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
                                                <input type="file" class="form-control" id="preview" name="foto">
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
                                                    <input type="file" class="form-control" id="preview3" name="foto3">
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
                                        {{-- <a href="#">
                                            <img class="card-img-top" src="{{ url('assets/img/sales/'.$x->cpoto2) }}"
                                                alt="" width="300px" height="150px"></a> --}}
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
                                                        <input type="number" readonly class="form-control" step="0.1"
                                                        name="" value="{{ $x->ckertas }}" min="0" style="width: 4em">
                                                    </td>
                                                    <td><label class="control-label"><b>Rp</b></label>
                                                        <input type="text" class="form-control" value="Rp {{ $x->ctotal_kertas }}" readonly></td>
                                                    <td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label><strong>Kg</strong></label>
                                                        <input type="number" class="form-control" step="0.1"
                                                        name="{{ $qty[$i] }}" onkeyup="{{ $c[$i] }}(this.value)" value="0" min="0" style="width: 4em">
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
                                            <input type="file" class="form-control" id="preview1" name="foto1">
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
                                                <input type="file" class="form-control" id="preview3" name="foto3">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            @if ($y->id_rubbish == 3 && $x->cbesi > 0)
                                <div class="col-md-3 col-xs-12">
                                        <label><b>{{ $y->typeof_rubbish }} {{ $y->prices }}/kg</b></label>
                                    <div class="card h-100">
                                        {{-- <a href="#">
                                            <img class="card-img-top" src="{{ url('assets/img/sales/'.$x->cpoto3) }}"
                                                alt="" width="300px" height="150px"></a> --}}
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
                                                            <input type="number" readonly class="form-control" step="0.1"
                                                            name="" value="{{ $x->cbesi }}" min="0" style="width: 4em">
                                                        </td>
                                                        <td><label class="control-label"><b>Total Besi</b></label>
                                                            <input type="text"class="form-control" readonly value="Rp {{ $x->ctotal_besi }}">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label><strong>Berat</strong></label>
                                                            <input type="number" class="form-control" step="0.1"
                                                            name="{{ $qty[$i] }}" onkeyup="{{ $c[$i] }}(this.value)" value="0" min="0" style="width: 4em">
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
                                                <input type="file" class="form-control" id="preview2" name="foto2">
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
                                                <input type="file" class="form-control" id="preview3" name="foto3">
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAGyws7bkYHZjPto6Fe56_oK8275amqf_Y&libraries=places&callback=initAutocomplete"
    async defer></script>

<script>
    $('.btn-back').on('click', function(){
        window.location.replace(BASE_URL+'/pemulung/mybook')
    });



    $(document).ready(function() {
        $.getJSON("{{ route('hargarubbish') }}",function(response) {
           pplastik = response.plastik
           pkertas = response.kertas
           pbesi = response.besi
        })
    })
    function a(val) {
        $('#totharga_plastik').val(parseInt(val*pplastik))
    }
    function b(val) {
        $('#totharga_kertas').val(parseInt(val*pkertas))
    }
    function c(val) {
        $('#totharga_besi').val(parseInt(val*pbesi))
    }
    function initAutocomplete() {
        var latc = '{{ $x->clat }}'
        var lngc = '{{ $x->clng }}'
        var map = new google.maps.Map(document.getElementById('map'), {
            center: new google.maps.LatLng(latc,lngc),
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(latc, lngc),
            map: map
        });
    }

    let lat = $('[name="latitude"]').val()
    let long = $('[name="longtitude"]').val()
    //untuk mengambil maps
    var mapsnyaWe = () => {
        window.open(`<?php echo url('maps/?lat=${lat}&&long=${long}')?>`, 'popupwindow', 'scrollbars=yes, width=740,height=540');
        return false
    }

    function HandlePopupResult(hasil) {
        $('[name="latitude"]').val("" + hasil.lat);
        $('[name="longtitude"]').val("" + hasil.lng);
        $('[name="address_google"]').val("" + hasil.address);
    }
    
    function bacaGambar(input){
        if (input.files && input.files[0]) {
            var reader  = new FileReader();
            reader.onload = function(e){
                $('#gambar').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#preview").change(function(){
        bacaGambar(this);
    });


    function bacaGambar1(input){
        if (input.files && input.files[0]) {
            var reader  = new FileReader();
            reader.onload = function(e){
                $('#gambar1').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#preview1").change(function(){
        bacaGambar1(this);
    });


    function bacaGambar2(input){
        if (input.files && input.files[0]) {
            var reader  = new FileReader();
            reader.onload = function(e){
                $('#gambar2').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#preview2").change(function(){
        bacaGambar2(this);
    });

    function bacaGambar3(input){
        if (input.files && input.files[0]) {
            var reader  = new FileReader();
            reader.onload = function(e){
                $('#gambar3').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#preview3").change(function(){
        bacaGambar3(this);
    });
</script>
@endsection