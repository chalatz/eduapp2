<div class="col-md-12 form-group">
    <strong>Email:</strong> <span class="lead text-primary">{{ $grader_email }}</span>
</div>

{{ Form::hidden('unique_string', $unique_string) }}

<div class="col-md-12 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    {{ Form::label('password', 'Επιθυμητός Κωδικός Πρόσβασης *') }}
    {{ Form::password('password', ['class' => 'form-control', 'id' => 'password', 'required', 'minlength' => 6, 'data-parsley-minlength' => 6]) }}

    @if ($errors->has('password'))
        <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
    @endif
</div>

<div class="col-md-12 form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
    {{ Form::label('password_confirmation', 'Επιβεβαίωση Κωδικού Πρόσβασης *') }}
    {{ Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'password_confirmation', 'required', 'data-parsley-equalto' => '#password']) }}

    @if ($errors->has('password_confirmation'))
        <span class="help-block">
            <strong>{{ $errors->first('password_confirmation') }}</strong>
        </span>
    @endif
</div>

@include('graders.forms.partials.graders_form')

<div class="form-group">
    <div class="col-md-12">
        {{ Form::button('Αποθήκευση', ['type' => 'submit', 'class' => 'btn btn-primary btn-block btn-lg']) }}
    </div>
</div>
