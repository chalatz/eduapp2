@extends('layouts.app')

<!-- Main Content -->
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Αλλαγή Κωδικού Πρόσβασης</h4></div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Διεύθυνση E-Mail</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-envelope"></i> Αποστολή Συνδέσμου
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <blockquote>
                <p class="text-muted lead" style="font-style: oblique">
                    Όταν δώσετε το email σας και πατήσετε Αποστολή Συνδέσμου, θα αποσταλούν στο email σας οδηγίες για να αλλάξετε τον Κωδικό Πρόσβασής σας.
                </p>
            </blockquote>
        </div>
    </div>
</div>
@endsection
