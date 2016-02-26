@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Στοιχεία Υποψηφιότητας</h4></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('sites.store') }}">
                        @inject('categories', 'App\Http\Utilities\Category')

                        {!! csrf_field() !!}

                        <div class="col-md-12 form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                            <label for="url">Διεύθυνση URL</label>

                            <input type="url" class="form-control" id="url" name="url" value="{{ old('url') }}">

                            @if ($errors->has('url'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('url') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-12 form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title">Ονομασία</label>

                            <input type="title" class="form-control" id="title" name="title" value="{{ old('title') }}">

                            @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-12 form-group{{ $errors->has('cat_id') ? ' has-error' : '' }}">
                            <label for="cat_id">Κατηγορία</label>

                            <select class="form-control" id="cat_id" name="cat_id" value="{{ old('cat_id') }}">
                                <option value="" selected="selected">Επιλέξτε Κατηγορία...</option>
                                @foreach($categories::all() as $name => $cat_id)
                                    <option value="{{ $cat_id }}">{{ $name }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('cat_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cat_id') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block btn-lg">
                                    Αποθήκευση
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
