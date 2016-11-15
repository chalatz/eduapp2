@if(Auth::check())
    <h4>email: <span style="text-decoration: underline">{{ Auth::user()->email }}<span></h4>
@endif

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
    {{ Form::select('specialty_id', $specialties::all(), isset($grader) ? $grader->specialty_id : null, ['class' => 'form-control', 'id' => 'specialty_id', 'required']) }}

    @if ($errors->has('specialty_id'))
        <span class="help-block">
            <strong>{{ $errors->first('specialty_id') }}</strong>
        </span>
    @endif
</div>

<div class="col-md-12 form-group{{ $errors->has('district_id') ? ' has-error' : '' }}">
    {{ Form::label('district_id', 'Περιφερειακή Διεύθυνση Εκπαίδευσης στην οποία ανήκω το τρέχον σχολικό έτος *') }}
    {{ Form::select('district_id', $districts::all(), isset($grader) ? $grader->district_id : null, ['class' => 'form-control', 'id' => 'district_id', 'required']) }}

    @if ($errors->has('district_id'))
        <span class="help-block">
            <strong>{{ $errors->first('district_id') }}</strong>
        </span>
    @endif
</div>

<div class="col-md-12 form-group{{ $errors->has('county_id') ? ' has-error' : '' }}">
    {{ Form::label('county_id', 'Περιφερειακή Ενότητα (πρώην Νομός) *') }}
    {{ Form::select('county_id', $counties::all(), isset($grader) ? $grader->county_id : null, ['class' => 'form-control', 'id' => 'county_id', 'required']) }}

    @if ($errors->has('county_id'))
        <span class="help-block">
            <strong>{{ $errors->first('county_id') }}</strong>
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
    {{ Form::label('desired_category', 'Θα προτιμούσα να είμαι αξιολογητής στις παρακάτω κατηγορίες:') }}

    <span class="help-block"><strong>Επιλέξτε όσες περισσότερες κατηγορίες επιθυμείτε</strong></span>

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

    <span class="help-block">** Υποστηρικτικές δομές εκπαίδευσης: ΚΕΠΛΗΝΕΤ, ΕΚΦΕ, ΣΣΝ, ΚΠΕ, ΚΕΣΥΠ, ΚΕΔΔΥ, Γραφεία Σχολικών Δραστηριοτήτων, Αγωγής Υγείας, Περιβαλλοντικής Εκπαίδευσης, Πολιτιστικών θεμάτων, ομάδων Φυσικής Αγωγής της Δ/νσης Β/θμιας Εκπ/σης.</span>

    @if ($errors->has('desired_category'))
        <span class="help-block">
            <strong>{{ $errors->first('desired_category') }}</strong>
        </span>
    @endif
</div>

<div class="col-md-12 form-group{{ $errors->has('past_grader') ? ' has-error' : '' }}">
    {{ Form::label('past_grader', 'Ήμουν αξιολογητής Α στον προηγούμενο διαγωνισμό; *') }}

    {{ Form::select('past_grader', ['' => 'Επιλέξτε...', 'yes' => 'Ναι', 'no' => 'Όχι',], isset($grader) ? $grader->past_grader : null, ['class' => 'form-control', 'id' => 'past_grader', 'required']) }}

    @if ($errors->has('past_grader'))
        <span class="help-block">
            <strong>{{ $errors->first('past_grader') }}</strong>
        </span>
    @endif
</div>

<div class="col-md-12 form-group{{ $errors->has('past_grader_more') ? ' has-error' : '' }}">
    {{ Form::label('past_grader_more', 'Ήμουν αξιολογητής σε περισσότερους από έναν διαγωνισμούς Ιστοτόπων; *') }}

    {{ Form::select('past_grader_more', ['' => 'Επιλέξτε...', 'yes' => 'Ναι', 'no' => 'Όχι',], isset($grader) ? $grader->past_grader_more : null, ['class' => 'form-control', 'id' => 'past_grader_more', 'required']) }}

    @if ($errors->has('past_grader_more'))
        <span class="help-block">
            <strong>{{ $errors->first('past_grader_more') }}</strong>
        </span>
    @endif
</div>

@if(\Request::route()->getName() == 'graders.create'|| \Request::route()->getName() == 'graders.edit')
    <div class="col-md-12 form-group{{ $errors->has('wants_to_be_grader_b') ? ' has-error' : '' }}">
       <label for="wants_to_be_grader_b">Θα ήθελα να συμμετάσχω <u>ΚΑΙ</u> ως Αξιολογητής Β</label>

        {{ Form::select('wants_to_be_grader_b', ['' => 'Επιλέξτε...', 'yes' => 'Ναι', 'no' => 'Όχι',], isset($grader) ? $grader->wants_to_be_grader_b : null, ['class' => 'form-control', 'id' => 'wants_to_be_grader_b']) }}

        @if ($errors->has('wants_to_be_grader_b'))
            <span class="help-block">
                <strong>{{ $errors->first('wants_to_be_grader_b') }}</strong>
            </span>
        @endif
    </div>
@endif

@include('graders.forms.partials.languages')

<div class="col-md-12 form-group{{ $errors->has('photo') ? ' has-error' : '' }}">

    @if(isset($grader) && $grader->photo)

        <p><strong>Η φωτογραφία μου</strong></p>
    
        <p>
            <img src="{{ route('graders.get_file', $grader->photo) }}" width="200"></img>
        </p>

        <div class="has-error" style="margin: .5em 0; font-size: 1.1em">
            <div class="checkbox">
            <label>
                {{ Form::checkbox('delete_photo', 'delete_me') }}
                <strong>Διαγραφή φωτογραφίας</strong>
            </label>
            </div>
        </div>
    @endif

    {{ Form::label('photo', 'Υποβολή Φωτογραφίας') }}

    {{ Form::file('photo') }}

    @if ($errors->has('photo'))
        <span class="help-block">
            <strong>{{ $errors->first('photo') }}</strong>
        </span>
    @endif

    <span class="help-block">
        Επιτρεπόμενες επεκτάσεις αρχείων: <strong>jpg,jpeg,png</strong><br>
        Μέγιστο μέγεθος αρχείου: <strong>2MB</strong>
    </span>
</div>

<div class="col-md-12 form-group }}">
    {{ Form::label('URL Ιστότοπων που έχω δημιουργήσει ή συντηρώ') }}

    <div class="form-group">
        <label for="personal_url" class="col-sm-1 control-label">1.</label>
        <div class="col-sm-11">
            {{ Form::url('personal_url', null, ['class' => 'form-control', 'id' => 'personal_url']) }}
        </div>
    </div>
    <div class="form-group">
        <label for="personal_url_2" class="col-sm-1 control-label">2.</label>
        <div class="col-sm-11">
            {{ Form::url('personal_url_2', null, ['class' => 'form-control', 'id' => 'personal_url_2']) }}
        </div>
    </div>
    <div class="form-group">
        <label for="personal_url_3" class="col-sm-1 control-label">3.</label>
        <div class="col-sm-11">
            {{ Form::url('personal_url_3', null, ['class' => 'form-control', 'id' => 'personal_url_3']) }}
        </div>
    </div>
    <div class="form-group">
        <label for="personal_url_4" class="col-sm-1 control-label">4.</label>
        <div class="col-sm-11">
            {{ Form::url('personal_url_4', null, ['class' => 'form-control', 'id' => 'personal_url_4']) }}
        </div>
    </div>             

</div>

<div class="col-md-12 form-group{{ $errors->has('teaching_xp') ? ' has-error' : '' }}">
    {{ Form::label('teaching_xp', 'Έχω εμπειρία ως διδάσκων ή υπάλληλος σε:') }}

    @foreach($teaching_xp::all() as $xp_id => $xp_item)
        @if($xp_id != '')
            <div class="checkbox">
                <label>
                    {{ Form::checkbox('teaching_xp['. $xp_id .']', $xp_id, (isset($grader) && in_array($xp_id ,explode('|', $grader->teaching_xp))) ? 1 : 0) }}
                    {{ $xp_item }}
                </label>
            </div>
        @endif
    @endforeach

    @if ($errors->has('teaching_xp'))
        <span class="help-block">
            <strong>{{ $errors->first('teaching_xp') }}</strong>
        </span>
    @endif
</div>

<div class="col-md-12 form-group{{ $errors->has('personal_cv') ? ' has-error' : '' }}">
    {{ Form::label('personal_cv', 'Υποβολή Βιογραφικού') }}

    @if(isset($grader) && $grader->personal_cv)
        <p>
            <a class="lead" href="{{ route('graders.get_file', $grader->personal_cv) }}">
                <i class="fa fa-file-text-o" aria-hidden="true"></i> Βιογραφικό που υποβλήθηκε
            </a>
        </p>

        <div class="has-error" style="margin: .5em 0; font-size: 1.1em">
            <div class="checkbox">
            <label>
                {{ Form::checkbox('delete_cv', 'delete_me') }}
                <strong>Διαγραφή Βιογραφικού</strong>
            </label>
            </div>
        </div>
    @endif

    {{ Form::file('personal_cv') }}

    @if ($errors->has('personal_cv'))
        <span class="help-block">
            <strong>{{ $errors->first('personal_cv') }}</strong>
        </span>
    @endif

    <span class="help-block">
        Επιτρεπόμενες επεκτάσεις αρχείων: <strong>pdf,doc,docx,odt</strong><br>
        Μέγιστο μέγεθος αρχείου: <strong>2MB</strong>
    </span>
</div>