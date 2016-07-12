@extends('layouts.app')

@section('content')
    <div class="container-fluid dashboard">
        <div class="row">
            <div class="col-md-2">
                <div class="sidebar">
                    <div class="header">
                        <img src="http://indonesian-experience.nl/wp-content/uploads/2015/02/puzzle-head.jpg">
                        <h6>{{ Auth::user()->name }}</h6>
                    </div>
                    <div class="links">
                        <ul>
                            <li><a href="/dashboard" class="active"><i class="fa fa-home"></i>dashboard</a></li>
                            <li><a href=""><i class="fa fa-user"></i>account</a></li>
                            <li><a href="/logout"><i class="fa fa-sign-out"></i>leave</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-10 no-padding">
                <div class="navbar">
                    <div class="pull-xs-left">
                        <ul>
                            <li id="toggleSidebar"><a><i class="fa fa-bars"></i></a></li>
                            <li>Your Dashboard</li>
                        </ul>
                    </div>
                    <div class="pull-xs-right">
                        <ul>
                            <li><a href=""><i class="fa fa-bell"></i></a></li>
                            <li><a href=""><i class="fa fa-user"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div>
                    @yield('main')
                </div>
            </div>
        </div>
    </div>
@endsection