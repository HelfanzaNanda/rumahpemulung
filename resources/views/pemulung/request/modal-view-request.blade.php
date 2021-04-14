

<section id="services" class="services">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-md-12">
                <form id="form" enctype="multipart/form-data" action="#" method="post">
                    @csrf
                    @php
                        $id = isset($so->id)?$so->id:0;
                    @endphp
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <h4>Waktu Penjemputan</h4>
								<input type="hidden" id="id_so" name="id_so">
                            </div>
                            <hr>                            

                            <div class="form-group">
                                <label for="date" class="col-md-4 control-label"><b>Jemput</b></label>
                                <input id="date" type="date" class="form-control" name="date" readonly length="3" required autofocus>
                                @error('date') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Jam</label>
                                        <input type="text" id="jam" name="jam" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Menit</label>
                                        <input type="text" id="menit" name="menit" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6"></div>
						
                        </div>

                        <div class="col-md-6 border-left">
                            <div class="form-group">
                                <h4>Alamat Penjemputan</h4>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="keterangan" class="col-md-6 control-label"><b>Lokasi Penjemputan</b></label>
                                <textarea rows="3" id="keterangan" name="keterangan" readonly class="form-control"
                                    placeholder="untuk keterangan tambahan." required autofocus></textarea>
                            </div>
							
							<!-- Shiping Details -->
						<div class="shiping-details">
                            <label for="pickup_country" class="col-md-6 control-label"><b>Lokasi Berdasarkan Map</b></label>
                            <div class="form-group">
                                <textarea type="text" id="address_google" name="address_google" class="form-control" readonly placeholder="Address"></textarea>
                                @error('address_google') <small class="text-danger">{{ $message }}</small> @enderror
                                <input type="hidden" id="latitude" name="latitude">
                                <input type="hidden" id="longtitude" name="longtitude">
                            </div>
						</div>
						<!-- /Shiping Details -->
							
                        </div>
                    </div>

                    <div id="googleMap" style="width:100%;height:380px;"></div>
			
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <h4>Data Sampah</h4>
                            <hr>
                            <p>Pilih jenis dan masukkan perkiraan berat sampah, kosongkan jenis sampah apabila anda tidak memilikinya</p>
                        </div>
                    </div>
                    <div class="row mt-2">
                        @php
                            $qty = ['qty_plastik','qty_kertas','qty_besi'];
                            $harga = ['harga_plastik','harga_kertas','harga_besi'];
                            $bbb = ['brand_plastik','brand_kertas','brand_besi'];
                        @endphp
                        @foreach ($rubbish as $i => $x)
                            <!-- Plastik -->
                            <div class="col-md-3 col-sm-6 col-xs-12 mb-5">
                                <label><b>{{ $x->typeof_rubbish }} Rp {{ $x->prices }}/kg</b></label>
                                <div class="card h-100">
                                    <div class="card-body">
                                        <table>
                                            <tr>
                                                <td><label class="control-label"><b>Berat</b></label>
                                                    <input type="number" class="form-control" step="0.1"
                                                    name="{{ $qty[$i] }}" id="{{ $qty[$i] }}" readonly min="0" style="width: 4em">
                                                    <input type="hidden" id="{{ $harga[$i] }}" name="{{ $harga[$i] }}" value="{{ $x->prices }}">
                                                </td>
                                                <td><label class="control-label"><b>Rp</b></label>
                                                    <input type="text" readonly  id="tot{{ $harga[$i] }}"
                                                        class="form-control">
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        <div class="form-group foto">
                                            <img src="#" alt="" id="gambar{{$i ?:''}}" width="100%" height="150px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Plastik -->
                        @endforeach
                        <!-- Info Tambahan -->
                        <div class="col-md-3 col-sm-6 col-xs-12 mb-5">
                            <label><b>LOCATION</b></label>
                            <div class="card h-100">
                                <div class="card-body">
                                    <a href="#">
                                        <p style="font-size: 28pt; text-align: center;" id="kategori"></p>
                                        <p style="font-size: 28pt; text-align: center;" id="total_harga"></p>
                                    </a>
                                </div>
                                <div class="card-footer">
                                    <div class="form-group foto">
                                        <img src="#" alt="" id="gambar3" width="100%" height="150px">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of Info Tambahan -->					
						

                    </div>
			
					<div class="row mt-2">
						<div class="col-md-12">
							<hr>
							<p>Jika Anda setuju akan mengambil sampah tersebut, maka Anda wajib melakukan BOOK terlebih dahulu.</p>
						
                            <div class="col-md-12">
                            <br>
                            <div class="submit-button text-center">
                                <button type="button" data-dismiss="modal" class="btn btn-md btn-warning">BATAL</button>
                                <button type="submit" class="btn btn-md btn-primary">BOOK</button>
                            </div>
                        </div>
						</div>
					</div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
            let lat = $('[name="latitude"]').val()
            let long = $('[name="longitude"]').val()
          //untuk mengambil maps
          var mapsnyaWe = () => {
              window.open(`<?php echo url('./maps/?lat=${lat}&&long=${long}')?>`, 'popupwindow', 'scrollbars=yes, width=740,height=540');
              return false
          }
    
          function HandlePopupResult(hasil) {
              $('[name="latitude"]').val("" + hasil.lat);
              $('[name="longitude"]').val("" + hasil.lng);
              $('[name="address_google"]').val("" + hasil.address);
          }
    </script>


<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAGyws7bkYHZjPto6Fe56_oK8275amqf_Y&callback=initialize">
</script>
