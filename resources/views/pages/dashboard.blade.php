@extends('layouts.authenticated')

@section('main')
    <dashboard-component
        name="{{ Auth::user()->name }}"
    ></dashboard-component>
@endsection