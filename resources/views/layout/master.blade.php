<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <meta name="Pathology" content="Test just got easy" />
        <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
        <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
        <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
        <link rel="stylesheet" href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}">
    	<link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
    	<link rel="stylesheet" href="{{ asset('sweetalert/sweetalert.css') }}">
    </head>
    <body>
    	@yield('content')
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="http://code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
        <script src="{{ asset('bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('sweetalert/sweetalert.min.js') }}"></script>
        @include('sweet::alert')
        <script src="{{ asset('js/script.js') }}"></script>
        <script src="{{ asset('js/autocomplete.js') }}"></script>
        <script src="{{ asset('js/staff.js') }}"></script>
    </body>
</html>
