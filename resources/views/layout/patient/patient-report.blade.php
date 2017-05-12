@extends('layout.master')
@section('title', 'Welcome to Pathology')
@section('content')
<div class="container">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 ">
        <div class="table-responsive">
        <a class="btn btn-default" href="{{ route('index') }}" style="margin-top: 20px;">Return Home</a>
            <h4 class="text-center" style="margin-top: 30px; text-align: center;">Your report </h4>
            <table class="table table-condensed table-striped table-bordered table-hover cool-header">
                <thead>
                    <tr>
                        <th style="width:40%">Tag</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($reports as $report)
                    <tr><td>Case {{ $report->id }} </td><td><a href="/patient/report/{{ $report->id }}">{{ $report->description}}</a></td>  </tr>
                    
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection