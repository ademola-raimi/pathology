@extends('layout.master')
@section('title', 'Welcome to Pathology')
@section('content')
    <div class="container-fluid" style="background-color: #E0E0E0;">
        
            <div class="background-image">
                <div class="overlay">
                    <div class="container">
                        <div class="row">
                            <div class="intro-text">
                                @if (! Auth::check())
                                    <h3>Find a medical expert to run medical test for you - One click away</h3>
                                    <p>Have you recently been tested? <br> Click Patient Log in to view your report</p>
                                    <a href="{{ route('getSignup') }}" class="page-scroll btn btn-primary mobile-btn-hov" style="background-color: #3B5998; width: 20%; border: none;">
                                        <i class="fa fa-user-plus"></i> Staff Sign Up
                                    </a>

                                    <a href="{{ route('getLogin') }}" class="page-scroll btn btn-primary mobile-btn-hov" style="background-color: #3B5998; width: 20%; border: none;">
                                        <i class="fa fa-sign-in"></i> Staff Sign In
                                    </a>

                                    <a href="{{ route('getPatientLogin') }}" class="page-scroll btn btn-primary mobile-btn-hov" style="background-color: #3B5998; width: 20%; border: none;">
                                        <i class="fa fa-sign-in"></i> Patient Log In
                                    </a>
                                @else
                                    <h3>Welcome {{ Auth::user()->first_name }}</h3>
                                    <p> You will need to be given an admin access to see your dashboard </p>
                                    <a href="{{ route('getAdminPage') }}" class="page-scroll btn btn-primary mobile-btn-hov" style="background-color: #3B5998; width: 20%; border: none;">
                                        <i class="fa fa-tachometer"></i> Dashboard
                                    </a>
                                    <a href="{{ route('logout') }}" class="page-scroll btn btn-primary mobile-btn-hov" style="background-color: #3B5998; width: 20%; border: none;">
                                        <i class="fa fa-sign-out"></i> Logout
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="row">   
                            
                        </div>
                    </div>
                </div>
            </div>
       
    </div>
@endsection
