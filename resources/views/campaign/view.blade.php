@extends('layouts.authenticated')

@section('main')
    <campaign-component
        script="{{ $script }}"
    ></campaign-component>
@endsection