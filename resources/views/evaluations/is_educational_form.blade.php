<div class="container">
    <div class="col-md-10">
        {!! Form::model($evaluation, ['method' => 'PUT','route' => ['is_educational_submit', $evaluation->id], 'class' => 'form-horizontal', 'id' => 'confirmAlpha-'.$site_index, 'name' => 'confirmAlpha-'.$site_index, 'data-parsley-validate']) !!}

            <div class="col-md-12 form-group{{ $errors->has('is_educational') ? ' has-error' : '' }}">
                <div>Ο Ιστότοπος θεωρείται εκπαιδευτικός εφόσον πληροί τους <a href="http://2017.eduwebawards.gr/requirements/" target="_blank">Όρους Συμμετοχής.</a></div>
                {{ Form::label('is_educational', 'Α Άξονας: Είναι ο Ιστότοπος Εκπαιδευτικός;') }}
                {{ Form::select('is_educational',[
                    '' => 'Επιλέξτε...',
                    'yes' => 'Ναι',
                    'no' => 'Όχι',
                ], null, ['class' => 'form-control', 'id' => 'is_educational-'.$site_index, 'required']) }}

                <div class="instructions"><strong>Μόνο</strong> εάν επιβεβαιώσετε ότι ο ιστότοπος ότι είναι εκπαιδευτικός, θα μπορέσετε να προχωρήσετε στην αξιολόγησή του.</div>

                @if ($errors->has('is_educational'))
                    <span class="help-block">
                        <strong>{{ $errors->first('is_educational') }}</strong>
                    </span>
                @endif                                            
            </div>

            <div class="col-md-12 form-group{{ $errors->has('why_not_educational') ? ' has-error' : '' }}">
                {{ Form::label('why_not_educational', 'Εάν ο ιστότοπος ΔΕΝ είναι εκπαιδευτικός, παρακαλούμε αιτιολογήστε:') }}

                {{ Form::textarea('why_not_educational', null, ['rows' => 3, 'cols' => '50','class' => 'form-control', 'id' => 'why_not_educational-'.$site_index]) }}                                            

                @if ($errors->has('why_not_educational'))
                    <span class="help-block">
                        <strong>{{ $errors->first('why_not_educational') }}</strong>
                    </span>
                @endif                                            
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    {{ Form::button('Υποβολή', ['type' => 'submit', 'class' => 'btn btn-primary btn-block btn-lg']) }}
                </div>
            </div>                                         

        {{ Form::close() }}
    </div>
</div>