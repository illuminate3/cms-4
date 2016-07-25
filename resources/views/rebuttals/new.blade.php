@extends('layouts.authenticated')

@section('main')
    <create-rebuttal-component
        campaigns="{{ $campaigns }}"
    ></create-rebuttal-component>
@endsection