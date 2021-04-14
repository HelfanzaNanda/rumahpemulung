@extends('layout.main')
@section('title', 'Permintaan')

@section('content')
    <section class="section-header bg-1" style="max-height:50px;">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="text-center">
						<h1 class="text-capitalize mb-4 font-lg text-white">Permintaan Pengambilan Sampah</h1>
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
            <div class="col-md-12 col-xs-12 table-responsive">
                @if (Session('berhasil'))
                    <div class="alert alert-success">
                        {{ Session('berhasil') }}
                    </div>
                @endif

                <table class="table" id="rt">
                    <div class="row justify-content-end">
                        {{-- <div class="col-md-1 col-xs-12">
                            <button type="button" class="btn btn-default"><</button>
                        </div> --}}
                        <div class="col-md-2 col-xs-12">
                            <div class="d-flex justify-content-center">
                                <input type="date" id="search-date" name="date" class="form-control inputsm">
                            </div>
                        </div>
                        {{-- <div class="col-md-1 col-xs-12">
                            <button type="button" class="btn btn-default">></button>
                        </div> --}}
                        <div class="col-md-3 col-xs-12">
                            <input type="text" name="cari" class="form-control">
                        </div>
                        <div class="col-md-1 col-xs-12">
                            <button type="button" class="btn btn-success" id="cari">CARI</button>
                        </div>
                    </div>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Aksi</th>
                            <th>Jemput</th>
							<th>Jam</th>
                            <th>Alamat Jemput</th>
							<th>Nama</th>
                            <th>Plastik</th>
                            <th>Kertas</th>
                            <th>Besi</th>
                            <th>Rp</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="requestModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:100%;max-width:1250px" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="requestModalLabel">PEMULUNG - Request Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @include('pemulung.request.modal-view-request')
      </div>      
		
    </div>
  </div>
</div>
@include('pemulung.request.modal-confirm-submit')
<x-modal-success/>
<x-modal-error/>
<script>
    $(document).ready(function() {
        var table = $('#rt').DataTable({
            processing: true,
            serverSide: true,
            searching : false,
            ajax: {
                url: "{{ url('pemulung/salesreq') }}",
                data: function (d) {
                    d.cari = $('input[name=cari]').val();
                    d.date = $('#search-date').val()
                    console.log(d);
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
				{data: 'aksi', name: 'aksi'},
                {data: 'cdate', name: 'cdate'},
                {data: 'ctime', name: 'ctime'},
                {data: 'caddress', name: 'caddress'},
                {data: 'username', name: 'username'},
                {data: 'cplastik', name: 'cplastik'},
                {data: 'ckertas', name: 'ckertas'},
                {data: 'cbesi', name: 'cbesi'},
                {data: 'price', name: 'ctotal_harga'},
                
            ],
            order: [[7, "desc"]],
        });
        $('#cari').on('click',function() {
            table.ajax.reload()
        })
    });

    //PEMULUNG > PERMINTAAN > ACTION > VIEW > CLICK
	//PROVIDER DATA PADA MODAL
    function viewRequest(e) {
        $('#kategori').html($(e).data('hasil'));

        if($(e).data('hasil') == 'Jual') {
            $('#Jual').prop('selected', true);
            $('#Donasi').prop('selected', false);
        } else {
            $('#Donasi').prop('selected', true);
            $('#Jual').prop('selected', false);
        }

        $('#id_so').val($(e).data('id_so'));
		$('#date').val($(e).data('cdate'));
        $('#jam').val($(e).data('jam'));
        $('#menit').val($(e).data('menit'));
        $('#address_google').val($(e).data('caddress'));
        $('#latitude').val($(e).data('clat'));
        $('#longtitude').val($(e).data('clng'));
        $('#qty_plastik').val($(e).data('cplastik'));
        $('#qty_kertas').val($(e).data('ckertas'));
        $('#qty_besi').val($(e).data('cbesi'));
        $('#totharga_plastik').val($(e).data('ctotal_plastik'));
        $('#totharga_kertas').val($(e).data('ctotal_kertas'));
        $('#totharga_besi').val($(e).data('ctotal_besi'));
        $('#total_harga').html($(e).data('ctotal_harga'));
        $('#gambar').prop('src', '{{ url('assets/img/sales/') }}/'+$(e).data('cphoto1'));
        $('#gambar1').prop('src', '{{ url('assets/img/sales/') }}/'+$(e).data('cpoto2'));
        $('#gambar2').prop('src', '{{ url('assets/img/sales/') }}/'+$(e).data('cpoto3'));
        $('#gambar3').prop('src', '{{ url('assets/img/sales/') }}/'+$(e).data('cpoto4'));
        $('#keterangan').val($(e).data('cketerangan'));

        //UNTUK MENAMPILKAN PETA
        var propertiPeta = {
            //center:new google.maps.LatLng(-7.7129424,110.0092652),
            center:new google.maps.LatLng($(e).data('clat'),$(e).data('clng')),
            //center:new google.maps.LatLng(val($(e).data('clng'),  document.getElementById("longitude").value),
            zoom:15,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        };
    
        var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);
        //alert("Hello world! " + document.getElementById("latitude").value);
        // membuat Marker
        var marker=new google.maps.Marker({
            
            //position: new google.maps.LatLng(-9.7129424,110.0092652),
            position: new google.maps.LatLng($(e).data('clat'),$(e).data('clng')),
            //position: new google.maps.LatLng(document.getElementById("latitude").value,  document.getElementById("longitude").value), 
            map: peta
        });
    }

    $(function() {
        notifikasi();
    });

    var notifikasi = (e) => {
    var alertNya = $('.alert');
        setTimeout(function() {
            alertNya.slideUp('slow');
        }, 2000);
    }

    let form_data
    let url = "{{ url('pemulung/dobook') }}";
    $('form#form').submit( function(e) {
        e.preventDefault();
        form_data = new FormData( this );
        $('#requestModal').modal('hide')
        $('#modal-confirm-submit').modal('show')
    })

    $(document).on('click', '.btn-submit', function(e) {
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
                //console.log(res);
                if(res.status){
                    $('#modal-success').modal('show')
                    setTimeout(() => {
                        $('#modal-success').modal('hide')
                        window.location.href = "{{ url('pemulung/salesreq') }}"
                    }, 1000);
                } 
            }
        })
    })
</script>
@endsection
