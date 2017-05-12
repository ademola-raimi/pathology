@extends('layout.master')
@section('title', 'Login your account')
@section('content')
<div class="container-fluid" style="">
	
		<div class="container">
			<div class="col-md-6 col-md-offset-3 card" style="margin-top: 3%; margin-bottom: 3%; background-color: #E0E0E0;">
				<h3 style="margin-top: 3%; margin-bottom: 3%;">Log In, or <a href="{{ route('getSignup') }}">Sign Up</a> or return <a href="{{ route('index') }}">Home</a></h3>
				<form role="form" method="POST" action="{{ route('postLogin') }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
						<label for="email">Email</label>
						<input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
						@if ($errors->has('email'))
						<span class="help-block">
							<strong>{{ $errors->first('email') }}</strong>
						</span>
						@endif
					</div>
					<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
						<label for="password">Password</label>
						<input type="password" class="form-control" id="password" name="password">
						@if ($errors->has('password'))
						<span class="help-block">
							<strong>{{ $errors->first('password') }}</strong>
						</span>
						@endif
					</div>
					<div class="checkbox pull-right">
						<label style="margin-left: -2%;"><input id="remember" name="remember" type="checkbox">Remember me</label>
					</div>
					<div class="form-group">
					<button type="submit" class="btn btn btn-primary">Log In</button>
					</div>
				</form>
			</div>
			
		</div>
</div>
@endsection