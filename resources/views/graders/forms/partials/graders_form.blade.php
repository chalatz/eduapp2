<div class="col-md-12 form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
    {{ Form::label('last_name', 'Επώνυμο') }}
    {{ Form::text('last_name', isset($grader) ? $grader->last_name : null, ['class' => 'form-control', 'id' => 'last_name', 'required']) }}

    @if ($errors->has('last_name'))
        <span class="help-block">
            <strong>{{ $errors->first('last_name') }}</strong>
        </span>
    @endif
</div>

<div class="col-md-12 form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
    {{ Form::label('first_name', 'Όνομα') }}
    {{ Form::text('first_name', isset($grader) ? $grader->first_name : null, ['class' => 'form-control', 'id' => 'first_name', 'required']) }}

    @if ($errors->has('first_name'))
        <span class="help-block">
            <strong>{{ $errors->first('first_name') }}</strong>
        </span>
    @endif
</div>
