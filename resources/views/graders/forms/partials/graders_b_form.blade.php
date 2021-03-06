<div class="col-md-12 form-group{{ $errors->has('propose_myself') ? ' has-error' : '' }}">
    {{ Form::checkbox('propose_myself', 1, isset($grader) ? $grader->propose_myself : null, ['id' => 'propose_myself']) }}
    <label for="propose_myself">
         Αυτοπροτείνομαι ως Αξιολογητής Β
     </label>

    @if ($errors->has('propose_myself'))
        <span class="help-block">
            <strong>{{ $errors->first('propose_myself') }}</strong>
        </span>
    @endif
</div>

<div id="why_propose_myself_wrapper" class="col-md-12 form-group{{ $errors->has('why_propose_myself') ? ' has-error' : '' }}">
    {{ Form::label('why_propose_myself', 'Εξηγήστε τους λόγους για τους οποίους προτείνετε τον εαυτό σας ως Αξιολογητή Β') }}
    {{ Form::textarea('why_propose_myself', null, ['class' => 'form-control', 'id' => 'why_propose_myself', 'rows' => 5]) }}

    @if ($errors->has('why_propose_myself'))
        <span class="help-block">
            <strong>{{ $errors->first('why_propose_myself') }}</strong>
        </span>
    @endif
</div>

<div class="col-md-12 form-group{{ $errors->has('personal_xp') ? ' has-error' : '' }}">
    {{ Form::label('personal_xp', 'Εμπειρία Δημιουργίας - Αξιολόγησης Ιστότοπων *') }}
    {{ Form::textarea('personal_xp', null, ['class' => 'form-control', 'id' => 'personal_xp', 'rows' => 5, 'required']) }}

    @if ($errors->has('personal_xp'))
        <span class="help-block">
            <strong>{{ $errors->first('personal_xp') }}</strong>
        </span>
    @endif
</div>

<div class="col-md-12 form-group{{ $errors->has('comments') ? ' has-error' : '' }}">
    {{ Form::label('comments', 'Παρατηρήσεις, Σχόλια') }}
    {{ Form::textarea('comments', null, ['class' => 'form-control', 'id' => 'comments', 'rows' => 5]) }}

    @if ($errors->has('comments'))
        <span class="help-block">
            <strong>{{ $errors->first('comments') }}</strong>
        </span>
    @endif
</div>
