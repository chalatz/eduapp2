<div class="col-md-12 form-group{{ $errors->has('personal_xp') ? ' has-error' : '' }}">
    {{ Form::label('personal_xp', 'Εμπειρία Δημιουργίας - Αξιολόγησης Ιστότοπων') }}
    {{ Form::textarea('personal_xp', null, ['class' => 'form-control', 'id' => 'personal_xp', 'rows' => 5, 'required' ]) }}

    @if ($errors->has('personal_xp'))
        <span class="help-block">
            <strong>{{ $errors->first('personal_xp') }}</strong>
        </span>
    @endif
</div>
