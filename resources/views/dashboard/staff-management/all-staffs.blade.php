@extends('layout.master')
@section('title', 'Manage Staffs')
@section('content')
<div class="row" >
    @include('dashboard.partials.top-nav-bar')
</div>
<div class="container">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 ">
        <div class="table-responsive">
            <h4 class="text-center" style="margin-top: 30px;">Manage Staffs</h4>
            <table class="table table-condensed table-striped table-bordered table-hover cool-header">
                <thead>
                    <tr>
                        <th>S/n</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($staffs as $staff)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $staff->first_name . ' ' . $staff->last_name }} </td>
                        <td>{{ $staff->email }}</td>
                        <td> <a href="/staff/{{ $staff->id }}/edit">Edit</a> </td>
                        <td><a data-id="{{ $staff->id }}" class="delete-staff" href="#" title="Delete {{ $staff->name }}">Delete</a> </td>
                @endforeach

            </table>
        </div>
    </div>
</div>
@endsection