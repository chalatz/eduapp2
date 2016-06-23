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
    {{ Form::textarea('why_propose_myself', null, ['class' => 'form-control', 'id' => 'why_propose_myself', 'rows' => 5, 'required' ]) }}

    @if ($errors->has('why_propose_myself'))
        <span class="help-block">
            <strong>{{ $errors->first('why_propose_myself') }}</strong>
        </span>
    @endif
</div>

<div class="col-md-12 form-group{{ $errors->has('personal_url') ? ' has-error' : '' }}">
    {{ Form::label('personal_url', 'URL Προσωπικού Ιστότοπου') }}
    {{ Form::text('personal_url', null, ['class' => 'form-control', 'id' => 'personal_url']) }}

    @if ($errors->has('personal_url'))
        <span class="help-block">
            <strong>{{ $errors->first('personal_url') }}</strong>
        </span>
    @endif

    <span class="help-block">
        Δηλώστε έναν χαρακτηριστικό τίτλο για τη συμμετοχή σας (π.χ. 2ο Δημοτικό Σχολείο Σύρου)
    </span>
</div>

<div class="col-md-12 form-group{{ $errors->has('personal_cv') ? ' has-error' : '' }}">
    {{ Form::label('personal_cv', 'Υποβολή Βιογραφικού') }}

    @if($grader->personal_cv)
        <p>
            <a class="lead" href="{{ route('graders.get_cv', $grader->personal_cv) }}">
                Βιογραφικό που υποβλήθηκε
            </a>
        </p>
    @endif

    {{ Form::file('personal_cv') }}

    @if ($errors->has('personal_cv'))
        <span class="help-block">
            <strong>{{ $errors->first('personal_cv') }}</strong>
        </span>
    @endif

    <span class="help-block">
        Επιτρεπόμενες επεκτάσεις αρχείων: <strong>pdf,doc,docx,odt</strong>
    </span>
</div>

<div class="col-md-12 form-group{{ $errors->has('personal_xp') ? ' has-error' : '' }}">
    {{ Form::label('personal_xp', 'Εμπειρία Δημιουργίας - Αξιολόγησης Ιστότοπων') }}
    {{ Form::textarea('personal_xp', null, ['class' => 'form-control', 'id' => 'personal_xp', 'rows' => 5, 'required' ]) }}

    @if ($errors->has('personal_xp'))
        <span class="help-block">
            <strong>{{ $errors->first('personal_xp') }}</strong>
        </span>
    @endif
</div>

<div class="col-md-12 form-group{{ $errors->has('comments') ? ' has-error' : '' }}">
    {{ Form::label('comments', 'Παρατηρήσεις, Σχόλια') }}
    {{ Form::textarea('comments', null, ['class' => 'form-control', 'id' => 'comments', 'rows' => 5, 'required' ]) }}

    @if ($errors->has('comments'))
        <span class="help-block">
            <strong>{{ $errors->first('comments') }}</strong>
        </span>
    @endif
</div>
