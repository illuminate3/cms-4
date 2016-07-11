@extends('layouts.authenticated')

@section('main')
    <campaign-component
        campaign="{{ $campaign }}"
    ></campaign-component>
@endsection