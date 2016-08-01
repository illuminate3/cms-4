@extends('layouts.authenticated')

@section('main')
    <div class="features all padded">
        <div class="card">
            <div class="card-header default">Plan Features</div>
            <div class="card-block">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Active</th>
                            <th>Created</th>
                            <th>Updated</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($features->all() as $feature)
                            <tr>
                                <td>{{ $feature->id }}</td>
                                <td><a href="{{ route('features.edit', [
                                    'id' => $feature->id
                                ]) }}">{{ $feature->name }}</a></td>
                                <td>{{ $feature->active }}</td>
                                <td>{{ $feature->created_at->diffForHumans() }}</td>
                                <td>{{ $feature->updated_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection