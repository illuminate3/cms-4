@extends('layouts.app')

@section('content')
    <div class="container-fluid dashboard">
        <div class="row">
            <div class="col-md-2">
                <sidebar-component name="{{ Auth::user()->name }}"></sidebar-component>
            </div>
            <div class="col-md-10 no-padding">
                <nav class="navbar">
                    <button class="navbar-toggler hidden-sm-up" data-toggle="collapse" data-target="#allowToggle">
                        &#9776;
                    </button>
                    <div class="collapse navbar-toggleable-xs" id="allowToggle">
                        <ul class="nav navbar-nav">
                            <li class="nav-item navbar-identity">
                                <a href="" class="nav-link"><i class="fa fa-user"></i>{{ Auth::user()->name }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('logout') }}" class="nav-link">Leave</a>
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