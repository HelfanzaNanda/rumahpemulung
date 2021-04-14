@extends('layout.main')
@section('title', 'Register')

@section('content')
<br><br>
<div class="container" style="margin-top:20px">
    <br><br>
    <div class="heading-title text-center">
        <h3>Sign Up Account</h3>
    </div>
    
    @if( Session('gagal') )
    <div class="alert alert-danger notifku">
        <div>{{ Session('gagal') }}</div>
    </div>
    @endif
    @if( Session('berhasil'))
    <div class="alert alert-success notifku">
        <div>{{ Session('berhasil') }}</div>
    </div>
    @endif

    <form action="{{url('/register')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
        @csrf
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="form-group has-error">
                    <label for="fullname" class="col-md-4 control-label"><b>Nama</b></label>
                    <input id="fullname" type="text" class="form-control" name="fullname" value="{{ old('fullname') }}" required placeholder="Fullname" autofocus>
                    @error('fullname') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                            
                <div class="form-group">
                    <label for="username" class="col-md-4 control-label"><b>Username</b></label>
                    <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required placeholder="Fullname" autofocus>
                    @error('username') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                            
                <div class="form-group">
                    <label for="phone" class="col-md-4 control-label"><b>no. Telepon</b></label>
                    <input id="phone" type="number" class="form-control" name="phone" placeholder="No.Telepon" required autofocus>
                    @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                            
                <div class="form-group">
                    <label for="pickup_country" class="col-md-4 control-label"><b>Alamat</b></label>
                    <textarea name="address" rows="3" class="form-control" required> </textarea>
                    {{-- <input type="text" id="pickup_country" name="address" rows="3" class="form-control" placeholder="Address" autofocus> --}}
                    @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="photo" class="col-md-4 control-label"><b>Photo</b></label>
                    <input id="photo" type="file" class="form-control" required name="photo" placeholder="" autofocus>
                    @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-md-6 border-left">
                <div class="form-group">
                    <label class="col-md-4 control-label"><b>Address Maps</b></label>
                    <textarea name="address_google" required class="form-control" onclick="mapsnyaWe()" readonly  rows="2"></textarea>
                    @error('address_google') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <input type="hidden" name="latitude" placeholder="latitude ..." class="form-control form-control-user" readonly value="{{@$address->latitude}}">
                     
                <input type="hidden" name="longitude" placeholder="longitude..." class="form-control form-control-user" readonly value="{{@$address->longitude}}">
                <div class="form-group">
                    <label for="email" class="col-md-4 control-label"><b>E-Mail</b></label>
                    <input id="email" type="text" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" autofocus>
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                            
                <div class="form-group">
                    <label for="password" required class="col-md-4 control-label"><b>Password</b></label>
                    <input id="password" type="password" class="form-control" name="password" placeholder="Password" autofocus>
                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                            
                <div class="form-group">
                    <label for="password-confirm"  class="col-md-6 control-label"><b>Confirm Password</b></label>
                    <input id="password-confirm" required type="password" class="form-control" name="password_confirmation" placeholder="confirm password">
                    @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group" align="left">
                    <p>To create an account you have to agree our <a class="btn-link" href="#">Terms & Privacy</a>.</p> 
                </div>

				<div class="col-md-12">
					<div class="submit-button text-center">
						<button class="btn btn-regis" id="submit" type="submit">Daftar</button>
						<div id="msgSubmit" class="h3 text-center hidden"></div>
						<div class="clearfix"></div>
					</div>
				</div>
            </div>
        </form>
    </div>
</div>


<br><br><br><br>
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
