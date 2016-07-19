@extends('layouts.authenticated')

@section('main')
    <div class="section edit padded">
        <div class="card">
            <div class="card-header">Edit Section</div>
            <div class="card-block">
                <edit-section-component
                    id="{{ $id }}"
                    terms="{{ json_encode($terms) }}"
                ></edit-section-component>
            </div>
        </div>
        <div class="card">
            <div class="card-header">Terms using this section</div>
            <div class="card-block">
                @if ($terms->count() > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Active</th>
                                    <th>Updated</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($terms->all() as $term)
                                    <tr>
                                        <td><a href="{{ route('terms.edit', [
                                            'id' => $term->id
                                        ]) }}">{{ $term->name }}</a></td>
                                        <td>{{ $term->type }}</td>
                                        <td>{{ $term->active }}</td>
                                        <td>{{ $term->updated_at->diffForHumans() }}</td>
                                        <td>{{ $term->created_at->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    This section isn't in use by any terms and conditions.
                @endif
            </div>
        </div>
    </div>
@endsection