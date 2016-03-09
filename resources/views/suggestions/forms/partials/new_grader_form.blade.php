<div class="col-md-12 form-group">
    <strong>Email:</strong> <span class="lead">{{ $grader_email }}</span>
</div>

{{ Form::hidden('unique_string', $unique_string) }}

<div class="col-md-12 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    {{ Form::label('password', 'Επιθυμητός Κωδικός Πρόσβασης') }}
    {{ Form::password('password', ['class' => 'form-control', 'id' => 'password']) }}

    @if ($errors->has('password'))
        <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
    @endif
</div>

<div class="col-md-12 form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
    {{ Form::label('password_confirmation', 'Επιβεβαίωση Κωδικού Πρόσβασης') }}
    {{ Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'password_confirmation']) }}

    @if ($errors->has('password_confirmation'))
        <span class="help-block">
            <strong>{{ $errors->first('password_confirmation') }}</strong>
        </span>
    @endif
</div>

<div class="col-md-12 form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
    {{ Form::label('last_name', 'Επώνυμο') }}
    {{ Form::text('last_name', null, ['class' => 'form-control', 'id' => 'last_name']) }}

    @if ($errors->has('last_name'))
        <span class="help-block">
            <strong>{{ $errors->first('last_name') }}</strong>
        </span>
    @endif
</div>

<div class="col-md-12 form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
    {{ Form::label('first_name', 'Όνομα') }}
    {{ Form::text('first_name', null, ['class' => 'form-control', 'id' => 'first_name']) }}

    @if ($errors->has('first_name'))
        <span class="help-block">
            <strong>{{ $errors->first('first_name') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    <div class="col-md-12">
        {{ Form::button('Αποθήκευση', ['type' => 'submit', 'class' => 'btn btn-primary btn-block btn-lg']) }}
    </div>
</div>
