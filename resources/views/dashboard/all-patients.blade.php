@extends('layout.master')
@section('title', 'Welcome to Pathology')
@section('content')
<div class="row" >
    @include('dashboard.partials.top-nav-bar')
  </div>
<div class="container">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 ">
        <div class="table-responsive">
            <h4 class="text-center" style="margin-top: 30px; background-color: #E0E0E0;">All Patients</h4>
            <table class="table table-condensed table-striped table-bordered table-hover cool-header">
                <thead>
                    <tr>
                        <th style="width:40%">Tag</th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($patients as $patient)
                        <tr><td>Patient number {{ $patient->id }} </td><td>{{ $patient->name}}</td> @can ( 'operator-user', Auth::user()->role_id )<td><a href="/patient/{{ $patient->id }}/edit">Edit</a></td> <td><a href="/patient/{{ $patient->id }}/delete">Delete</a></td>@endcan @can ( 'lab-user', Auth::user()->role_id )<td><a href="/patient/{{ $patient->id }}/sms">Send SMS</a></td>@endcan </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>
        <div class="button-details">
                    {!! $patients->render() !!}
                </div>
    </div>
</div>
@endsection