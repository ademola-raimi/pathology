<header class="clearfix" style="background-color: #fff;">
    <!-- Start  Logo & Naviagtion  -->
    <div class="navbar navbar-default navbar-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand text-default" style="margin-top: 1px;" href="/admin">Pathology Admin Page</a>
            </div>
            
            <div class="nav navbar-nav navbar-right">
                @if (! Auth::check())
                    <a class="" href="{{ route('getLogin') }}">Sign In</a>
                    <a type="button" class="page-scroll btn btn-primary" href="{{ route('getSignup') }}">Sign Up</a>
                
                @else 
                <div class="dropdown" style="margin-top: 1%;">
                    <a class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false"> {{ ucwords(Auth::user()->username) }} <img src="{{ Auth::user()->avatar }}" class="img-circle" height="35" width="35" style="border-radius:25px;" />
                        
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2" style="margin-left: 20%;">
                        <li>
                            <a class="dropdown-item" href="">
                                <i class="fa fa-btn fa-user"></i> {{ ucwords(Auth::user()->last_name) }}'s profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="">
                                <i class="fa fa-unlock-alt" aria-hidden="true"></i> Change Password
                            </a>
                        </li>
                        <li role="separator" class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/admin"> <i class="fa fa-btn fa-dashboard" style="margin: 0 0.5em 0 0;"></i>Dashboard</a></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}" > <i class="fa fa-btn fa-power-off" style="margin: 0 0.5em 0 0;"></i>Logout</a></li>
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </div>
</header>
