@extends('layouts.authenticated')

@section('main')
    <div class="profile">
        <div class="user">
            <img src="/images/flaticons/man.png">
            <div class="name">
                <h2>{{ Auth::user()->name }}</h2>
                <p>{{ Auth::user()->biography }}</p>
            </div>
        </div>
    </div>
    <div class="padded">
        <div class="statistics">
            <div class="row">
                <div class="col-sm-3">
                    <div class="statistic" style="background-color: #1abc9c">
                        <p class="s__m">
                            <span class="description">Total campaigns created</span>
                            <span class="number">{{ $campaigns->count() }}</span>
                        </p>
                        <span class="footer" style="background-color: #16a085">
                            <a href="{{ route('campaigns.all') }}">View all campaigns <i class="fa fa-arrow-circle-right"></i></a>
                        </span>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="statistic" style="background-color: #3498db">
                        <p class="s__m">
                            <span class="description">Total promos added</span>
                            <span class="number">{{ $promos->count() }}</span>
                        </p>
                        <span class="footer" style="background-color: #2980b9">
                            <a href="{{ route('promos.index') }}">View all promos <i class="fa fa-arrow-circle-right"></i></a>
                        </span>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="statistic" style="background-color: #34495e">
                        <p class="s__m">
                            <span class="description">Total rebuttals added</span>
                            <span class="number">{{ $rebuttals->count() }}</span>
                        </p>
                        <span class="footer" style="background-color: #2c3e50">
                            <a href="{{ route('rebuttals.index') }}">View all rebuttals <i class="fa fa-arrow-circle-right"></i></a>
                        </span>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="statistic" style="background-color: #e67e22">
                        <p class="s__m">
                            <span class="description">Total terms created</span>
                            <span class="number">{{ $terms->count() }}</span>
                        </p>
                        <span class="footer" style="background-color: #d35400">
                            <a href="{{ route('terms.index') }}">View all terms <i class="fa fa-arrow-circle-right"></i></a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="campaigns card">
            <div class="card-header default">Your campaigns</div>
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
                                    <th>Created</th>
                                    <th>Last Update</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($campaigns as $campaign)
                                    <tr>
                                        <td><a href="{{ route('campaigns.view', [
                                            'id' => $campaign->script
                                        ]) }}">{{ $campaign->name }}</a></td>
                                        <td>{{ $campaign->script }}</td>
                                        <td>{{ $campaign->rebuttals()->count() }}</td>
                                        <td>{{ $campaign->promos()->count() }}</td>
                                        <td>{{ $campaign->created_at->diffForHumans() }}</td>
                                        <td>{{ $campaign->updated_at->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    You dont have any campaigns yet, create one <a href="{{ route('campaign.create') }}">here</a>.
                @endif
            </div>
        </div>
    </div>
@endsection