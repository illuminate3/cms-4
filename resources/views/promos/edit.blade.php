@extends('layouts.authenticated')

@section('main')
    <edit-promo-component
        id="{{ $id }}"
        campaigns="{{ $campaigns }}"
    ></edit-promo-component>
@endsection