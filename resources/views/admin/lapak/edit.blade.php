@extends('layoutadmin.main')

@section('title','Edit Lapak')
    
@section('contents')
    <!-- Begin Page Content -->
    <div class="container-fluid">

 
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header">
            <h3 class="card-title">Edit Lapak</h3>
        </div>
        <div class="card-body">
        <div class="table-responsive">
           <form action="{{ url('superadmin/lapak/'.$lapak->id) }}" method="post">
                @csrf
                @method('patch')
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Nama Usaha</label>
                                <input type="text" name="namaUsaha" value="{{ $lapak->namaUsaha }}" class="form-control">
                                @error('namaUsaha') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Nama Pemilik</label>
                                <input type="text" name="namaPemilik" value="{{ $lapak->namaPemilik }}" class="form-control">
                                @error('namaPemilik') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="phone" value="{{ $lapak->phone }}" class="form-control">
                                @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" value="{{ $lapak->email }}" class="form-control">
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Address</label>
                                <textarea name="address" class="form-control" rows="2">{{ $lapak->address }}</textarea>
                                @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>Google Address</label>
                                <textarea name="address_google" class="form-control"  rows="2">{{ $lapak->address_google }}</textarea>
                                @error('address_google') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-12 mt-5">
                            <div class="form-group">
                                <div>
                                    <a class="btn btn-primary btn-block" href="javascript:void(0);" data-toggle="tooltip" title="Ambil Lokasi" onclick="mapsnyaWe()">Ambil Lokasi</i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                            <label class="control-label">Latitude</label>
                            <div>
                                <input type="text" name="latitude" placeholder="latitude ..." class="form-control form-control-user" readonly value="{{$lapak->latitude}}">
                            </div>  
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                            <label>Longitude</label>
                            <div>
                                <input type="text" name="longitude" placeholder="longitude..." class="form-control form-control-user" readonly value="{{$lapak->longtitude}}">
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Photo</label>
                                <input type="file" name="photo" class="form-control">
                                <input type="hidden" name="photolama" value="{{ $lapak->photo_lapak }}">
                                @error('photo') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mt--5">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group mt-5">
                                <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                            </div>
                        </div>
                    </form>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group mt-5">
                                <form action="{{ url('superadmin/lapak/'.$lapak->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" onclick="return confirm('apakah anda yakin?')" class="btn btn-danger btn-block">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </div>
    </div>

    </div>
    <!-- /.container-fluid -->
    <script>
            let lat = $('[name="latitude"]').val()
            let long = $('[name="longitude"]').val()
          //untuk mengambil maps
          var mapsnyaWe = () => {
              window.open(`<?php echo url('maps/?lat=${lat}&&long=${long}')?>`, 'popupwindow', 'scrollbars=yes, width=740,height=540');
              return false
          }
    
          function HandlePopupResult(hasil) {
              $('[name="latitude"]').val("" + hasil.lat);
              $('[name="longitude"]').val("" + hasil.lng);
              $('[name="address_google"]').val("" + hasil.address);
          }
    </script>
@endsection