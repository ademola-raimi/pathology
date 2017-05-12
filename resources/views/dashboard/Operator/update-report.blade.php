@extends('layout.master')
@section('title', 'Login your account')
@section('content')
<div class="row">
    @include('dashboard.partials.top-nav-bar')
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 card" style="margin-top: 2%; background-color: #E0E0E0;">
            <h3>Edit Report</h3>
            <hr>
            <form class="form" role="form" action="/report/{{ $report->id }}/update" method="POST" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" name="description" value="{{ $report->description }}">
                    @if ($errors->has('description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('statement') ? ' has-error' : '' }}">
                    <label for="statement">Statement</label>
                    <input type="statement" class="form-control" name="statement" value="{{ $report->statement }}">
                    @if ($errors->has('statement'))
                    <span class="help-block">
                        <strong>{{ $errors->first('statement') }}</strong>
                    </span>
                    @endif
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" style="background-color: #8899a6 ! important; border: none;">
                    <i class="fa fa-btn fa-user"></i> Update Report
                    </button>
                </div>
            </form>
            
            
        </div>
    </div>
</div>
@endsection