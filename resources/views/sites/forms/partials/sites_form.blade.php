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

    @if ($errors->has('title'))
        <span class="help-block">
            <strong>{{ $errors->first('title') }}</strong>
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
