@extends('layoutadmin.main')

@section('title','Sales')
    
@section('contents')
    <!-- Begin Page Content -->
    <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Picked List</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of already-picked by Pemulung</h6>
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
                <th>Missed</th>
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
    @include('lapak.sales.modal-detail')

    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYY-wMcvr6cGuSynbDsfyABKsGzOlz9X0&libraries=places&callback=initMap">
    </script>


    <script>
        $(document).ready(function() {
            var table = $('#tablelapak').DataTable({
                processing: true,
                serverSide: true,
                "pageLength": 50,
                ajax: {
                    url: "{{ url('lapak/popick') }}",
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
                    {data: 'price', name: 'price'},
                    {data: 'missed', name: 'missed'},
                    // {data: 'status', name: 'status', render: function (data, type, row, meta) {
                    //     var status = '';
                    //     if(row.status == 0) {
                    //         status = 'Req';
                    //     } else if(row.status == 1) {
                    //         status = 'Book';
                    //     } else if(row.status == 2) {
                    //         status = 'Pick';
                    //     } else if(row.status == 3) {
                    //         status = 'Deliv';
                    //     }

                    //     return status;
                    // }},
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

        $(document).on('click', '.btn-view', function() {
            //e.preventDefault();
            let id = $(this).data('id');
            console.log(id);
            $.ajax({
                url : BASE_URL+'/lapak/so/'+id,
                type : "get",
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success : function(data) {
                    init(data.clat, data.clng)
                    setValue(data)
                    $('#modal-detail').modal('show')
                },error : function(xhr){
                    console.log(xhr);
                }
            })
        })

        function setValue(so){
            $('#text-header').text('request');

            $('#date').val(so.cdate)
            $('#time').val(so.ctime)
            $('#loc-jemput').val(so.caddress)
            $('#loc-map').val(so.caddressgoogle)

            $('#berat_plastik').val(so.cplastik)
            $('#harga_plastik').val(so.ctotal_plastik)
            $('#gambar1').prop('src', '{{ url('assets/img/sales/') }}/'+so.cphoto1);

            $('#berat_kertas').val(so.ckertas)
            $('#harga_kertas').val(so.ctotal_kertas)
            $('#gambar2').prop('src', '{{ url('assets/img/sales/') }}/'+so.cphoto2);

            $('#berat_besi').val(so.cbesi)
            $('#harga_besi').val(so.ctotal_besi)
            $('#gambar3').prop('src', '{{ url('assets/img/sales/') }}/'+so.cphoto3);

            $('#total').text('Rp. '+((so.ctotal_plastik + so.ctotal_besi + so.ctotal_kertas)/1000).toFixed(3))
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