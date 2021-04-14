@extends('layout.main')
@section('title', 'Client')

@section('content')
<style>
    .pac-container { z-index: 100000 !important; }
    .search-address {
        z-index: 0;
        width: 55%;
        position: absolute;
        left: 175px;
        top: 0px;
        margin-top: 10px;
    }
</style>
<main id="main">
    <!-- ======= profile Section ======= -->
    <section id="profile" class="profile">
        <div class="container">
            <h4>PASSWORD</h4>
            <form action="{{ route('client.password.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control" value="{{ old('password') }}" >
                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}" >
                            @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-2">
                    <button class="btn float-right btn-primary" type="submit">Update</button>
                    <a href="{{ route('client.profile') }}" class="btn float-right mr-2 btn-warning">Batal</a>
                </div>
            </form>
        </div>
    </section>
    <x-modal-maps/>
</main>
@endsection