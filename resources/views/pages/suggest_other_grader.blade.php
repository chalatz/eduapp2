@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Προτείνετε Αξιολογητή Α</h4></div>
                <div class="panel-body">

                    {!! Form::open(['route' => 'do_suggest_other_grader', 'class' => 'form-horizontal', 'role' => 'form', 'data-parsley-validate']) !!}

                        <div class="col-md-12 form-group">
                            <strong>Το email του Αξιολογητή που προτείνετε:</strong> <span class="lead">{{ $grader_email }}</span>
                        </div>

                        {{ Form::hidden('grader_email', $grader_email) }}

                        <div class="col-md-12 form-group{{ $errors->has('suggestor_name') ? ' has-error' : '' }}">
                              {{ Form::label('suggestor_name', 'Το Όνοματεπώνυμό σας') }}
                              {{ Form::text('suggestor_name', null, ['class' => 'form-control', 'id' => 'suggestor_name', 'required']) }}

                              @if ($errors->has('suggestor_name'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('suggestor_name') }}</strong>
                                  </span>
                              @endif
                          </div>

                        <div class="col-md-12 form-group{{ $errors->has('suggestor_url') ? ' has-error' : '' }}">
                              {{ Form::label('suggestor_url', 'Το URL του υποψήφιου Ιστότοπού σας') }}
                              {{ Form::url('suggestor_url', null, ['class' => 'form-control', 'id' => 'suggestor_url', 'required']) }}

                              @if ($errors->has('suggestor_url'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('suggestor_url') }}</strong>
                                  </span>
                              @endif
                          </div>

                        <div class="col-md-12 form-group{{ $errors->has('suggestor_phone') ? ' has-error' : '' }}">
                              {{ Form::label('suggestor_phone', 'Το Τηλέφωνό σας (προαιρετικά)') }}
                              {{ Form::text('suggestor_phone', null, ['class' => 'form-control', 'id' => 'suggestor_phone']) }}

                              @if ($errors->has('suggestor_phone'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('suggestor_phone') }}</strong>
                                  </span>
                              @endif
                          </div>                                              

                          <div class="col-md-12 form-group{{ $errors->has('personal_msg') ? ' has-error' : '' }}">
                              {{ Form::label('personal_msg', 'Προσωπικό μήνυμα προς τον Αξιολογητή') }}
                              {{ Form::textarea('personal_msg', null, ['rows' => '3', 'columns' => '50', 'class' => 'form-control', 'id' => 'personal_msg', 'required']) }}

                              @if ($errors->has('personal_msg'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('personal_msg') }}</strong>
                                  </span>
                              @endif
                          </div>

                          @if(isset($old_suggestion))
                              {{ Form::hidden('old_suggestion_id', $old_suggestion->id) }}
                              <div class="form-group">
                                  <div class="col-md-12">
                                      <div class="alert alert-danger" role="alert">
                                          <strong>Προσοχή!</strong> Η πρότασή σας στον Αξιολογητή με email <strong>{{ $old_suggestion->grader_email }}</strong> θα διαγραφεί και δε θα μπορεί πλέον να αποδεχθεί την πρότασή σας.
                                      </div>
                                  </div>
                              </div>
                          @endif

                          <div class="form-group">
                              <div class="col-md-12">
                                  {{ Form::button('Αποστολή email στον Αξιολογητή', ['type' => 'submit', 'class' => 'btn btn-primary btn-block btn-lg']) }}
                              </div>
                          </div>

                      {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
