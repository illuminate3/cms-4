@extends('layouts.app')

@section('content')
    <div class="container-fluid dashboard">
        <div class="row">
            <div class="col-md-2">
                <div class="sidebar">
                    <div class="header">
                        <img src="http://indonesian-experience.nl/wp-content/uploads/2015/02/puzzle-head.jpg">
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
                <a class="toggleSlideout" onclick="toggleSlideout()">
                    <i class="fa fa-bars"></i>
                </a>
                <div>
                    @yield('main')
                </div>
            </div>
        </div>
    </div>
@endsection