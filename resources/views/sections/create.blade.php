@extends('layouts.authenticated')

@section('main')
    <div class="section new padded">
        <div class="card">
            <div class="card-header">New Section</div>
            <div class="card-block">
                <create-section-component></create-section-component>
            </div>
        </div>
    </div>
@endsection