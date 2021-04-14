<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container-fluid d-flex justify-content-between align-items-center">

        <a href="/" class="logo"><img src="{{ asset('assets/img/logo-header.png') }}" alt="" class="img-fluid"
                width="50%"></a>

        <nav class="nav-menu d-none d-lg-block">
            <ul class="text-right">
                @if (Auth::guard('client')->check())
                    <li><a href="{{ url('client') }}">Home</a></li>
                    <li><a href="{{ url('client/request') }}">Request</a></li>
                    <li><a href="{{ url('client/history') }}">History</a></li>
                    <!-- <li><a href="{{ url('blogs') }}">Blogs</a></li> -->
                    <li><a href="{{ url('logout')}}">Logout</a></li>
                    @elseif(Auth::guard('pemulung')->check())
                    <li><a href="{{ url('pemulung') }}">Home</a></li>
                    <li><a href="{{ url('pemulung/salesreq') }}">Permintaan</a></li>
                    <li><a href="{{ url('pemulung/mybook') }}">Penjemputan</a></li> <!-- My Book -->
                    <li><a href="{{ url('pemulung/mypick') }}">Riwayat</a></li> <!-- My Pick -->
                    <!--
                    <li><a href="{{ url('pemulung/mydeliver') }}">My Deliver</a></li>
                    -->
                    <li><a href="{{ url('logout')}}">Logout</a></li>
                @else
                    <li><a href="/#about">About</a></li>
                    <li><a href="{{ url('blogs') }}">Blogs</a></li>
                    <li><a href="/#contact">Contact</a></li>
                    <li><a href="{{ url('register') }}">Sign Up</a></li>
                    <li data-toggle="modal" data-target="#mylogin"><a href="#"><span
                        class="glyphicon glyphicon-log-in"></span> Login</a></li>
                @endif
            </ul>
        </nav>
    </div>
</header>
<!-- End Header -->

<!-- Modal login -->
<div id="mylogin" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Login Account</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            {{-- set message --}}

            <div class="modal-body">
               <div id="tec"></div>
                <form id="fr-login">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Password">
                    </div>
                    <div class="form-group form-check mt-0">
                        <input type="checkbox" class="form-check-input" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Ingat Saya</label>
                    </div>
                    <div class="modal-footer">
                        <div class="submit-button text-center">
                            <button class="btn btn-success" id="submit" type="button">Login</button>
                            <div id="msgSubmit" class="h3 text-center hidden"></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div>
                        <div class="text-center">
                            <p>Login menggunakan:</p>
                            <div class="g-signin2" align="center" data-onsuccess="onSignIn"></div>
                        </div>
                    </div>
                    <br>
                    <div>
                        <div>
                            <a href="/register">Belum punya akun?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Login -->
<!-- Template Main JS File -->
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/js/PlacePicker.js') }}"></script>
<script src="{{ asset('assets/js/demo.js') }}"></script>
<script src="{{ asset('assets/js/front.js') }}"></script>
<script>


    $('#submit').on('click',function() {
        $('#tec').html('<div class="alert alert-danger notifku">Sedang Proses</div>')
        let token = $('meta[name="token"]').attr('content')
        let email = $('[name="email"]').val()
        let password = $('[name="password"]').val()
        $.ajax({
            url : "{{url('login')}}",
            type : "post",
            data : {
                _token : token,
                email : email,
                password : password,
            },
            success : function(response) {
                if (response.error) {
                    $('#tec').html('<div class="alert alert-danger notifku">'+ response.error +'</div>')
                    $('#tec').slideDown(2000)
                    $('#tec').next()
                    $('#tec').slideUp(2000)
                }
                if (response.berhasil == 'login') {
                    window.location.href = "{{ url('client') }}"
                }
            }
        })
    })

</script>
