@extends('layouts.authenticated')

@section('main')
    <div class="campaigns all padded">
        <div class="card">
            <div class="card-header">Your rebuttals</div>
            <div class="card-block">
                @if ($rebuttals->count() > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Campaign</th>
                                    <th>Active</th>
                                    <th>Timestamp</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rebuttals as $rebuttal)
                                    <tr>
                                        <td><a href="{{ route('rebuttals.edit', [
                                            'id' => $rebuttal->id
                                        ]) }}">{{ $rebuttal->name }}</a></td>
                                        <td>{{ $rebuttal->campaign()->first()->name }}</td>
                                        <td>{{ $rebuttal->active }}</td>
                                        <td>{{ $rebuttal->created_at->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {!! $rebuttals->render() !!}
                @else
                    You haven't created any rebuttals yet, create one <a href="{{ route('rebuttals.create') }}">here</a>.
                @endif
            </div>
        </div>
    </div>
@endsection