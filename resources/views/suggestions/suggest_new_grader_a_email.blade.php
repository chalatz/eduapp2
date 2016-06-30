@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Email Νέου Αξιολογητή Α</h4></div>
                <div class="panel-body">

                  <p>
                      Email Αξιολογητή που έχετε προτείνει: <strong>{{ $suggestion->grader_email }}</strong>
                  </p>

                  {!! Form::open(['route' => ['do_other_grader_email', 'edit'], 'class' => 'form-horizontal', 'role' => 'form', 'data-parsley-validate']) !!}

                      <div class="col-md-12 form-group{{ $errors->has('grader_email') ? ' has-error' : '' }}">
                          {{ Form::label('grader_email', 'Το email του νέου Αξιολογητή που προτείνετε') }}
                          {{ Form::email('grader_email', null, ['class' => 'form-control', 'id' => 'grader_email', 'required']) }}

                          @if ($errors->has('grader_email'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('grader_email') }}</strong>
                              </span>
                          @endif
                      </div>

                      <div class="col-md-12 form-group{{ $errors->has('grader_email_confirmation') ? ' has-error' : '' }}">
                          {{ Form::label('grader_email_confirmation', 'Επιβεβαίωση email του Αξιολογητή που προτείνετε') }}
                          {{ Form::email('grader_email_confirmation', null, ['class' => 'form-control', 'id' => 'grader_email_confirmation', 'required', 'data-parsley-equalto' => '#grader_email']) }}

                          @if ($errors->has('grader_email_confirmation'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('grader_email_confirmation') }}</strong>
                              </span>
                          @endif
                      </div>

                      <div class="form-group">
                          <div class="col-md-12">
                              {{ Form::button('Συνέχεια <i class="fa fa-arrow-circle-right"></i>', ['type' => 'submit', 'class' => 'btn btn-primary btn-block btn-lg']) }}
                          </div>
                      </div>

                  {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
