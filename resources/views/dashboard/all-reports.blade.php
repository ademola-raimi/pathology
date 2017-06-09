@extends('layout.master')
@section('title', 'Welcome to Pathology')
@section('content')
<div class="row" >
    @include('dashboard.partials.top-nav-bar')
</div>
<div class="container">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 ">
        <div class="table-responsive">
            <h4 class="text-center" style="margin-top: 30px;">All Reports</h4>
            <table class="table table-condensed table-striped table-bordered table-hover cool-header">
                <thead>
                    <tr>
                        <th style="width:40%">Tag</th>
                        <th>Description</th>
                        <th>Patient's Name</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($reports as $report)
                    <tr>
                        <td> Report number {{ $report->id }} </td>
                        <td>{{ $report->description}} </td>
                        <td>{{ $report->patient->name }}</td>
                        @can ( 'operator-user', Auth::user()->role_id ) 
                            <td> <a href="/report/{{ $report->id }}/edit">Edit</a> </td>
                            <td><a href="/report/{{ $report->id }}/delete">Delete</a> </td>
                        @endcan</tr>
                @endforeach

            </table>
        </div>
    </div>
</div>
@endsection