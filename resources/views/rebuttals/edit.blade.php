@extends('layouts.authenticated')

@section('main')
    <edit-rebuttal-component
        id="{{ $id }}"
    ></edit-rebuttal-component>
@endsection