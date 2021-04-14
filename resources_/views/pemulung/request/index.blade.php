@extends('layout.main')
@section('title', 'Request Order')

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
                    <div class="row">
                        <div class="col-md-4 col-xs-12"></div>
                        <div class="col-md-1 col-xs-12">
                            <button type="button" class="btn btn-default"><</button>
                        </div>
                        <div class="col-md-2 col-xs-12">
                            <div class="d-flex justify-content-center">
                                <input type="date" name="tgl" class="form-control inputsm">
                            </div>
                        </div>
                        <div class="col-md-1 col-xs-12">
                            <button type="button" class="btn btn-default">></button>
                        </div>
                        <div class="col-md-3 col-xs-12">
                            <input type="text" name="cari" class="form-control">
                        </div>
                        <div class="col-md-1 col-xs-12">
                            <button type="button" class="btn btn-primary" id="cari">cariq</button>
                        </div>
                    </div>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Aksi</th>
                            <th>Pick</th>
							<th>Jam</th>
                            <th>Alamat</th>
							<th>Nama</th>
                            <th>Plastik</th>
                            <th>Kertas</th>
                            <th>Besi</th>
                            <th>Rp</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    {{-- @foreach ($order as $x)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $x->username }}</td>
                            <td>{{ Str::substr($x->caddress, 0, 50) }}</td>
                            <td>{{ $x->cplastik }}</td>
                            <td>{{ $x->ckertas }}</td>
                            <td>{{ $x->cbesi }}</td>
                            <td>{{ $x->ctotal_harga }}</td>
                            <td>{{ $x->cdate }}</td>
                            <td>{{ $x->ctime }}</td>
                            <td><a href="{{ url('pemulung/salesreq/pickup/'.$x->id) }}" onclick="return confirm('anda akan ambil pickup ini?')" class="btn btn-success">Pick Up</a></td>
                        </tr>
                    @endforeach --}}
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
                {data: 'ctotal_harga', name: 'ctotal_harga'},
                
            ],
            order: [[7, "desc"]],
        });
        $('#cari').on('click',function() {
            table.ajax.reload()
        })
    });

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
</script>
@endsection
