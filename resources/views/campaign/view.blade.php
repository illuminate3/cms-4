@extends('layouts.authenticated')

@section('main')
    <campaign-component
        id="{{ $id }}"
    ></campaign-component>
@endsection