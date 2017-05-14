@extends('layout.master')
@section('title', 'Login your account')
@section('content')
@include('dashboard.partials.top-nav-bar')
<div class="container-fluid" style="">
		<div class="container">
            <div class="col-md-6 col-md-offset-3 card" style="margin-top: 3%; margin-bottom: 3%; background-color: #E0E0E0;">
                <h3 style="margin-top: 3%; margin-bottom: 3%;">Patient's Report Form </a></h3>
                <form class="form" role="form" method="POST" action="{{ route('postReport') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description">Description of test</label>
                        <input type="text" class="form-control" name="description" value="{{ old('name') }}">
                        @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('statement') ? ' has-error' : '' }}">
                        <label for="statement">Your Statement</label>
                        <input type="statement" class="form-control" name="statement" value="{{ old('statement') }}">
                        @if ($errors->has('statement'))
                        <span class="help-block">
                            <strong>{{ $errors->first('statement') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('patient_id') ? ' has-error' : '' }}">
                    <fieldset>
                        <legend>Select name of patient</legend>
                        
                        <label for="patient_id"> Patient name</label>
                        
                        <select class = "form-control" name="patient_id">
                            <option value="" > patient name</option>
                            @foreach($patients as $patient)
                            
                            <option value="{{ $patient->id }}">
                                {{ $patient->name }}
                            </option>
                            @endforeach
                        </select>
                        
                    </fieldset>
                    @if ($errors->has('patient_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('patient_id') }}</strong>
                    </span>
                    @endif
                </div>





                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                        <i class="fa fa-btn fa-user"></i> Add Report
                        </button>
                    </div>
                </form>
            </div>
		</div>
</div>
@endsection
