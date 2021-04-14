@extends('layoutadmin.main')

@section('title','Edit Client')
    
@section('contents')
    <!-- Begin Page Content -->
    <div class="container-fluid">

 
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header">
            <h3 class="card-title">Edit Client</h3>
        </div>
        <div class="card-body">
        <div class="table-responsive">
           <form action="{{ route('client.update',$client->id) }}" method="post">
                @csrf
                @method('patch')
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Nama Client</label>
                                <input type="text" name="fullname_client" value="{{ $client->fullname_client }}" disabled class="form-control">
                                @error('fullname_client') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="phone_client" value="{{ $client->phone_client }}" disabled class="form-control">
                                @error('phone_client') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Username</label>
                                <textarea name="username" disabled class="form-control" rows="2">{{ $client->username }}</textarea>
                                @error('username') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email_client" value="{{ $client->email_client }}" disabled class="form-control">
                                @error('email_client') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Address</label>
                                <textarea name="address_client" disabled class="form-control" rows="2">{{ $client->address_client }}</textarea>
                                @error('address_client') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Status</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="isactivated" value="{{ ($client->isactivated == 1) ? '0' : '1' }}" onclick="ubahstatus(this.value)" class="custom-control-input" {{ ($client->isactivated == 1) ? 'checked' : '' }} id="customSwitch1">
                                    <label class="custom-control-label" for="customSwitch1">{{($client->isactivated == 1) ? 'Aktif' : 'Non Aktif' }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('client.index') }}" class="btn btn-secondary">Batal</a>
                    {{-- <div class="row mt--5">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group mt-5">
                                <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                            </div>
                        </div>
                    </form>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group mt-5">
                                <form action="{{ url('lapak/client/'.$client->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" onclick="return confirm('apakah anda yakin?')" class="btn btn-danger btn-block">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div> --}}
                </div>
        </div>
        </div>
    </div>

    </div>
    <!-- /.container-fluid -->
    <script>
        function ubahstatus(val) {
            let c = confirm('apakah anda yakin?')
            if (c == true) {
                let token = $('meta[name="token"]').attr('content')
                $.ajax({
                    url : "{{ url('lapak/client/'.$client->id) }}",
                    type : 'post',
                    data : {
                        _token : token,
                        _method : 'patch',
                        status : val
                    },
                    success : function(response) {
                        if (response == 'berhasil') {
                            location.reload()
                        }
                    }
                })
            }else{
                location.reload()
            }
        }
    </script>
@endsection