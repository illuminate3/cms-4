@extends('layouts.authenticated')

@section('main')
    <div class="campaigns all padded">
        <div class="card">
            <div class="card-header default">Your sections</div>
            <div class="card-block">
                @if ($sections->count() > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Created</th>
                                    <th>Updated</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sections as $section)
                                    <tr>
                                        <td>{{ $section->id }}</td>
                                        <td><a href="{{ route('sections.edit', [
                                            'id' => $section->id
                                        ]) }}">{{ $section->name }}</a></td>
                                        <td>{{ $section->created_at->diffForHumans() }}</td>
                                        <td>{{ $section->updated_at->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $sections->render() !!}
                    </div>
                @else
                    You haven't created any sections yet, create one <a href="{{ route('sections.create') }}">here</a>.
                @endif
            </div>
        </div>
    </div>
@endsection