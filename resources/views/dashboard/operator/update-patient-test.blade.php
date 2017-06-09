@extends('layout.master')
@section('title', 'Login your account')
@section('content')
<div class="row">
    @include('dashboard.partials.top-nav-bar')
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 card" style="margin-top: 2%; background-color: #E0E0E0;">
            <h3>Edit Patient</h3>
            <hr>
            <form class="form" role="form" action="/patient/{{ $patient->id }}/update" method="POST" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $patient->name }}">
                    @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                    <label for="phone_number">patient Phone Number</label>
                    <input type="phone_number" class="form-control" name="phone_number" value="{{ $patient->phone_number }}">
                    @if ($errors->has('phone_number'))
                    <span class="help-block">
                        <strong>{{ $errors->first('phone_number') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">patient Email</label>
                    <input type="email" class="form-control" name="email" value="{{ $patient->email }}">
                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('date_of_birth') ? ' has-error' : '' }}">
                    <label for="date_of_birth">patient DOB</label>
                    <input type="date" class="form-control" name="date_of_birth" value="{{ $patient->date_of_birth }}">
                    @if ($errors->has('date_of_birth'))
                    <span class="help-block">
                        <strong>{{ $errors->first('date_of_birth') }}</strong>
                    </span>
                    @endif
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" style="background-color: #8899a6 ! important; border: none;">
                    <i class="fa fa-btn fa-user"></i> Update patient
                    </button>
                </div>
            </form>
            
            
        </div>
    </div>
</div>
@endsection