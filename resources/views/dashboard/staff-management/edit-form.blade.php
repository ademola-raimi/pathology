@extends('layout.master')
@section('title', 'Edit Staff')
@section('content')
<div class="row">
    @include('dashboard.partials.top-nav-bar')
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 card" style="margin-top: 2%; background-color: #E0E0E0;">
            <h3>Edit Staff</h3>
            <hr>
            <form class="form" role="form" action="/staff/{{ $staff->id }}/update" method="POST" >
                <div class="form-group{{ $errors->has('date_of_birth') ? ' has-error' : '' }}">
                    <img src="{{ $staff->avatar }}" style="width: 20%; height: auto;">
                </div>

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <label for="name">Role</label>
                    <select class="form-control" name="role" id="role">
                        <option value="">Select user Role...</option>
                        <option value="1" <?php if ($staff->role_id === 1) { ?> selected <?php } ?>  >
                            Ordinary Staff
                        </option>
                        <option value="2" <?php if ($staff->role_id === 2) { ?> selected <?php } ?>  >
                            Operator Staff
                        </option>
                        <option value="3" <?php if ($staff->role_id === 3) { ?> selected <?php } ?>  >
                            Admin Staff
                        </option>
                    </select>
                </div>

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $staff->first_name . ' ' . $staff->last_name }}">
                    @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ $staff->email }}">
                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" style="background-color: #8899a6 ! important; border: none;">
                    <i class="fa fa-btn fa-user"></i> Update Staff
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection