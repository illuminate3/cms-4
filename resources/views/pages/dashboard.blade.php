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
    <div class="statistics padded">
        <div class="row">
            <div class="col-sm-3">
                <div class="statistic" style="background-color: #1abc9c">
                    <p class="s__m">
                        <span class="description">Total campaigns created</span>
                        <span class="number">{{ $campaigns->count() }}</span>
                    </p>
                    <span class="footer" style="background-color: #16a085">
                        View all campaigns <i class="fa fa-arrow-circle-right"></i>
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
                        View all promos <i class="fa fa-arrow-circle-right"></i>
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
                        View all rebuttals <i class="fa fa-arrow-circle-right"></i>
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
                        View all terms <i class="fa fa-arrow-circle-right"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection