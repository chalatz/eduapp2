<div class="col-md-12 form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
    {{ Form::label('last_name', 'Επώνυμο *') }}
    {{ Form::text('last_name', isset($grader) ? $grader->last_name : null, ['class' => 'form-control', 'id' => 'last_name', 'required']) }}

    @if ($errors->has('last_name'))
        <span class="help-block">
            <strong>{{ $errors->first('last_name') }}</strong>
        </span>
    @endif
</div>

<div class="col-md-12 form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
    {{ Form::label('first_name', 'Όνομα *') }}
    {{ Form::text('first_name', isset($grader) ? $grader->first_name : null, ['class' => 'form-control', 'id' => 'first_name', 'required']) }}

    @if ($errors->has('first_name'))
        <span class="help-block">
            <strong>{{ $errors->first('first_name') }}</strong>
        </span>
    @endif
</div>

<div class="col-md-12 form-group{{ $errors->has('specialty_id') ? ' has-error' : '' }}">
    {{ Form::label('specialty_id', 'Εδικότητα *') }}
    {{ Form::select('specialty_id', $specialties::all(), isset($grader) ? $grader->specialty_id : null, ['class' => 'form-control', 'id' => 'specialty_id']) }}

    @if ($errors->has('specialty_id'))
        <span class="help-block">
            <strong>{{ $errors->first('specialty_id') }}</strong>
        </span>
    @endif
</div>

<div class="col-md-12 form-group{{ $errors->has('district_id') ? ' has-error' : '' }}">
    {{ Form::label('district_id', 'Περιφέρεια *') }}
    {{ Form::select('district_id', $districts::all(), isset($grader) ? $grader->district_id : null, ['class' => 'form-control', 'id' => 'district_id']) }}

    @if ($errors->has('district_id'))
        <span class="help-block">
            <strong>{{ $errors->first('district_id') }}</strong>
        </span>
    @endif
</div>

<div class="col-md-12 form-group{{ $errors->has('address') ? ' has-error' : '' }}">
    {{ Form::label('address', 'Ταχ. Διεύθυνση') }}
    {{ Form::text('address', isset($grader) ? $grader->address : null, ['class' => 'form-control', 'id' => 'address']) }}

    @if ($errors->has('address'))
        <span class="help-block">
            <strong>{{ $errors->first('address') }}</strong>
        </span>
    @endif
</div>

<div class="col-md-12 form-group{{ $errors->has('desired_category') ? ' has-error' : '' }}">
    {{ Form::label('desired_category', 'Θα προτιμούσα να είμαι αξιολογητής στην παρακάτω κατηγορία:') }}

    @foreach($categories::all() as $cat_id => $category)
        @if($cat_id != '')
            <div class="checkbox">
                <label>
                    {{ Form::checkbox('desired_category['. $cat_id .']', $cat_id, (isset($grader) && in_array($cat_id ,explode('|', $grader->desired_category))) ? 1 : 0) }}
                    {{ $category }}
                </label>
            </div>
        @endif
    @endforeach

    <span class="help-block"><strong>Επιλέξτε όσες κατηγορίες επιθυμείτε</strong></span>
    <span class="help-block">** Υποστηρικτικές δομές εκπαίδευσης: ΚΕΠΛΗΝΕΤ, ΕΚΦΕ, ΣΣΝ, ΚΠΕ, ΚΕΣΥΠ, ΚΕΔΔΥ, Γραφεία Σχολικών Δραστηριοτήτων, Αγωγής Υγείας, Περιβαλλοντικής Εκπαίδευσης, Πολιτιστικών θεμάτων, ομάδων Φυσικής Αγωγής της Δ/νσης Β/θμιας Εκπ/σης.</span>

    @if ($errors->has('desired_category'))
        <span class="help-block">
            <strong>{{ $errors->first('desired_category') }}</strong>
        </span>
    @endif
</div>

<div class="col-md-12 form-group{{ $errors->has('past_grader') ? ' has-error' : '' }}">
    {{ Form::label('past_grader', 'Ήμουν αξιολογητής Α στον προηγούμενο διαγωνισμό;') }}

    {{ Form::select('past_grader', ['' => 'Επιλέξτε...', 'yes' => 'Ναι', 'no' => 'Όχι',], isset($grader) ? $grader->past_grader : null, ['class' => 'form-control', 'id' => 'past_grader']) }}

    @if ($errors->has('past_grader'))
        <span class="help-block">
            <strong>{{ $errors->first('past_grader') }}</strong>
        </span>
    @endif
</div>

<div class="col-md-12 form-group{{ $errors->has('past_grader_more') ? ' has-error' : '' }}">
    {{ Form::label('past_grader_more', 'Ήμουν αξιολογητής σε περισσότερους από έναν διαγωνισμούς Ιστοτόπων;') }}

    {{ Form::select('past_grader_more', ['' => 'Επιλέξτε...', 'yes' => 'Ναι', 'no' => 'Όχι',], isset($grader) ? $grader->past_grader_more : null, ['class' => 'form-control', 'id' => 'past_grader_more']) }}

    @if ($errors->has('past_grader_more'))
        <span class="help-block">
            <strong>{{ $errors->first('past_grader_more') }}</strong>
        </span>
    @endif
</div>

<div class="col-md-12 form-group{{ $errors->has('wants_to_be_grader_b') ? ' has-error' : '' }}">
    {{ Form::label('wants_to_be_grader_b', 'Θα ήθελα να συμμετάσχω και ως Αξιολογητής Β') }}

    {{ Form::select('wants_to_be_grader_b', ['' => 'Επιλέξτε...', 'yes' => 'Ναι', 'no' => 'Όχι',], isset($grader) ? $grader->wants_to_be_grader_b : null, ['class' => 'form-control', 'id' => 'wants_to_be_grader_b']) }}

    @if ($errors->has('wants_to_be_grader_b'))
        <span class="help-block">
            <strong>{{ $errors->first('wants_to_be_grader_b') }}</strong>
        </span>
    @endif
</div>

@include('graders.forms.partials.languages')

<div class="col-md-12 form-group{{ $errors->has('personal_cv_path') ? ' has-error' : '' }}">
    {{ Form::label('personal_cv_path', 'Υποβολή Βιογραφικού') }}

    {{ Form::file('personal_cv') }}

    @if ($errors->has('personal_cv_path'))
        <span class="help-block">
            <strong>{{ $errors->first('personal_cv_path') }}</strong>
        </span>
    @endif
</div>
