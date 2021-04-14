

<section id="services" class="services">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-md-12">
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
                                <label for="date" class="col-md-4 control-label"><b>Tanggal Q</b></label>
                                <input id="date" type="date" class="form-control" name="date" readonly length="3" required autofocus>
                                @error('date') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Jam</label>
                                        <select id="jam" name="jam" class="form-control">
                                            @for($i = 0;$i < 24;$i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Menit</label>
                                        <select id="menit" name="menit" class="form-control">
                                            @for($i = 0;$i < 60;$i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                            {{-- <div class="form-group">
                                <label for="waktu" class="col-md-4 control-label"><b>Waktu</b></label>
                               <input type="time" name="waktu" class="form-control">
                               @error('waktu') <small class="text-danger">{{ $message }}</small> @enderror
                            </div> --}}


						
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
                    <!-- <br><br> -->
			
					<!-- BEGIN: MAP -->
					<!-- SOURCE
					https://mdbootstrap.com/docs/jquery/javascript/google-maps/
					-->
					<!--Google map-->
					<div id="map-container-google-1" class="z-depth-1-half map-container" style="overflow:hidden;
padding-bottom:56.25%;
position:relative;
height:0;">
					  <iframe src="https://maps.google.com/maps?q=manhatan&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0"
						style="border:0; height:500px;
width:100%;
position:absolute;"></iframe>
					</div>

					<!--Google Maps-->
					<!-- END: MAP -->
			
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
							
                            <div class="col-md-12">
                            <br>
                            <div class="submit-button text-center">
                                <button data-dismiss="modal" aria-label="Close" class="btn btn-md btn-info">TUTUP</button>
                            </div>
                        </div>
						</div>
					</div>
            </div>
        </div>
    </div>
</section>
