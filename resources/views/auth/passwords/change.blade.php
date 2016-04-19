@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Αλαγή Κωδικού Πρόσβασης</h4></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/change-password') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Τρέχων Κωδικός Πρόσβασης</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="current_password" required>

                                @if ($errors->has('current_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Νέος Κωδικός Πρόσβασης</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="new_password" required>

                                @if ($errors->has('new_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('new_password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Επιβεβαίωση Νέου Κωδικού Πρόσβασης</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="new_password_confirmation" required>

                                @if ($errors->has('new_password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new_password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Αλλαγή Κωδικού Πρόσβασης
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
