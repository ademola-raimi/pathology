@extends('layout.master')
@section('title', 'Welcome to Pathology')
@section('content')
<div class="container">
    
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 ">
        <div class="table-responsive">
        <div style="margin-top: 10px; margin-bottom: 20px;">
            <a class="btn btn-default" href="/patient/report/{{ $report->id }}/download" style="margin-top: 20px;">Export report as PDF</a>
            <a class="btn btn-default" href="/patient/report/{{ $report->id }}/mail" style="margin-top: 20px;">Mail report as PDF</a>
            <a class="btn btn-default" href="{{ route('index') }}" style="margin-top: 20px;">Return Home</a>
        </div>
            <h3 style="text-align: center;">Report Details</h3>
            <table class="table table-condensed table-striped table-bordered table-hover cool-header">
                <thead>
                    <tr>
                        <th style="width:40%">Test Items</th>
                        <th>Test Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>Patient's name</td><td>{{ ucwords($patient->name) }}</td></tr>
                    <tr><td>Operator's name</td><td>{{ ucwords($user->last_name.' ' . $user->first_name) }}</td></tr>
                    <tr><td>Operator's Email</td><td>{{ $user->email }}</td></tr>
                    <tr><td>Case number</td><td>{{ $patient->case_number }}</td></tr>
                    <tr><td>Date Of Birth</td><td>{{ $patient->date_of_birth }}</td></tr>
                    <tr><td>Report Details</td><td>{{ $report->description }}</td></tr>
                    <tr><td>Report Statement</td><td>{{ $report->statement }}</td></tr>
                    <tr><td>Test Date</td><td>{{ $report->created_at->format('d-m-Y') }}</td></tr>
                    <tr><td>Last Updated</td><td>{{ $report->updated_at->format('d-m-Y') }}</td></tr>
            </table>
        </div>
    </div>
</div>
@endsection