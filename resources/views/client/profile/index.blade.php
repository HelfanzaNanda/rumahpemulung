@extends('layout.main')
@section('title', 'Client')

@section('content')
<main id="main">
    <!-- ======= profile Section ======= -->
    <section id="profile" class="profile">
        <div class="container">
            @if(Session('error'))
                    <div class="alert alert-danger">
                        <div>{{Session::get('error')}}</div>
                    </div>
                    @endif
                    @if(Session('success'))
                    <div class="alert alert-success">
                        <div>{{Session::get('success')}}</div>
                    </div>
                    @endif
            <h4>PROFIL</h4>
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <img src="{{ asset('images/'.$user->photo) }}" 
                            style="height: 100px; object-fit: cover; object-position: center">  
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Username</label>
                                        <input type="text" class="form-control" value="{{ $user->username }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Nama Lengkap</label>
                                        <input type="text" class="form-control" value="{{ $user->fullname_client }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="text" class="form-control" value="{{ $user->email_client }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">No Hp</label>
                                        <input type="text" class="form-control" value="{{ $user->phone_client }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Alamat</label>
                                        <textarea readonly class="form-control">{{ $user->address_client }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Alamat Google</label>
                                        <textarea readonly class="form-control">{{ $user->address_google }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-2">
                <a href="{{ route('client.profile.edit') }}" class="btn text-white float-right btn-primary">Edit Profile</a>
                <a href="{{ route('client.password.edit') }}" class="btn text-white float-right mr-2 btn-warning">Edit Password</a>
            </div>
        </div>
    </section>
</main>
@endsection

@push('scripts')
    <script>
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
@endpush