<section id="services" class="services" style="margin-top:-50px">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-md-12">
                <form enctype="multipart/form-data" action="{{ url('client/') }}" method="post">
                    @csrf
                    @php
                        $id = isset($so->id)?$so->id:0;
                    @endphp
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <h4>WAKTU PENJEMPUTAN</h4>
                            </div>
                            <hr>                            

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Jemput</label>
                                        <input id="date" type="date" class="form-control" name="date" readonly length="3" required autofocus>
                                            @error('date') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>
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
                            {{-- <div class="form-group">
                                <label for="waktu" class="col-md-4 control-label"><b>Waktu</b></label>
                               <input type="time" name="waktu" class="form-control">
                               @error('waktu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div> --}}

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Keterangan</label>
                                        <textarea rows="3" id="keterangan" name="keterangan" readonly class="form-control"
                                                placeholder="untuk keterangan tambahan."></textarea>
                                    </div>
                                </div>
                            </div>


						
                        </div>

                        <div class="col-md-6 border-left">
                            <div class="form-group">
                                <h4>ALAMAT PENJEMPUTAN</h4>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Customer</label>
                                        <input type="text" id="jam" name="jam" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">HP</label>
                                        <input type="text" id="menit" name="menit" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>  

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Lokasi Penjemputan</label>
                                        <textarea rows="3" id="keterangan" name="keterangan" readonly class="form-control"
                                            placeholder="untuk keterangan tambahan." required autofocus></textarea>
                                    </div>
                                </div>
                            </div>                           
							
							<!-- Shiping Details -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Lokasi Google Map</label>
                                        <textarea type="text" id="address_google" name="address_google" class="form-control" readonly placeholder="Address"></textarea>
                                        @error('address_google') <small class="text-danger">{{ $message }}</small> @enderror
                                        <input type="hidden" id="latitude" name="latitude" readonly>
                                        <input type="hidden" id="longtitude" name="longtitude" readonly>
                                    </div>
                                </div>
                            </div>          

                            
                            <!-- /Shiping Details -->
							
                        </div>
                    </div>
                    <!-- <br><br> -->
			
					<!-- BEGIN: MAP -->
					<!-- SOURCE
					https://mdbootstrap.com/docs/jquery/javascript/google-maps/
					-->
					<!--Google map-->
				
                    <!--
                    <div id="map-container-google-1" class="z-depth-1-half map-container" style="overflow:hidden;
padding-bottom:56.25%; position:relative; height:0;">
					  <iframe src="https://maps.google.com/maps?q=manhatan&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0"
						style="border:0; height:500px; width:100%; position:absolute;"></iframe>
					</div>
                    -->
                    
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <h4>LOKASI GOOGLE MAP</h4> 
                            <hr>
                            <p>Jarak Tempuh (km): 1.0 | Lama Jalan Kaki (menit): 50 <button id="btn-go-maps" type="button" class="btn btn-success btn-sm" style="text-align:right;" >OPEN GOOGLE MAP</button></p>
                        </div>
                    </div>
                    
                    <div id="googleMap" style="width:100%;height:380px;"></div>
                    

					<!--Google Maps-->
					<!-- END: MAP -->
                    <br>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <h4>DATA SAMPAH</h4>
                            <hr>
                            <!--
                            <p>Pilih jenis dan masukkan perkiraan berat sampah, kosongkan jenis sampah apabila anda tidak memilikinya</p>
                            -->
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
							
                            <div class="col-md-12">
                            <br>
                            <div class="text-center">
                            <button type="button" class="btn btn-success" data-dismiss="modal">CLOSE</button>
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

<script>
    /*
    function initialize() 
    {
        var propertiPeta = {
            center:new google.maps.LatLng(-7.7129424,110.0092652),
            //center:new google.maps.LatLng(document.getElementById("latitude").value,  document.getElementById("longitude").value),
            zoom:9,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        };
    
        var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);
        //alert("Hello world! " + document.getElementById("latitude").value);
        // membuat Marker
        var marker=new google.maps.Marker({
            
            position: new google.maps.LatLng(-7.7129424,110.0092652),
            //position: new google.maps.LatLng(document.getElementById("latitude").value,  document.getElementById("longitude").value), 
            map: peta
        });

    }
    */

</script>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAGyws7bkYHZjPto6Fe56_oK8275amqf_Y&callback=initialize">
//google.maps.event.addDomListener(window, 'load', initialize);
</script>

