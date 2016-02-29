@extends('layouts.app')

@section('content')

@inject('categories', 'App\Http\Utilities\Category')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Στοιχεία Υποψηφιότητας</h4></div>
                <div class="panel-body">

                  {!! Form::open(['route' => 'sites.store', 'class' => 'form-horizontal', 'role' => 'form']) !!}

                    <div class="col-md-12 form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                        {{ Form::label('url', 'Διεύθυνση URL') }}
                        {{ Form::url('url', null, ['class' => 'form-control', 'id' => 'url']) }}

                        @if ($errors->has('url'))
                            <span class="help-block">
                                <strong>{{ $errors->first('url') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-md-12 form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        {{ Form::label('title', 'Ονομασία') }}
                        {{ Form::text('title', null, ['class' => 'form-control', 'id' => 'title']) }}

                        @if ($errors->has('url'))
                            <span class="help-block">
                                <strong>{{ $errors->first('url') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-md-12 form-group{{ $errors->has('cat_id') ? ' has-error' : '' }}">
                        {{ Form::label('cat_id', 'Κατηγορία') }}
                        {{ Form::select('cat_id', $categories::all(), null, ['class' => 'form-control', 'id' => 'cat_id']) }}

                        @if ($errors->has('cat_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('cat_id') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            {{ Form::button('Αποθήκευση', ['type' => 'submit', 'class' => 'btn btn-primary btn-block btn-lg']) }}
                        </div>
                    </div>

                  {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
