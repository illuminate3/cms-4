@extends('layouts.authenticated')

@section('main')
    <div class="feature create padded">
        <div class="card">
            <div class="card-header">New Plan Feature</div>
            <div class="card-block">
                <create-feature-component></create-feature-component>
            </div>
        </div>
    </div>
@endsection