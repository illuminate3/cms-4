@extends('layouts.authenticated')

@section('main')
    <div class="campaigns all padded">
        <div class="card primary">
            <div class="card-header">Your terms and conditions</div>
            <div class="card-block">
                @if ($terms->count() > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Active</th>
                                    <th>Pattern</th>
                                    <th>Timestamp</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($terms as $t)
                                    <tr>
                                        <td><a href="{{ route('terms.edit', [
                                            'id' => $t->id
                                        ]) }}">{{ $t->name }}</a></td>
                                        <td>{{ $t->type }}</td>
                                        <td>{{ $t->active }}</td>
                                        <td>{{ $t->pattern }}</td>
                                        <td>{{ $t->created_at->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    You haven't created any terms yet, create one <a href="{{ route('terms.create') }}">here</a>.
                @endif
            </div>
        </div>
    </div>
@endsection