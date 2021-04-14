@extends('layoutadmin.main')

@section('title','Client')
    
@section('contents')
    <!-- Begin Page Content -->
    <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Factory</h6>
            {{-- <a href="{{ url('lapak/client/create') }}" class="d-flex justify-content-end"><i class="fa fa-plus"></i></a> --}}
        </div>
        <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="tablelapak" width="100%" cellspacing="0">
            <thead>
                <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Phone</th>
                <th>Email</th>
                {{-- <th>Status</th> --}}
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

    @include('lapak.factory.modal')
    <!-- /.container-fluid -->

    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYY-wMcvr6cGuSynbDsfyABKsGzOlz9X0&libraries=places&callback=initMap">
    </script>

    <script>
        $(document).ready(function() {
            var table = $('#tablelapak').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('lapak.factory.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'nameof_factory', name: 'nameof_factory'},
                    {data: 'owner_factory', name: 'owner_factory'},
                    {data: 'phone_factory', name: 'phone_factory'},
                    // {data: 'status', name: 'status'},
                    {data: 'action', name: 'action'},
                ]
            });
        })

        $(document).on('click', '.btn-detail', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            $.ajax({
                url : BASE_URL+'/lapak/factory/'+id+'/get',
                type : "get",
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success : function(data) {
                    //console.log(data);
                    init(data.latitude, data.longtitude)
                    setValue(data)
                    $('#modal-detail').modal('show')
                },error : function(xhr){
                    console.log(xhr);
                }
            })
        })

        function setValue(factory){
            $('#text-header').text('Factory');

            $('#nameof_factory').val(factory.nameof_factory)
            $('#owner_factory').val(factory.owner_factory)
            $('#phone_factory').val(factory.phone_factory)
            $('#email_factory').val(factory.email_factory)

            $('#address_factory').val(factory.address_factory)
            $('#photo_factory').val(factory.photo_factory)
            $('#address_google').val(factory.address_google)
            $('#latitude').val(factory.latitude)
            $('#longtitude').val(factory.longtitude)
            $('#photo').prop('src', '{{ url('images/') }}/'+factory.photo_factory);
        }

        
        function init(lat, lng){
            myLoc = new google.maps.LatLng(lat, lng)
            let opt = {
                    center: myLoc,
                    zoom: 13,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            const map = new google.maps.Map(document.getElementById('googleMap'), opt);
            const marker = new google.maps.Marker();
            marker.setPosition(myLoc);
            marker.setMap(map);
        }
    </script>
@endsection