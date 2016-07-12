@extends('layouts.authenticated')

@section('main')
    <edit-promo-component
        id="{{ $id }}"
    ></edit-promo-component>
@endsection