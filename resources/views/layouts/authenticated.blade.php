@extends('layouts.app')

@section('content')
    <div class="container-fluid dashboard">
        <div class="row">
            <div class="col-md-2">
                <div class="sidebar" id="sidebar">
                    <div class="header">
                        <img src="{{ asset('images/flaticons/man.png') }}">
                    </div>
                    <div class="links">
                        <ul>
                            <li><a href="{{ route('dashboard') }}" class="active">Dashboard</a></li>
                            <li><a href="">Account</a></li>
                            <li><a href="{{ route('logout') }}">Leave</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-10 no-padding">
                <nav class="navbar">
                    <button class="navbar-toggler hidden-sm-up" data-toggle="collapse" data-target="#allowToggle">
                        &#9776;
                    </button>
                    <div class="collapse navbar-toggleable-xs" id="allowToggle">
                        <ul class="nav navbar-nav">
                            <li class="nav-item bordered-right">
                                <a href="" class="nav-link"><i class="fa fa-user" style="margin-right: 10px"></i>{{ Auth::user()->name }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">Leave</a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div>
                    @yield('main')
                </div>
            </div>
        </div>
    </div>
@endsection