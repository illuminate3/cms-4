@extends('layouts.authenticated')

@section('main')
    <div class="terms create padded">
        <div class="card">
            <div class="card-header">New Terms and Conditions</div>
            <div class="card-block">
                <create-terms-component></create-terms-component>
            </div>
        </div>
    </div>
@endsection