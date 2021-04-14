@extends('layout.main')
@section('title', 'Order')

@section('content')
    <section class="section-header bg-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h1 class="text-capitalize mb-4 font-lg text-white">Order Request</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <br>
    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb-tree">
                        <li><a href="/home">Home</a></li>
                        <!-- <li><a href="/sales">Sales Order</a></li> -->
                        <li class="active">Request</li>
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /BREADCRUMB -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-md-12">
                    <form enctype="multipart/form-data" action="{{ url('client/') }}" method="post">
                        @csrf
                        @php
                            $id = isset($so->id) ? $so->id : 0;
                        @endphp
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4>Waktu Penjemputan</h4>
                                </div>
                                <hr>

                                <div class="form-group">
                                    <label for="date" class="col-md-4 control-label">Tanggal</label>
                                    <input id="date" type="date" class="form-control" name="date"
                                        value="{{ isset($so->cdate) ? $so->cdate : '' }}" length="3" required autofocus>
                                    @error('date') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                @php
                                    $jam = '';
                                    $menit = '';
                                    if ($id) {
                                        $ctime = explode(':', $so->ctime);
                                        $jam = $ctime[0];
                                        $menit = $ctime[1];
                                    }
                                @endphp
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Jam</label>
                                            <select name="jam" class="form-control">
                                                <option value="06" selected>06</option>
                                                <option value="07">07</option>
                                                <option value="08">08</option>
                                                <option value="09">09</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                                <option value="18">18</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Menit</label>
                                            <select name="menit" class="form-control">
                                                <option value="00" selected>00</option>
                                                <option value="15">15</option>
                                                <option value="30">30</option>
                                                <option value="45">45</option>
                                            </select>
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
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="rbaddress1"
                                            value="rbaddress1" checked onclick="javascript:rbaddress();">
                                        <label class="col-md-10 control-label" for="exampleRadios1">
                                            Gunakan Alamat Saat Registrasi
                                        </label>
                                        <label class="col-md-10 control-label" for="exampleRadios1" name="rbaddress1val"
                                            id="rbaddress1val">{{ $ar->address_client }}</label>

                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="rbaddress2"
                                            value="rbaddress2" onclick="javascript:rbaddress();">
                                        <label class="col-md-10 control-label" for="exampleRadios2">
                                            Gunakan Alamat History
                                        </label>
                                        <select class="form-control mt-2 selectpicker" name="rbaddress2val"
                                            id="rbaddress2val"
                                            style="overflow: hidden;  white-space: pre;  text-overflow: ellipsis;  -webkit-appearance: none">
                                            @foreach ($ah as $i => $x)
                                                <option value='{{ $x->caddress }}'>{{ $x->caddress }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="rbaddress3"
                                            value="rbaddress3" onclick="javascript:rbaddress();">
                                        <label class="col-md-10 control-label" for="exampleRadios2">
                                            Gunakan Alamat Baru</label>
                                    </div>
                                    <textarea rows="3" name="rbaddress3val" id="rbaddress3val" class="form-control"
                                        placeholder=""></textarea>
                                    <!-- Shiping Details -->
                                </div>

                                <input type="hidden" id="address_pickup" name="address_pickup" value="xxxx">

                                <div class="shiping-details">
                                    <label style="margin-left: -10px" for="pickup_country"
                                        class="col-md-12 mr-5 control-label"><b>Bantuan Google map agar lokasi lebih mudah
                                            ditemukan</b></label>
                                    <div class="form-group">
                                        <textarea type="text" name="address_google" class="form-control" readonly
                                            onclick="mapsnyaWe()" placeholder="Address">{{ $ar->address_google }}</textarea>
                                        @error('address_google') <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <input type="hidden" name="latitude" value="@if (isset($ar->latitude)) {{ $ar->latitude }} @endif">
                                        <input type="hidden" name="longtitude" value="@if (isset($ar->longitude)) {{ $ar->longitude }} @endif">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <br><br> -->
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <h4>Data Sampah</h4>
                                <hr>
                                <div class="form-group">
                                    <div class="radio-toolbar">
                                        <input type="radio" id="jual" name="jenis" value="JUAL"
                                            onchange="$('#kategori').html(this.value)" @if (!$id) checked @endif @if (isset($so->hasil) && $so->hasil == 'JUAL') checked @endif>
                                        <label for="jual">JUAL</label>

                                        <input type="radio" id="donasi" name="jenis" value="DONASI"
                                            onchange="$('#kategori').html(this.value)" @if (isset($so->hasil) && $so->hasil == 'DONASI') checked @endif>
                                        <label for="donasi">DONASI</label>
                                    </div>
                                </div>
                                <p>Pilih jenis dan masukkan perkiraan berat sampah, kosongkan jenis sampah apabila anda
                                    tidak memilikinya</p>
                            </div>
                        </div>
                        <div class="row mt-2">
                            @php
                                $qty = ['qty_plastik', 'qty_kertas', 'qty_besi'];
                                $harga = ['harga_plastik', 'harga_kertas', 'harga_besi'];
                                $bbb = ['brand_plastik', 'brand_kertas', 'brand_besi'];
                            @endphp
                            @foreach ($rubbish as $i => $x)
                                @php
                                    $qty_rubbish = 0;
                                    $tot_rubbish = 0;
                                    if ($id) {
                                        if ($i == 0) {
                                            $qty_rubbish = $so->cplastik;
                                            $tot_rubbish = $so->ctotal_plastik;
                                        } elseif ($i == 1) {
                                            $qty_rubbish = $so->ckertas;
                                            $tot_rubbish = $so->ctotal_kertas;
                                        } elseif ($i == 2) {
                                            $qty_rubbish = $so->cbesi;
                                            $tot_rubbish = $so->ctotal_besi;
                                        }
                                    }
                                @endphp
                                <!-- Plastik -->
                                <div class="col-md-3 col-sm-6 col-xs-12 mb-5">
                                    <label><b>{{ $x->typeof_rubbish }} Rp {{ $x->prices }}/kg</b></label>
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <table>
                                                <tr>
                                                    <td><label class="control-label"><b>Berat</b></label>
                                                        <input type="number" class="form-control" step="0.1"
                                                            name="{{ $qty[$i] }}" id="{{ $qty[$i] }}"
                                                            value="{{ $qty_rubbish }}" min="0" style="width: 4em"
                                                            onchange="kalkulasi(this)">
                                                        <input type="hidden" id="{{ $harga[$i] }}"
                                                            name="{{ $harga[$i] }}" value="{{ $x->prices }}">
                                                    </td>
                                                    <td><label class="control-label"><b>Rp</b></label>
                                                        <input type="text" readonly value="{{ $tot_rubbish }}"
                                                            id="tot{{ $harga[$i] }}" class="form-control">
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="card-footer">
                                            <div class="form-group foto">
                                                @if ($id)
                                                    @php
                                                        $cphoto = $so->cphoto1;
                                                        if ($i == 1) {
                                                            $cphoto = $so->cpoto2;
                                                        } elseif ($i == 2) {
                                                            $cphoto = $so->cpoto3;
                                                        }
                                                    @endphp

                                                    <img src="{{ url('assets/img/sales/' . $cphoto) }}" alt=""
                                                        width="100%" height="150px">
                                                @else
                                                    <img src="#" alt="" id="gambar{{ $i ?: '' }}" width="100%">
                                                @endif
                                                Foto Sampah {{ $x->typeof_rubbish }}
                                                <div class="form-group">
                                                    <input type="file" class="form-control" id="preview{{ $i ?: '' }}"
                                                        name="foto{{ $i ?: '' }}">
                                                    @php $foto = $i ? 'foto'.$i : 'foto' @endphp
                                                    <!--
                                                    @error($foto) <small class="text-danger">{{ $message }}</small> @enderror
                                                    -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End of Plastik -->
                            @endforeach

                            <!-- Info Tambahan -->
                            <div class="col-md-3 col-sm-6 col-xs-12 mb-5">
                                <label><b>Ringkasan</b></label>
                                <div class="card h-100">
                                    <div class="card-body">
                                        <a href="#">
                                            <p style="font-size: 28pt; text-align: center;" id="kategori">
                                                {{ isset($so->hasil) ? $so->hasil : 'JUAL' }}</p>
                                            <p style="font-size: 28pt; text-align: center;" id="total_harga">
                                                {{ isset($so->ctotal_harga) ? $so->ctotal_harga : '0' }}</p>
                                        </a>
                                    </div>
                                    <div class="card-footer">
                                        <div class="form-group foto">
                                            @if ($id)
                                                <img src="{{ url('assets/img/sales/' . $so->cpoto4) }}" alt=""
                                                    width="100%" height="150px">
                                            @else
                                                <img src="#" alt="" id="gambar3" width="100%">
                                            @endif
                                            Foto Lokasi / Penanda
                                            <div class="form-group">
                                                <input type="file" class="form-control" id="preview3" name="foto3">
                                                <!--
                                                @error('foto3') <small class="text-danger">{{ $message }}</small> @enderror
                                                -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Info Tambahan -->
                        </div>

                        @if (!$id)
                            <div class="row col-md-12">
                                <br>
                                <div class="submit-button text-center col-md-12">
                                    <button type="reset" class="btn btn-md btn-warning">CANCEL</button>
                                    <button type="submit" class="btn btn-md btn-primary"
                                        onclick="javascript:rbaddress();">SUBMIT</button>
                                </div>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        let lat = $('[name="latitude"]').val()
        let long = $('[name="longtitude"]').val()



        //untuk mengambil maps
        var mapsnyaWe = () => {
            window.open(`<?php echo url('maps/?lat=${lat}&&long=${long}'); ?>`,
                'popupwindow', 'scrollbars=yes, width=740,height=540');
            return false
        }

        function HandlePopupResult(hasil) {
            $('[name="latitude"]').val("" + hasil.lat);
            $('[name="longtitude"]').val("" + hasil.lng);
            $('[name="address_google"]').val("" + hasil.address);
        }

        function rbaddress() {
            console.log("rbaddress");

            var addtermp = "";
            if (document.getElementById('rbaddress1').checked) {
                //document.getElementById('ifPassport').style.display = 'block';
                //console.log('rbaddress1');
                console.log(document.getElementById('rbaddress1val').innerHTML);
                addtermp = document.getElementById('rbaddress1val').innerHTML;
                document.getElementById('address_pickup').value = addtermp;
            } else if (document.getElementById('rbaddress2').checked) {
                //console.log('rbaddress2');
                console.log(document.getElementById('rbaddress2val').value);
                addtermp = document.getElementById('rbaddress2val').value;
                document.getElementById('address_pickup').value = addtermp;
            } else if (document.getElementById('rbaddress3').checked) {
                //console.log('rbaddress3');
                //console.log(document.getElementById('rbaddress3val').value);
                addtermp = document.getElementById('rbaddress3val').value;
                document.getElementById('address_pickup').value = addtermp;
                //document.getElementById('address_pickup').value = "oooooooooooooo";
            }

        }

        function kalkulasi(data) {
            var id = data.id;
            var length = id.length;
            var qty = parseFloat(data.value);
            var get_id = id.substr(4, length - 4);
            var total = 0;
            var grand_total = 0;

            var harga_plastik = parseFloat($('#harga_plastik').val());
            var harga_kertas = parseFloat($('#harga_kertas').val());
            var harga_besi = parseFloat($('#harga_besi').val());

            if (get_id == 'plastik') {
                total = qty * harga_plastik;
                $('#totharga_plastik').val(total);
            } else if (get_id == 'kertas') {
                total = qty * harga_kertas;
                $('#totharga_kertas').val(total);
            } else if (get_id == 'besi') {
                total = qty * harga_besi;
                $('#totharga_besi').val(total);
            }

            var totharga_plastik = parseFloat($('#totharga_plastik').val());
            var totharga_kertas = parseFloat($('#totharga_kertas').val());
            var totharga_besi = parseFloat($('#totharga_besi').val());

            $('#total_harga').html(totharga_plastik + totharga_kertas + totharga_besi);
        }

        function bacaGambar(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#gambar').attr('src', e.target.result);
                    $('#gambar').attr('height', '150');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#preview").change(function() {
            bacaGambar(this);
        });


        function bacaGambar1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#gambar1').attr('src', e.target.result);
                    $('#gambar1').attr('height', '150');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#preview1").change(function() {
            bacaGambar1(this);
        });


        function bacaGambar2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#gambar2').attr('src', e.target.result);
                    $('#gambar2').attr('height', '150');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#preview2").change(function() {
            bacaGambar2(this);
        });

        function bacaGambar3(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#gambar3').attr('src', e.target.result);
                    $('#gambar3').attr('height', '150');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#preview3").change(function() {
            bacaGambar3(this);
        });

    </script>
@endsection