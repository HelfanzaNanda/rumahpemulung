@extends('layout.main')
@section('title', 'Profile')

@section('content')
<div id="container"></div>

<!--profil avatar-->
<img src="{{ url('assets/img/profile/'.Auth::guard('client')->user()->photo) }}" class="avatar">
<!--avatar end-->
<br><br>
<main id="main">
    <!-- ======= Services Section ======= -->
    <section id="sales" class="section blog-post">
        <div class="container" data-aos="fade-up">

            <!-- Start Menu -->
            <div class="menu-box">
                <div class="container">

                    @if(Session('gagal'))
                    <div class="alert alert-danger">
                        <div>{{Session::get('gagal')}}</div>
                    </div>
                    @endif
                    @if(Session('berhasil'))
                    <div class="alert alert-success">
                        <div>{{Session::get('berhasil')}}</div>
                    </div>
                    @endif
                    <br>
                    <div class="row inner-menu-box">
                        <div class="col-3">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <a class="nav-link active" id="v-pills-wait-tab" data-toggle="pill" href="#v-pills-wait"
                                    role="tab" aria-controls="v-pills-wait" aria-selected="true">&nbsp;Edit Profile</a>
                                <a class="nav-link" id="v-pills-cancel-tab" data-toggle="pill" href="#v-pills-cancel"
                                    role="tab" aria-controls="v-pills-cancel" aria-selected="false">&nbsp;Change
                                    Password</a>
                            </div>
                        </div>

                        <div class="col-9">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-wait" role="tabpanel"
                                    aria-labelledby="v-pills-wait-tab">
                                    <form enctype="multipart/form-data" action="{{ url('client/update') }}" method="post">
                                        @csrf
                                        @method('patch')
                                        <div class="row mt-4">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nama"><b>Nama</b></label>
                                                    <input type="text" name="nama" id="nama" class="form-control"
                                                        value="{{ Auth::guard('client')->user()->fullname_client }}" require autofocus>
                                                </div>

                                                <div class="form-group">
                                                    <label for="nama"><b>Username</b></label>
                                                    <input type="text" name="usernama" id="username"
                                                        class="form-control" value="{{ Auth::guard('client')->user()->username }}" readonly>
                                                </div>

                                                <div class="form-group">
                                                    <label for="nama"><b>Email</b></label>
                                                    <input type="text" name="email" id="email" class="form-control"
                                                        value="{{ Auth::guard('client')->user()->email_client }}" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <label for="phone"><b>no. Telepon</b></label>
                                                    <input id="phone" type="text" class="form-control" name="phone"
                                                        value="{{ Auth::guard('client')->user()->phone_client }}" require autofocus>
                                                </div>

                                                <div class="form-group">
                                                    <label for="alamat"><b>Alamat</b></label>
                                                    <textarea rows="3" id="address" name="address" class="form-control"
                                                     require autofocus>{{ Auth::guard('client')->user()->address_client }}</textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label for="file" class="col-md-4 control-label"><b>Foto Profil</b></label>
                                                    <input type="file" class="form-control" id="file" name="file">
                                                </div>

                                                <div class="form-group">
                                                    <br>
                                                    <div class="submit-button text-right">
                                                        <button class="btn btn-success" id="submit"
                                                            type="submit">Simpan</button>
                                                        <div id="msgSubmit" class="h3 text-center hidden"></div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                </div>

                                <div class="tab-pane fade" id="v-pills-cancel" role="tabpanel"
                                    aria-labelledby="v-pills-cancel-tab">
                                    <div class="row mt-4">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="new"><b>Password Baru</b></label>
                                                <input type="password" class="form-control" id="new" name="new"
                                                    minlength="6" placeholder="Password" require autofocus>
                                            </div>

                                            <div class="form-group">
                                                <label for="old"><b>Password Lama</b></label>
                                                <input type="password" class="form-control" id="old" name="old"
                                                    minlength="6" placeholder="Password" require autofocus>
                                            </div>

                                            <div class="form-group">
                                                <br>
                                                <div class="submit-button text-right">
                                                    <button class="btn btn-success" id="submit" type="submit">Change
                                                        Password</button>
                                                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Menu -->
            </div>
    </section>
    <br><br>
</main>
@endsection