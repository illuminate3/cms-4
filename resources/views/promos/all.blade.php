@extends('layouts.authenticated')

@section('main')
    <div class="campaigns all padded">
        <div class="card">
            <div class="card-header">Your promotions</div>
            <div class="card-block">
                @if ($promos->count() > 0)
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
                                @foreach ($promos as $promo)
                                    <tr>
                                        <td><a href="{{ route('promos.edit', [
                                            'id' => $promo->id
                                        ]) }}">{{ $promo->name }}</a></td>
                                        <td>{{ $promo->campaign()->first()->name }}</td>
                                        <td>{{ $promo->active }}</td>
                                        <td>{{ $promo->created_at->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {!! $promos->render() !!}
                @else
                    You haven't created any promos yet, create one <a href="{{ route('promos.create') }}">here</a>.
                @endif
            </div>
        </div>
    </div>
@endsection