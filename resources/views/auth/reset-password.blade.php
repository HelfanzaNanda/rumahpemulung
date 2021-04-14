@extends('layout.main')
@section('title', 'Reset Password')

@section('content')
<br><br>
<div class="container" style="margin-top:20px">
    <br><br>
    <div class="heading-title text-center">
        <h3>Reset Password</h3>
    </div>

    <form action="{{ route('client.password.update') }}" method="post" class="form-horizontal">
        @csrf
        <div class="row mt-4">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="form-group has-error">
                    <label for="fullname" class="col-md-4 control-label"><b>Email</b></label>
                    <input type="text" class="form-control" name="email" 
                    value="{{ $email }}" disabled>
                </div>
                            
                <div class="form-group">
                    <label for="username" class="col-md-4 control-label"><b>Password</b></label>
                    <input id="username" type="password" class="form-control" name="password"  
                    placeholder="Password" required autofocus>
                </div>
                        

				<div class="col-md-12">
					<div class="submit-button text-center">
						<button class="btn btn-regis" id="submit" type="submit"
                        >Reset Password</button>
					</div>
				</div>
            </div>
            <div class="col-md-3"></div>
        </form>
    </div>
</div>


<br><br><br><br>
@endsection
