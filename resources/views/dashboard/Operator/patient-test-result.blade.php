@extends('layout.master')
@section('title', 'Login your account')
@section('content')
@include('dashboard.partials.top-nav-bar')
<div class="container-fluid" style="">
		<div class="container">
            <div class="col-md-6 col-md-offset-3 card" style="margin-top: 3%; margin-bottom: 3%; background-color: #E0E0E0;">
                <h3 style="margin-top: 3%; margin-bottom: 3%;">Patient's Test Form </a></h3>
                <form class="form" role="form" method="POST" action="{{ route('postPatient') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name">Patient Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email">Patient Email</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                        <label for="phone_number">Patient Phone Number</label>
                        <input type="number" class="form-control" name="phone_number" value="{{ old('phone_number') }}">
                        @if ($errors->has('phone_number'))
                        <span class="help-block">
                            <strong>{{ $errors->first('phone_number') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('date_of_birth') ? ' has-error' : '' }}">
                        <label for="date_of_birth">Patient's DOB</label>
                        <input type="date" class="form-control" name="date_of_birth" value="{{ old('date_of_birth') }}">
                        @if ($errors->has('date_of_birth'))
                        <span class="help-block">
                            <strong>{{ $errors->first('date_of_birth') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                        <i class="fa fa-btn fa-user"></i> Test
                        </button>
                    </div>
                </form>
            </div>
		</div>
</div>
@endsection
