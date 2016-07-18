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
                            <li><a href="/dashboard" class="active">Dashboard</a></li>
                            <li><a href="">Account</a></li>
                            <li><a href="/logout">Leave</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-10 no-padding">
                <div>
                    @yield('main')
                </div>
            </div>
        </div>
    </div>
@endsection