@extends('layouts.authenticated')

@section('main')
    <div class="feature edit padded">
        <div class="card primary">
            <div class="card-header">Edit Plan Feature</div>
            <div class="card-block">
                <edit-feature-component
                    id="{{ $id }}"
                ></edit-feature-component>
            </div>
        </div>
    </div>
@endsection