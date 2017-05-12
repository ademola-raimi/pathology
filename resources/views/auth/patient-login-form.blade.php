@extends('layout.master')
@section('title', 'Login your account')
@section('content')
<div class="container-fluid" style="">
	
		<div class="container">
			<div class="col-md-6 col-md-offset-3 card" style="margin-top: 3%; margin-bottom: 3%; background-color: #E0E0E0;">
				<h3 style="margin-top: 3%; margin-bottom: 3%;">Check your report(s) by providing your name and pin or return <a href="{{ route('index') }}">Home</a></h3>
				<form role="form" method="POST" action="{{ route('postPatientLogin') }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group{{ $errors->has('patient_name') ? ' has-error' : '' }} autocomplete">
						<label for="patient_name">input your Name</label>
						<input type="patient_name" class="form-control" id="auto" name="patient_name" value="{{ old('patient_name') }}">
						@if ($errors->has('patient_name'))
						<span class="help-block">
							<strong>{{ $errors->first('patient_name') }}</strong>
						</span>
						@endif
					</div>
					<div class="form-group{{ $errors->has('patient_id') ? ' has-error' : '' }}">
						<label for="patient_id">Input your pin</label>
						<input type="patient_id" class="form-control" id="patient_id" name="patient_id">
						@if ($errors->has('patient_id'))
						<span class="help-block">
							<strong>{{ $errors->first('patient_id') }}</strong>
						</span>
						@endif
					</div>
					<div class="checkbox pull-right">
						<label style="margin-left: -2%;"><input id="remember" name="remember" type="checkbox">Remember me</label>
					</div>
					<div class="form-group">
					<button type="submit" class="btn btn btn-primary">Check</button>
					</div>
				</form>
			</div>
			
		</div>
</div>
@endsection