@extends('layouts.authenticated')

@section('main')
    <div class="rebuttal padded">
        <div class="card">
            <div class="card-header default">Edit Rebuttal</div>
            <div class="card-block">
                <form action="" method="POST">
                    <div class="form-group row">
                        <label class="col-sm-3 text-xs-right">Name</label>
                        <div class="col-sm-7">
                            <input type="text" name="name" class="form-control" value="{{ $rebuttal->name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 text-xs-right">Body</label>
                        <div class="col-sm-7">
                            <textarea name="body" class="form-control">{{ $rebuttal->body }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 text-xs-right">Active</label>
                        <div class="col-sm-7">
                            <select name="active" class="c-select form-control">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 text-xs-right">Campaign</label>
                        <div class="col-sm-7">
                            <select name="campaign" class="c-select form-control">
                                <option value="{{ $rebuttal->campaign()->first()->id }}">{{ $rebuttal->campaign()->first()->name }}</option>

                                @foreach ($campaigns->all() as $campaign)
                                    @if ($campaign->id != $rebuttal->campaign()->first()->id)
                                        <option value="{{ $campaign->id }}">{{ $campaign->name }}</option>
                                    @endif
                                @endforeach
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
        <div class="card">
            <div class="card-header danger">Danger Zone</div>
            <div class="card-block">
                <button class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
@endsection