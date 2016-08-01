@extends('layouts.authenticated')

@section('main')
    <div class="users create padded">
        <div class="card primary">
            <div class="card-header">Create user</div>
            <div class="card-block">
                <create-users-component></create-users-component>
            </div>
        </div>
    </div>
@endsection