@extends('layouts.authenticated')

@section('main')
    <div class="section edit padded">
        <div class="card">
            <div class="card-header">Edit Section</div>
            <div class="card-block">
                <edit-section-component id="{{ $id }}"></edit-section-component>
            </div>
        </div>
    </div>
@endsection