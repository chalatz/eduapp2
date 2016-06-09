<div class="panel panel-success">
    <div class="panel-heading"><h4>Στοιχεία Υποψήφιου Ιστότοπου</h4></div>
    <div class="panel-body">

        <div class="col-md-12 form-group{{ $errors->has('url') ? ' has-error' : '' }}">
            {{ Form::label('url', 'URL Ιστοσελίδας *') }}
            {{ Form::url('url', null, ['class' => 'form-control', 'id' => 'url']) }}

            @if ($errors->has('url'))
                <span class="help-block">
                    <strong>{{ $errors->first('url') }}</strong>
                </span>
            @endif

            <span class="help-block">
                Θα πρέπει να ξεκινάει από http://
            </span>
        </div>

        <div class="col-md-12 form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            {{ Form::label('title', 'Επωνυμία Ιστότοπου *') }}
            {{ Form::text('title', null, ['class' => 'form-control', 'id' => 'title']) }}

            @if ($errors->has('title'))
                <span class="help-block">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif

            <span class="help-block">
                Δηλώστε έναν χαρακτηριστικό τίτλο για τη συμμετοχή σας (π.χ. 2ο Δημοτικό Σχολείο Σύρου)
            </span>
        </div>

        <div class="col-md-12 form-group{{ $errors->has('cat_id') ? ' has-error' : '' }}">
            {{ Form::label('cat_id', 'Κατηγορία *') }}
            {{ Form::select('cat_id', $categories::all(), null, ['class' => 'form-control', 'id' => 'cat_id']) }}

            @if ($errors->has('cat_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('cat_id') }}</strong>
                </span>
            @endif
            <span class="help-block">
                <strong>** Υποστηρικτικές δομές εκπαίδευσης: </strong>ΚΕΠΛΗΝΕΤ, ΕΚΦΕ, ΣΣΝ, ΚΠΕ, ΚΕΣΥΠ, ΚΕΔΔΥ, Γραφεία Σχολικών Δραστηριοτήτων, Αγωγής Υγείας, Περιβαλλοντικής Εκπαίδευσης, Πολιτιστικών θεμάτων, ομάδων Φυσικής Αγωγής της Δ/νσης Β/θμιας Εκπ/σης.
            </span>
        </div>

        <div class="col-md-12 form-group{{ $errors->has('creator') ? ' has-error' : '' }}">
            {{ Form::label('creator', 'Δημιουργός / Δημιουργοί / Συντηρητές *') }}
            {{ Form::text('creator', null, ['class' => 'form-control', 'id' => 'creator']) }}

            @if ($errors->has('creator'))
                <span class="help-block">
                    <strong>{{ $errors->first('creator') }}</strong>
                </span>
            @endif
            <span class="help-block">
                Δηλώστε όλους όσους έχουν συμβάλει στη δημιουργία - συντήρηση του Iστότοπου (Επώνυμο, Όνομα και Ειδικότητα)
            </span>
        </div>

        <div class="col-md-12 form-group{{ $errors->has('responsible') ? ' has-error' : '' }}">
            {{ Form::label('responsible', 'Νομικά υπεύθυνος *') }}
            {{ Form::text('responsible', null, ['class' => 'form-control', 'id' => 'responsible']) }}

            @if ($errors->has('responsible'))
                <span class="help-block">
                    <strong>{{ $errors->first('responsible') }}</strong>
                </span>
            @endif
        </div>

        <div class="col-md-12 form-group{{ $errors->has('responsible_type') ? ' has-error' : '' }}">
            {{ Form::label('responsible_type', 'Ιδιότητα νομικά υπεύθυνου *') }}
            {{ Form::text('responsible_type', null, ['class' => 'form-control', 'id' => 'responsible_type']) }}

            @if ($errors->has('responsible_type'))
                <span class="help-block">
                    <strong>{{ $errors->first('responsible_type') }}</strong>
                </span>
            @endif
            <span class="help-block">
                π.χ Διευθυντής, Προϊστάμενος, Εκπαιδευτικός, κλπ
            </span>
        </div>

        <div class="col-md-12 form-group{{ $errors->has('district_id') ? ' has-error' : '' }}">
            {{ Form::label('district_id', 'Περιφέρεια *') }}
            {{ Form::select('district_id', $districts::all(), null, ['class' => 'form-control', 'id' => 'district_id']) }}

            @if ($errors->has('district_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('district_id') }}</strong>
                </span>
            @endif
        </div>

        <div class="col-md-12 form-group{{ $errors->has('county_id') ? ' has-error' : '' }}">
            {{ Form::label('county_id', 'Περιφερειακή Ενότητα (πρώην Νομός)') }}
            {{ Form::select('county_id', $counties::all(), null, ['class' => 'form-control', 'id' => 'county_id']) }}

            @if ($errors->has('county_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('county_id') }}</strong>
                </span>
            @endif
        </div>

        <div class="col-md-12 form-group{{ $errors->has('country_id') ? ' has-error' : '' }}">
            {{ Form::label('country_id', 'Χώρα') }}
            {{ Form::select('country_id', $countries::all(), null, ['class' => 'form-control', 'id' => 'country_id']) }}

            @if ($errors->has('country_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('country_id') }}</strong>
                </span>
            @endif
        </div>

        <div class="col-md-12 form-group{{ $errors->has('language_id') ? ' has-error' : '' }}">
            {{ Form::label('language_id', 'Γλώσσα Ιστότοπου') }}
            {{ Form::select('language_id', $languages::all(), null, ['class' => 'form-control', 'id' => 'language_id']) }}

            @if ($errors->has('language_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('language_id') }}</strong>
                </span>
            @endif
        </div>

        <div class="col-md-12 form-group{{ $errors->has('uses_private_data') ? ' has-error' : '' }}">
            {{ Form::label('uses_private_data', 'Προβάλλει ο ιστότοπος προσωπικά δεδομένα παιδιών;') }}

            {{ Form::select('uses_private_data', ['' => 'Επιλέξτε...', 'yes' => 'Ναι', 'no' => 'Όχι',], null, ['class' => 'form-control', 'id' => 'uses_private_data']) }}

            @if ($errors->has('uses_private_data'))
                <span class="help-block">
                    <strong>{{ $errors->first('uses_private_data') }}</strong>
                </span>
            @endif
        </div>

        <div id="received_permission_wrapper" class="col-md-12 form-group{{ $errors->has('received_permission') ? ' has-error' : '' }}">
            {{ Form::label('received_permission', 'Εάν ναι, έχετε λάβει γραπτή άδεια για να εμφανίζονται προσωπικά δεδομένα των παιδιών;') }}

            {{ Form::select('received_permission', ['' => 'Επιλέξτε...', 'yes' => 'Ναι', 'no' => 'Όχι',], null, ['class' => 'form-control', 'id' => 'received_permission']) }}

            @if ($errors->has('received_permission'))
                <span class="help-block">
                    <strong>{{ $errors->first('received_permission') }}</strong>
                </span>
            @endif
        </div>

        <div class="col-md-12 form-group{{ $errors->has('restricted_access') ? ' has-error' : '' }}">
            {{ Form::label('restricted_access', 'Έχει ο ιστότοπος περιορισμένη πρόσβαση;') }}

            {{ Form::select('restricted_access', ['' => 'Επιλέξτε...', 'yes' => 'Ναι', 'no' => 'Όχι',], null, ['class' => 'form-control', 'id' => 'restricted_access']) }}

            @if ($errors->has('restricted_access'))
                <span class="help-block">
                    <strong>{{ $errors->first('restricted_access') }}</strong>
                </span>
            @endif
        </div>

        <div id="restricted_access_details_wrapper" class="col-md-12 form-group{{ $errors->has('restricted_access_details') ? ' has-error' : '' }}">
            {{ Form::label('restricted_access_details', 'Πληροφορίες πρόσβασης') }}
            {{ Form::textarea('restricted_access_details', null, ['class' => 'form-control', 'id' => 'restricted_access_details', 'rows' => 3, 'placeholder' => 'Δώστε λεπτομέρειες σχετικά με την είσοδο στον ιστότοπο με περιορισμένη πρόσβαση']) }}

            @if ($errors->has('restricted_access_details'))
                <span class="help-block">
                    <strong>{{ $errors->first('restricted_access_details') }}</strong>
                </span>
            @endif
            <span class="help-block">
                Δώστε λεπτομέρειες σχετικά με την είσοδο στον ιστότοπο με περιορισμένη πρόσβαση
            </span>
        </div>

        <div class="col-md-12 form-group{{ $errors->has('purpose') ? ' has-error' : '' }}">
            {{ Form::label('purpose', 'Σκοπός - Στόχοι') }}
            {{ Form::textarea('purpose', null, ['class' => 'form-control', 'id' => 'purpose', 'rows' => 5, 'placeholder' => 'Εφόσον στον Ιστότοπο δεν αναφέρονται ρητά ο σκοπός και οι στόχοι του, δηλώστε τους εδώ' ]) }}

            @if ($errors->has('purpose'))
                <span class="help-block">
                    <strong>{{ $errors->first('purpose') }}</strong>
                </span>
            @endif

            <span class="help-block">
                Εφόσον στον Ιστότοπο δεν αναφέρονται ρητά ο σκοπός και οι στόχοι του, δηλώστε τους εδώ
            </span>
        </div>

    </div>
</div>
