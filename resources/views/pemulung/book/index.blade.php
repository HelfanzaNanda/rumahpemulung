@extends('layout.main')
@section('title', 'Penjemputan')

@section('content')
    <section class="section-header bg-1" style="max-height:50px;">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="text-center">
						<h1 class="text-capitalize mb-4 font-lg text-white">Selesaikan Pengambilan Sampah</h1>
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
                        {{-- <div class="col-md-4 col-xs-12"></div> --}}
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
                            <button type="button" class="btn btn-warning" id="cari">CARI</button>
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
<script>
    $(document).ready(function() {
        var table = $('#rt').DataTable({
            processing: true,
            searching : false,
            serverSide: true,
            ajax: {
                url: "{{ url('pemulung/mybook') }}",
                data: function (d) {
                    d.cari = $('input[name=cari]').val();
                    d.date = $('#search-date').val()
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
            ]
        });
        $('#cari').on('click',function() {
            table.ajax.reload()
        })
    })
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