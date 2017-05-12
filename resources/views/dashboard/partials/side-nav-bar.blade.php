<div class="col-md-12 mobile-panel">
       
    <div class="panel-body">
         <div class="panel-body" style="margin-top: ; margin-left: 5%;">
            <a class="text-uppercase" href="{{ route('index') }}">Home</a>
        </div>
        @can ( 'operator-user', Auth::user()->role_id )
        <div class="panel-body" style="margin-top:; margin-left: 5%;">
            <a class="text-uppercase" href="{{ route('getPatient') }}">Patient Test Form</a>
        </div>
        <div class="panel-body" style="margin-top:; margin-left: 5%;">
            <a class="text-uppercase" href="{{ route('getReportForm') }}">Report Form</a>
        </div>
        @endcan
        <div class="panel-body" style="margin-top:; margin-left: 5%;">
            <a class="text-uppercase" href="{{ route('getPatients') }}">View Patients</a>
        </div>
        <div class="panel-body" style="margin-top:; margin-left: 5%;">
            <a class="text-uppercase" href="{{ route('getReports') }}">View Reports</a>
        </div>
    </div>
</div>
