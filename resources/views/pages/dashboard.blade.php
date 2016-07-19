@extends('layouts.authenticated')

@section('main')
    <dashboard-component user="{{ Auth::user() }}"></dashboard-component>
@endsection