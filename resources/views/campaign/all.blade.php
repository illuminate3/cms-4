@extends('layouts.authenticated')

@section('main')
    <div class="campaigns all padded">
        <div class="card">
            <div class="card-header">Your campaigns</div>
            <div class="card-block">
                @if ($campaigns->count() > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Script</th>
                                    <th>Rebuttals</th>
                                    <th>Promos</th>
                                    <th>Active</th>
                                    <th>Timestamp</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($campaigns as $campaign)
                                    <tr>
                                        <td><a href="{{ route('campaigns.view', [
                                            'id' => $campaign->id
                                        ]) }}">{{ $campaign->name }}</a></td>
                                        <td>{{ $campaign->script }}</td>
                                        <td>{{ $campaign->rebuttals()->count() }}</td>
                                        <td>{{ $campaign->promos()->count() }}</td>
                                        <td>{{ $campaign->active }}</td>
                                        <td>{{ $campaign->created_at->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    You haven't created any campaigns yet, create one <a href="{{ route('campaigns.create') }}">here</a>.
                @endif
            </div>
        </div>
    </div>
@endsection