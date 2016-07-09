@extends('layouts.app')

@section('content')

    <div class="container-fluid dashboard">
        <div class="row">
            <div class="col-sm-2">
                <div class="sidebar">
                    <div class="header">
                        <img src="http://indonesian-experience.nl/wp-content/uploads/2015/02/puzzle-head.jpg">
                        <h6>{{ Auth::user()->name }}</h6>
                    </div>
                    <div class="links">
                        <ul>
                            <li><a href="" class="active"><i class="fa fa-home"></i>dashboard</a></li>
                            <li><a href=""><i class="fa fa-user"></i>account</a></li>
                            <li><a href=""><i class="fa fa-sign-out"></i>leave</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-10 no-padding">
                <div class="navbar">
                    <div class="pull-xs-left">
                        <ul>
                            <li><a href=""><i class="fa fa-bars"></i></a></li>
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
                <div class="profile">
                    <div class="user">
                        <img src="http://indonesian-experience.nl/wp-content/uploads/2015/02/puzzle-head.jpg">
                        <div class="name">
                            <h2>{{ Auth::user()->name }}</h2>
                            <p>Software Developer</p>
                        </div>
                    </div>
                    <div class="links">
                        <ul>
                            <li><a href="" class="active">Campaigns</a></li>
                            <li><a href="">Rebuttals</a></li>
                            <li><a href="">Promos</a></li>
                            <li><a href="">Scripts</a></li>
                            <li><a href="">Features</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection