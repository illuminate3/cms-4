@extends('layouts.app')

@section('content')
    <dashboard-component
        name="{{ Auth::user()->name }}"
    ></dashboard-component>
@endsection