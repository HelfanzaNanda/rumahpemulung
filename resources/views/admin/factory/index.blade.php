@extends('layoutadmin.main')

@section('title','Lapak')
    
@section('contents')
    <!-- Begin Page Content -->
    <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Factory</h6>
            <a href="{{ url('superadmin/factory/create') }}" class="d-flex justify-content-end"><i class="fa fa-plus"></i></a>
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
            <table class="table table-bordered" id="tablefactory" width="100%" cellspacing="0">
            <thead>
                <tr>
                <th>No</th>
                <th>Nama Facotory</th>
                <th>Nama Pemilik</th>
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
            var table = $('#tablefactory').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('superadmin/factory') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'nameof_factory', name: 'nameof_factory'},
                    {data: 'owner_factory', name: 'owner_factory'},
                    {data: 'phone_factory', name: 'phone_factory'},
                    {data: 'email_factory', name: 'email_factory'},
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