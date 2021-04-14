@extends('layout.main')
@section('title', 'Detail Request Order')

@section('content')
    <section class="section-header bg-1">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="text-center">
						<h1 class="text-capitalize mb-4 font-lg text-white">Detail Request Order</h1>
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
            <div class="col-md-12 col-xs-12">
                Nama : {{ $x->username }}
            </div>
            <div class="col-md-12 col-xs-12">
                Phone : {{ $x->phone_client }}
            </div>
            <div class="col-md-12 col-xs-12">
                Email : {{ $x->email_client }}
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <h4>Material</h4>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <table style="width:100%">
                                <tr>
                                    <td><label class="control-label"><b>Plastik</b><br>Rp {{ $x->ctotal_plastik }}</label></td>
                                    <td><input type="number" readonly class="form-control" step="0.1"
                                        name="" value="{{ $x->cplastik }}" min="0" style="width: 4em">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <table style="width:100%">
                                <tr>
                                    <td><label class="control-label"><b>Kertas</b><br>Rp {{ $x->ctotal_kertas }}</label></td>
                                    <td><input type="number" readonly class="form-control" step="0.1"
                                        name="" value="{{ $x->ckertas }}" min="0" style="width: 4em">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <table style="width:100%">
                                <tr>
                                    <td><label class="control-label"><b>Besi</b><br>Rp {{ $x->ctotal_besi }}</label></td>
                                    <td><input type="number" readonly class="form-control" step="0.1"
                                        name="" value="{{ $x->cbesi }}" min="0" style="width: 4em">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <br><br>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="radio-toolbar">
                                    <input type="text" readonly class="form-control" value="{{ $x->hasil }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="date" class="col-md-4 control-label"><b>Tanggal</b></label>
                                        <input id="date" type="date" class="form-control" name="text" readonly value="{{ $x->cdate }}" length="3" required autofocus>
                                        @error('date') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="">Jam</label>
                                        <input type="text" readonly class="form-control" value="{{ $x->ctime }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                            {{-- <div class="form-group">
                                <label for="waktu" class="col-md-4 control-label"><b>Waktu</b></label>
                               <input type="time" name="waktu" class="form-control">
                               @error('waktu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div> --}}


						<!-- Shiping Details -->
						<div class="shiping-details">
                            <label for="pickup_country" class="col-md-6 control-label"><b>Lokasi Penjemputan</b></label>
                            <div class="form-group">
                                <textarea type="text" name="address_google" class="form-control" placeholder="Address" readonly>{{ $x->caddress }}</textarea>
                                @error('address_google') <small class="text-danger">{{ $message }}</small> @enderror
                                <input type="hidden" name="latitude">
                                <input type="hidden" name="longtitude">
                            </div>
						</div>
						<!-- /Shiping Details -->
                        </div>

                        <div class="col-md-6 border-left">
                            <div class="form-group">
                                <h4>Informasi Tambahan (Opsional)</h4>
                            </div>
                            <hr>    
                            <div class="form-group">
                                <label for="keterangan" class="col-md-4 control-label"><b>Keterangan</b></label>
                                <textarea rows="3" id="keterangan" name="keterangan" readonly class="form-control"
                                    placeholder="untuk keterangan tambahan." required autofocus>{{ $x->cketerangan }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group">
                                        <img src="{{ asset('assets/img/sales/'.$x->cphoto1) }}" width="100px" alt="">
                                    </div>
                                </div>
                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group">
                                        <img src="{{ asset('assets/img/sales/'.$x->cpoto2) }}" width="100px" alt="">
                                    </div>
                                </div>
                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group">
                                        <img src="{{ asset('assets/img/sales/'.$x->cpoto3) }}" width="100px" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <br>
                            <div class="submit-button text-center">
                                <a href="{{ url('pemulung/salesreq/pickup/'.$x->id) }}" onclick="return confirm('apakah anda akan booking?')" class="btn btn-md btn-primary">Book</a>
                            </div>
				    	</div>
                    </div>
            </div>
        </div>
    </div>
</section>
<script>
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
</script>
@endsection