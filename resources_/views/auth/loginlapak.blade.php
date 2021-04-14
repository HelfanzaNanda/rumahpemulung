<!DOCTYPE html>
<html lang="en">
<head>
    @include('layoutadmin.header')
</head>
<body class="bg-gradient-primary">
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-6 col-lg-6 col-md-6">
    
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                    <!-- <div class="row">
                        <div class="col-lg-6"> -->
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Login Lapak!</h1>
                                </div>
                                
                                @if (Session('gagal'))
                                    <div class="alert alert-danger">
                                        <div>{{ Session('gagal') }}</div>
                                    </div>
                                @endif

                                <form action="{{ url('lapak/login') }}" method="POST" class="user">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user"
                                        id="email" name="email" placeholder="Email">
                                         @error('email') <small class="text-danger">{{ $message }}</small> @enderror       
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user"
                                        id="password" name="password" placeholder="Password">
                                         @error('password') <small class="text-danger">{{ $message }}</small> @enderror           
                                    </div>
                                    <br>
                                    <input class="btn btn-primary btn-user btn-block" type="submit" value="Masuk">
                                    <!-- <a href="index.html" class="btn btn-primary btn-user btn-block">Login</a> -->
                                </form>
                            </div>
                        <!-- </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>

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
</body>
</html>