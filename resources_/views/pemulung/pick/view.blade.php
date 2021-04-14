@extends('layout.main')
@section('title', 'Detail Book')

@section('content')
    <section class="section-header bg-1">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="text-center">
						<h1 class="text-capitalize mb-4 font-lg text-white">Detail Book</h1>
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
            <div class="col-md-6 col-xs-12">
                <div class="form-group">
                    <label>Maps</label>
                    <div id="map" style="height:230px;margin-bottom: 10px;width: 100%;"></div>
                </div>
            </div>
        </div>
        
        <div class="row mt-5">
            <div class="col-md-6 col-xs-12">
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                            <label>Jenis</label>
                        <input type="text" readonly class="form-control" value="{{ $x->hasil }}">
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <label>Total</label>
                        <input type="text" readonly class="form-control" value="Rp.{{ number_format($x->ctotal_harga) }}">
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xs-12">
                <div class="row">
                    <div class="col-md-4 col-xs-12 d-flex justify-content-center" style="border: 5px solid black">
                        <div class="form-group">
                            <img src="{{ asset('assets/img/sales/'.$x->cphoto1) }}" width="100px"  alt="">
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12 d-flex justify-content-center" style="border: 5px solid black">
                        <div class="form-group">
                            <img src="{{ asset('assets/img/sales/'.$x->cpoto2) }}" width="100px" alt="">
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12 d-flex justify-content-center" style="border: 5px solid black">
                        <div class="form-group">
                            <img src="{{ asset('assets/img/sales/'.$x->cpoto3) }}" width="100px" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="row mt-2">
                    <div class="col-md-12">
                        <h4>Material</h4>
                    </div>
                </div>
                <div class="row">
                    @foreach ($rubbish as $r)
                        <div class="col-md-3 col-xs-12">
                            <label>{{ $r->typeof_rubbish }}</label>
                            <p><strong>Rp.{{ $r->prices }}</strong></p>
                        </div>
                    @endforeach
                </div>

                <br><br>
            </div>
        </div>


        <div class="row" style="margin-top: -10px">
            <div class="col-md-12">
                    @php
                        $qty = ['qty_plastik','qty_kertas','qty_besi'];
                        $harga = ['harga_plastik','harga_kertas','harga_besi'];
                        $c = ['a','b','c']
                    @endphp


                <div class="row mt-4">
                    @foreach ($rubbish as $i => $y)
                        @if ($y->id_rubbish == 1 && $x->cplastik > 0)
                            <div class="col-md-3 col-xs-12">
                                <div class="card h-100">
                                    <a href="#">
                                        <img class="card-img-top" src="{{ url('assets/img/sales/'.$x->cphoto1) }}"
                                            alt="" width="300px" height="150px"></a>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 col-xs-12">
                                                <table style="width:100%">
                                                    <tr>
                                                        <td>
                                                            <label><strong>Berat</strong></label>
                                                            <input type="number" readonly class="form-control" step="0.1"
                                                            name="" value="{{ $x->cplastik }}" min="0" style="width: 4em">
                                                        </td>
                                                        <td><label class="control-label"><b>Total Plastik</b></label>
                                                            <input type="text" class="form-control" value="Rp {{ $x->ctotal_plastik }}" readonly></td>
                                                        <td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label><strong>Berat</strong></label>
                                                            <input type="number" class="form-control" step="0.1" readonly value="{{ $x->pplastik }}" min="0"  style="width: 4em">
                                                        </td>
                                                        <td><label class="control-label"><b>Total {{ $y->typeof_rubbish }}</b></label>
                                                            <input type="text" readonly value="{{ $x->ptotal_plastik }}"  class="form-control">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($y->id_rubbish == 1 && $x->ckertas <= 0)
                                <div class="col-md-3 col-xs-12">
                                    <div class="card h-100">
                                        <a href="#">
                                                <img class="card-img-top" src="{{ url('assets/img/sales/'.$x->cphoto1) }}"
                                                    alt="" width="300px" height="150px"></a>
                                        <div class="card-body">
                                            <div class="col-md-12 col-xs-12">
                                                <table style="width:100%">
                                                    <tr>
                                                        <td>
                                                            <label><Strong>Tota Berat</Strong></label>
                                                            <input type="number" readonly class="form-control" value="{{ $x->ctotal_berat }}">
                                                        </td>
                                                        <td>
                                                            <label><Strong>Total Harga</Strong></label>
                                                            <input type="text" readonly class="form-control" value="Rp.{{ $x->ctotal_harga }}">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                        @if ($y->id_rubbish == 2 && $x->ckertas > 0)
                            <div class="col-md-3 col-xs-12 mt-2">
                                <div class="card h-100">
                                    <a href="#">
                                        <img class="card-img-top" src="{{ url('assets/img/sales/'.$x->cpoto2) }}"
                                            alt="" width="300px" height="150px"></a>
                                <div class="card-body">
                                    <div class="col-md-12 col-xs-12">
                                        <table style="width:100%">
                                            <tr>
                                                <td>
                                                    <label><strong>Berat</strong></label>
                                                    <input type="number" readonly class="form-control" step="0.1"
                                                    name="" value="{{ $x->ckertas }}" min="0" style="width: 4em">
                                                </td>
                                                <td><label class="control-label"><b>Total Kertas</b></label>
                                                    <input type="text" class="form-control" value="Rp {{ $x->ctotal_kertas }}" readonly></td>
                                                <td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label><strong>Berat</strong></label>
                                                    <input type="number" class="form-control" step="0.1" readonly value="{{ $x->pkertas }}" min="0"  style="width: 4em">
                                                </td>
                                                <td><label class="control-label"><b>Total {{ $y->typeof_rubbish }}</b></label>
                                                    <input type="text" readonly value="{{ $x->ptotal_kertas }}" class="form-control">
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                </div>
                            </div>
                            @if ($y->id_rubbish == 2 && $x->cbesi <= 0)
                                <div class="col-md-3 col-xs-12">
                                    <div class="card h-100">
                                        <a href="#">
                                                <img class="card-img-top" src="{{ url('assets/img/sales/'.$x->cphoto1) }}"
                                                    alt="" width="300px" height="150px"></a>
                                        <div class="card-body">
                                            <div class="col-md-12 col-xs-12">
                                                <table style="width:100%">
                                                    <tr>
                                                        <td>
                                                            <label><Strong>Tota Berat</Strong></label>
                                                            <input type="number" readonly class="form-control" value="{{ $x->ctotal_berat }}">
                                                        </td>
                                                        <td>
                                                            <label><Strong>Total Harga</Strong></label>
                                                            <input type="text" readonly class="form-control" value="Rp.{{ $x->ctotal_harga }}">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                        @if ($y->id_rubbish == 3 && $x->cbesi > 0)
                            <div class="col-md-3 col-xs-12">
                                <div class="card h-100">
                                    <a href="#">
                                        <img class="card-img-top" src="{{ url('assets/img/sales/'.$x->cpoto3) }}"
                                            alt="" width="300px" height="150px"></a>
                                    <div class="card-body">
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
                                                        <input type="number" class="form-control" step="0.1" readonly value="{{ $x->pbesi }}" min="0"  style="width: 4em">
                                                    </td>
                                                    <td><label class="control-label"><b>Total {{ $y->typeof_rubbish }}</b></label>
                                                        <input type="text" readonly value="{{ $x->ptotal_besi }}" class="form-control">
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-12">
                                <div class="card h-100">
                                    <a href="#">
                                            <img class="card-img-top" src="{{ url('assets/img/sales/'.$x->cphoto1) }}"
                                                alt="" width="300px" height="150px"></a>
                                    <div class="card-body">
                                        <div class="col-md-12 col-xs-12">
                                            <table style="width:100%">
                                                <tr>
                                                    <td>
                                                        <label><Strong>Tota Berat</Strong></label>
                                                        <input type="number" readonly class="form-control" value="{{ $x->ctotal_berat }}">
                                                    </td>
                                                    <td>
                                                        <label><Strong>Total Harga</Strong></label>
                                                        <input type="text" readonly class="form-control" value="Rp.{{ $x->ctotal_harga }}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label><strong>Total Berat</strong></label>
                                                        <input type="number" class="form-control" step="0.1" readonly value="{{ $x->ptotal_berat }}" min="0"  style="width: 4em">
                                                    </td>
                                                    <td><label class="control-label"><b>Total Harga</b></label>
                                                        <input type="text" readonly value="{{ $x->ptotal_harga }}" class="form-control">
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        
                    @endforeach
                </div>


                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3 col-xs-12">
                                <div class="form-group">
                                    <label for="file" class="col-md-4 control-label"><b>Foto</b></label>
                                </div>
                                <img src="{{ asset('assets/img/sales/'.$x->pphoto1) }}" style="width:150px" id="gambar">
                            </div>
                            <div class="col-md-3 col-xs-12">
                                <div class="form-group">
                                    <label for="file" class="col-md-4 control-label"><b>Foto</b></label>
                                </div>
                                <img src="{{ asset('assets/img/sales/'.$x->pphoto2) }}" style="width:150px" id="gambar1">
                            </div>
                            <div class="col-md-3 col-xs-12">
                                <div class="form-group">
                                    <label for="file" class="col-md-4 control-label"><b>Foto</b></label>
                                </div>
                                <img src="{{ asset('assets/img/sales/'.$x->pphoto3) }}" style="width:150px" id="gambar2">
                            </div>
                            <div class="col-md-3 col-xs-12">
                                <div class="form-group">
                                    <label for="file" class="col-md-4 control-label"><b>Foto</b></label>
                                </div>
                                <img src="{{ asset('assets/img/sales/'.$x->pphoto4) }}" style="width:150px" id="gambar3">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAGyws7bkYHZjPto6Fe56_oK8275amqf_Y&libraries=places&callback=initAutocomplete"
    async defer></script>

<script>
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