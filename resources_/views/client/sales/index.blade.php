@extends('layout.main')
@section('title', 'Sales')

@section('content')
<!-- ======= Services Section ======= -->
<section id="services" class="services">
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
                        <li class="active">History Order</li>
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /BREADCRUMB -->

    <br>

    <main id="main">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>History Order</h2>
            </div>

            <div class="row inner-menu-box">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-4 col-xs-12">
                            <!-- <a href="{{ url('/client/sales/create') }}" class="btn btn-sales">+ Buat Order</a> -->
                        </div>
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
                            <button type="button" class="btn btn-primary" id="cari">cari</button>
                        </div>
                    </div>
                    <div class="table-responsive mt-4">
                        <table class="table" id="table_so">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Aksi</th>
                                    <th>Tanggal</th>
                                    <th>Lokasi</th>
                                    <th>Berat</th>
                                    <th>Rp</th>
                                    <th>Kat</th>
                                    <th>Sts</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Menu -->
    </main>

    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="requestModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:100%;max-width:1250px" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="requestModalLabel">DETAIL OF REQUEST ORDER</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @include('client.sales.modal-view-request')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	
	//CLIENT > MENU HISTORY > FIRST LOAD > GRID PROVIDER
    $(document).ready(function() {
		//var hasil = 'a';
        var table = $('#table_so').DataTable({
            processing: true,
            serverSide: true,
            searching : false,
            ajax: {
                url: "{{ url('client/get-data') }}",
                data: function (d) {
                    d.cari = $('input[name=cari]').val();
                    // d.status = $('#status').val();
                },				
				
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
				 {data: 'aksi', name: 'aksi'},
				/*{data: 'aksi', name: 'aksi'},*/
                {data: 'cdate', name: 'cdate'/* , render: function (data, type, row, meta) {
                    return row.cdate+' '+row.ctime;
                } */},				
                {data: 'caddress', name: 'caddress>'},
                {data: 'cplastik', name: 'cplastik', render: function (data, type, row, meta) {
                    return row.cplastik+"/"+row.ckertas+"/"+row.cbesi;
                }},
                {data: 'ctotal_harga', name: 'ctotal_harga', render: function (data, type, row, meta) {
                    return number_format(row.ctotal_harga);
                }},
                {data: 'hasil', name: 'hasil'},
                {data: 'status', name: 'status', render: function (data, type, row, meta) {
                    var status = '';
                    if(row.status == 0) {
                        status = 'Req';
                    } else if(row.status == 1) {
                        status = 'Book';
                    } else if(row.status == 2) {
                        status = 'Pick';
                    } else if(row.status == 3) {
                        status = 'Deliv';
                    }

                    return status;
                }},
               
                
            ],
            order: [[1, "desc"]],
        });
        // $('#cari, #v-pills-req-tab, #v-pills-done-tab, #v-pills-cancel-tab').on('click',function() {
        $('#cari').on('click',function() {
            table.ajax.reload()
        })
    })

	//CLIENT > HISTORY > ACTION > VIEW > CLICK
	//PROVIDER DATA PADA MODAL
    function viewRequest(e) {
		//alert("viewRequest");
        $('#kategori').html($(e).data('hasil'));

        if($(e).data('hasil') == 'Jual') {
            $('#Jual').prop('selected', true);
            $('#Donasi').prop('selected', false);
        } else {
            $('#Donasi').prop('selected', true);
            $('#Jual').prop('selected', false);
        }

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

    function number_format (number, decimals, dec_point, thousands_sep) {
        // Strip all characters but numerical ones.
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }
</script>
@endsection
