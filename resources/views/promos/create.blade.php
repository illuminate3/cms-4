@extends('layouts.authenticated')

@section('main')
    <div class="promo create padded">
        <div class="card">
            <div class="card-header default">Create Promo</div>
            <div class="card-block">
                <form action="{{ route('promos.create.post') }}" method="POST">
                    {{ csrf_field() }}

                    <div class="form-group row">
                        <label class="col-sm-3 text-xs-right">Name</label>
                        <div class="col-sm-7">
                            <input type="text" name="name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 text-xs-right">Body</label>
                        <div class="col-sm-7">
                            <textarea name="body" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 text-xs-right">Campaign</label>
                        <div class="col-sm-7">
                            <select name="campaign" class="form-control c-select">
                                @foreach ($campaigns->all() as $campaign)
                                    <option value="{{ $campaign->id }}">{{ $campaign->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 text-xs-right">Active</label>
                        <div class="col-sm-7">
                            <select name="active" class="form-control c-select">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-7 col-sm-offset-3">
                            <button class="btn btn-default">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection