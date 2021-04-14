@extends('layout.main')
@section('title', 'Register')

@section('content')
<br><br>
<div class="container" style="margin-top:20px">
    <br><br>
    <div class="heading-title text-center">
        <h3>Login Account</h3>
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

    <form action="{{url('pemulung/login')}}" method="post" class="form-horizontal">
        @csrf
        <div class="row mt-4">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="form-group has-error">
                    <label for="fullname" class="col-md-4 control-label"><b>Email</b></label>
                    <input id="fullname" type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="email" autofocus>
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                            
                <div class="form-group">
                    <label for="username" class="col-md-4 control-label"><b>Password</b></label>
                    <input id="username" type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" autofocus>
                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                        

				<div class="col-md-12">
					<div class="submit-button text-center">
						<button class="btn btn-regis" id="submit" type="submit">Login</button>
						<div id="msgSubmit" class="h3 text-center hidden"></div>
						<div class="clearfix"></div>
					</div>
				</div>
            </div>
            <div class="col-md-3"></div>
        </form>
    </div>
</div>


<br><br><br><br>
@endsection
