<div class="col-md-12 form-group">
    <div class="col-md-7">
        {{ Form::label(null, 'Ξένες γλώσσες που γνωρίζω') }}
    </div>
        <div class="col-md-5 text-center">
        {{ Form::label(null, 'Επιθυμώ να αξιολογήσω Ιστότοπους σε αυτήν την γλώσσα') }}
    </div>
</div>

<div class="col-md-12">
    <div class="col-md-3 form-group{{ $errors->has('english') ? ' has-error' : '' }}">
        <div class="checkbox">
            <label>
                {{ Form::checkbox('english', 1, isset($grader) ? $grader->english : null, ['id' => 'english']) }}
                Αγγλικά
            </label>
        </div>

        @if ($errors->has('english'))
            <span class="help-block">
                <strong>{{ $errors->first('english') }}</strong>
            </span>
        @endif
    </div>

    <div class="col-md-4 form-group{{ $errors->has('english_level') ? ' has-error' : '' }}">

        {{ Form::select('english_level', $lang_levels::all(), isset($grader) ? $grader->english_level : null, ['class' => 'form-control', 'id' => 'english_level']) }}

        @if ($errors->has('english_level'))
            <span class="help-block">
                <strong>{{ $errors->first('english_level') }}</strong>
            </span>
        @endif
    </div>

    <div class="col-md-5 text-center form-group{{ $errors->has('lang_pref_english') ? ' has-error' : '' }}">
        {{ Form::checkbox('lang_pref_english', 1, isset($grader) ? $grader->lang_pref_english : null, ['id' => 'lang_pref_english']) }}

        @if ($errors->has('lang_pref_english'))
            <span class="help-block">
                <strong>{{ $errors->first('lang_pref_english') }}</strong>
            </span>
        @endif

    </div>
</div>

<div class="col-md-12">
    <div class="col-md-3 form-group{{ $errors->has('french') ? ' has-error' : '' }}">
        <div class="checkbox">
            <label>
                {{ Form::checkbox('french', 1, isset($grader) ? $grader->french : 0, ['id' => 'french']) }}
                Γαλλικά
            </label>
        </div>

        @if ($errors->has('french'))
            <span class="help-block">
                <strong>{{ $errors->first('french') }}</strong>
            </span>
        @endif
    </div>

    <div class="col-md-4 form-group{{ $errors->has('french_level') ? ' has-error' : '' }}">

        {{ Form::select('french_level', $lang_levels::all(), isset($grader) ? $grader->french_level : null, ['class' => 'form-control', 'id' => 'french_level']) }}

        @if ($errors->has('french_level'))
            <span class="help-block">
                <strong>{{ $errors->first('french_level') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="col-md-12">
    <div class="col-md-3 form-group{{ $errors->has('german') ? ' has-error' : '' }}">
        <div class="checkbox">
            <label>
                {{ Form::checkbox('german', 1, isset($grader) ? $grader->german : 0, ['id' => 'german']) }}
                Γερμανικά
            </label>
        </div>

        @if ($errors->has('german'))
            <span class="help-block">
                <strong>{{ $errors->first('german') }}</strong>
            </span>
        @endif
    </div>

    <div class="col-md-4 form-group{{ $errors->has('german_level') ? ' has-error' : '' }}">

        {{ Form::select('german_level', $lang_levels::all(), isset($grader) ? $grader->german_level : null, ['class' => 'form-control', 'id' => 'german_level']) }}

        @if ($errors->has('german_level'))
            <span class="help-block">
                <strong>{{ $errors->first('german_level') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="col-md-12">
    <div class="col-md-3 form-group{{ $errors->has('italian') ? ' has-error' : '' }}">
        <div class="checkbox">
            <label>
                {{ Form::checkbox('italian', 1, isset($grader) ? $grader->italian : 0, ['id' => 'italian']) }}
                Ιταλικά
            </label>
        </div>

        @if ($errors->has('italian'))
            <span class="help-block">
                <strong>{{ $errors->first('italian') }}</strong>
            </span>
        @endif
    </div>

    <div class="col-md-4 form-group{{ $errors->has('italian_level') ? ' has-error' : '' }}">

        {{ Form::select('italian_level', $lang_levels::all(), isset($grader) ? $grader->italian_level : null, ['class' => 'form-control', 'id' => 'italian_level']) }}

        @if ($errors->has('italian_level'))
            <span class="help-block">
                <strong>{{ $errors->first('italian_level') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="col-md-12 form-group{{ $errors->has('languages_other') ? ' has-error' : '' }}">
    {{ Form::label('languages_other', 'Άλλες Ξένες Γλώσσες') }}
    {{ Form::text('languages_other', isset($grader) ? $grader->languages_other : null, ['class' => 'form-control', 'id' => 'languages_other']) }}

    @if ($errors->has('languages_other'))
        <span class="help-block">
            <strong>{{ $errors->first('languages_other') }}</strong>
        </span>
    @endif
</div>

<div class="col-md-12 form-group{{ $errors->has('languages_other_level') ? ' has-error' : '' }}">
    {{ Form::label('languages_other_level', 'Επίπεδο Άλλων Ξένων Γλωσσών') }}
    {{ Form::text('languages_other_level', isset($grader) ? $grader->languages_other_level : null, ['class' => 'form-control', 'id' => 'languages_other_level']) }}

    @if ($errors->has('languages_other_level'))
        <span class="help-block">
            <strong>{{ $errors->first('languages_other_level') }}</strong>
        </span>
    @endif
</div>
