@extends('layoutadmin.main')

@section('title','Sales')
    
@section('contents')
    <!-- Begin Page Content -->
    <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Sales</h6>
        </div>
        <div class="card-body">
       @if (Session('gagal'))
            <div class="alert alert-danger">
                {{ Session('gagal') }}
            </div>
       @endif
       @if (Session('berhasil'))
            <div class="alert alert-success">
                {{ Session('berhasil') }}
            </div>
       @endif
       <div class="row mb-3">
           <div class="col-md-5 col-xs-12">
               <input type="date" name="from" class="form-control" id="">
           </div>
           <div class="col-md-5 col-xs-12">
               <input type="date" name="to" class="form-control" id="">
           </div>
           <div class="col-md-2 col-xs-12">
                <button type="button" id="filtertgl" class="btn btn-primary btn-block">Filter</button>
           </div>
       </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="tablelapak" width="100%" cellspacing="0">
            <thead>
                <tr>
                <th>No</th>
                <th>Jemput</th>
                <th>Jam</th>
                <th>Alamat</th>
                <th>Nama</th>
                <th>Berat</th>
                <th>Rp</th>
                <th>Status</th>
                <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            </table>
        </div>
        </div>
    </div>

    </div>
    <!-- /.container-fluid -->

    <script>
        $(document).ready(function() {
            var table = $('#tablelapak').DataTable({
                processing: true,
                serverSide: true,
                "pageLength": 50,
                ajax: {
                    url: "{{ url('lapak/poreceiving') }}",
                    data: function (d) {
                        d.from = $('input[name=from]').val();
                        d.to = $('input[name=to]').val();
                    }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'cdate', name: 'cdate'},
                    {data: 'ctime', name: 'ctime'},
                    {data: 'caddress', name: 'caddress'},
                    {data: 'username', name: 'username'},
                    {data: 'ctotal_berat', name: 'ctotal_berat'},
                    {data: 'ctotal_harga', name: 'ctotal_harga'},
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
                    {data: 'action', name: 'action'},
                ]
            });
            $('#filtertgl').on('click',function() {
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