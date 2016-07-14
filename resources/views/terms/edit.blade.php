@extends('layouts.authenticated')

@section('main')
    <edit-terms-component
        id="{{ $id }}"
    ></edit-terms-component>
@endsection