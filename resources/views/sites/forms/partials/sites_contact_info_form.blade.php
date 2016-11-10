<div class="panel panel-success">
    <div class="panel-heading"><h4>Στοιχεία Επικοινωνίας Υποψηφιότητας</h4></div>
    <div class="panel-body">

        <div class="col-md-12 form-group{{ $errors->has('contact_last_name') ? ' has-error' : '' }}">
            {{ Form::label('contact_last_name', 'Επώνυμο Υπεύθυνου επικοινωνίας υποψηφιότητας *') }}
            {{ Form::text('contact_last_name', null, ['class' => 'form-control', 'id' => 'contact_last_name', 'placeholder' => 'Παρακαλούμε γράψτε με το πρώτο γράμμα κεφαλαίο και τα υπόλοιπα πεζά με τόνους', 'required']) }}

            @if ($errors->has('contact_last_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('contact_last_name') }}</strong>
                </span>
            @endif

            <span class="help-block">
                Παρακαλούμε γράψτε με το πρώτο γράμμα κεφαλαίο και τα υπόλοιπα πεζά με τόνους
            </span>
        </div>

        <div class="col-md-12 form-group{{ $errors->has('contact_first_name') ? ' has-error' : '' }}">
            {{ Form::label('contact_first_name', 'Όνομα Υπεύθυνου επικοινωνίας υποψηφιότητας *') }}
            {{ Form::text('contact_first_name', null, ['class' => 'form-control', 'id' => 'contact_first_name', 'placeholder' => 'Παρακαλούμε γράψτε με το πρώτο γράμμα κεφαλαίο και τα υπόλοιπα πεζά με τόνους', 'required']) }}

            @if ($errors->has('contact_first_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('contact_first_name') }}</strong>
                </span>
            @endif

            <span class="help-block">
                Παρακαλούμε γράψτε με το πρώτο γράμμα κεφαλαίο και τα υπόλοιπα πεζά με τόνους
            </span>
        </div>

        <div class="col-md-12 form-group{{ $errors->has('contact_email') ? ' has-error' : '' }}">
            {{ Form::label('contact_email', 'E-mail Υπεύθυνου επικοινωνίας υποψηφιότητας *') }}
            {{ Form::email('contact_email', null, ['class' => 'form-control', 'id' => 'contact_email', 'required']) }}

            @if ($errors->has('contact_email'))
                <span class="help-block">
                    <strong>{{ $errors->first('contact_email') }}</strong>
                </span>
            @endif
        </div>

        <div class="col-md-12 form-group{{ $errors->has('contact_phone') ? ' has-error' : '' }}">
            {{ Form::label('contact_phone', 'Τηλέφωνα επικοινωνίας *') }}
            {{ Form::text('contact_phone', null, ['class' => 'form-control', 'id' => 'contact_phone', 'required']) }}

            @if ($errors->has('contact_phone'))
                <span class="help-block">
                    <strong>{{ $errors->first('contact_phone') }}</strong>
                </span>
            @endif
        </div>

        <div class="col-md-12 form-group{{ $errors->has('contact_address') ? ' has-error' : '' }}">
            {{ Form::label('contact_address', 'Ταχ. Διεύθυνση') }}
            {{ Form::text('contact_address', null, ['class' => 'form-control', 'id' => 'contact_address']) }}

            @if ($errors->has('contact_address'))
                <span class="help-block">
                    <strong>{{ $errors->first('contact_address') }}</strong>
                </span>
            @endif
        </div>


    </div>
</div>
