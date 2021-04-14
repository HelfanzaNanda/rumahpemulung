@extends('layoutadmin.main')

@section('title','Pemulung')
    
@section('contents')
    <!-- Begin Page Content -->
    <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Pemulung</h6>
            <a href="{{ url('lapak/pemulung/create') }}" class="d-flex justify-content-end"><i class="fa fa-plus"></i></a>
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
        <div class="table-responsive">
            <table class="table table-bordered" id="tablelapak" width="100%" cellspacing="0">
            <thead>
                <tr>
                <th>No</th>
                <th>Nama Pemuung</th>
                <th>Phone</th>
                <th>Email</th>
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
                ajax: "{{ url('lapak/pemulung') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'nameof_collector', name: 'nameof_collector'},
                    {data: 'phone_collector', name: 'phone_collector'},
                    {data: 'email_collector', name: 'email_collector'},
                    {data: 'isactivated', name: 'isactivated'},
                    {data: 'action', name: 'action'},
                ]
            });
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