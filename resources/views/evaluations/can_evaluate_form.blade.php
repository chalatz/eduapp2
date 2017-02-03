<div class="container">
    <div class="col-md-10">
        {!! Form::model($evaluation, ['method' => 'PUT','route' => ['can_evaluate_submit', $evaluation->id], 'class' => 'form-horizontal', 'id' => 'confirmCanEvaluate-'.$site_index, 'name' => 'confirmCanEvaluate-'.$site_index]) !!}

            <div class="col-md-12 form-group{{ $errors->has('can_evaluate') ? ' has-error' : '' }}">
                {{ Form::label('can_evaluate', 'Αποδέχεστε να αξιολογήσετε αυτόν τον ιστότοπο;') }}
                {{ Form::select('can_evaluate',[
                    '' => 'Επιλέξτε...',
                    'yes' => 'Ναι',
                    'no' => 'Όχι',
                ], null, array('class' => 'form-control', 'id' => 'can_evaluate-'.$site_index)) }}

                <div><strong>Μόνο</strong> εάν αποδεχτείτε, θα μπορέσετε να προχωρήσετε στην αξιολόγησή του.</div>

                @if ($errors->has('can_evaluate'))
                    <span class="help-block">
                        <strong>{{ $errors->first('can_evaluate') }}</strong>
                    </span>
                @endif                                            
            </div>

            <div class="col-md-12 form-group{{ $errors->has('why_cannot_evaluate') ? ' has-error' : '' }}">
                {{ Form::label('why_cannot_evaluate', 'Εάν ΔΕΝ αποδέχεστε να αξιολογήσετε αυτόν τον ιστότοπο και εφόσον συντρέχει πολύ σοβαρός λόγος, παρακαλούμε αιτιολογήστε:') }}

                {{ Form::textarea('why_cannot_evaluate', null, ['rows' => 3, 'cols' => '50','class' => 'form-control', 'id' => 'why_cannot_evaluate-'.$site_index]) }}                                            

                @if ($errors->has('why_cannot_evaluate'))
                    <span class="help-block">
                        <strong>{{ $errors->first('why_cannot_evaluate') }}</strong>
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