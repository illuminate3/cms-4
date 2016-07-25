@extends('layouts.authenticated')

@section('main')
    <create-promo-component
        campaigns="{{ $campaigns }}"
    ></create-promo-component>
@endsection