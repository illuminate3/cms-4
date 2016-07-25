@extends('layouts.authenticated')

@section('main')
    <edit-rebuttal-component
        id="{{ $id }}"
        campaigns="{{ $campaigns }}"
    ></edit-rebuttal-component>
@endsection