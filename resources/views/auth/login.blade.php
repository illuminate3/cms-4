@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4 col-sm-push-4">
                <div class="auth">
                    <div class="header">
                        <img src="{{ asset('images/flaticons/briefcase.png') }}">
                        <h4>Login Here</h4>
                    </div>
                    <login-component></login-component>
                    <a href="" class="blocked text-xs-center">Forgot Your Password?</a>
                </div>
            </div>
        </div>
    </div>

@endsection