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