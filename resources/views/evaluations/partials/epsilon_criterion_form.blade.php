<?php $criteria = App\EpsilonCriterion::all()->first(); ?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h2 class="panel-title">Ε: {!! $criteria->main_title !!}</h2>
    </div>
    <div class="panel-body">
        <p class="lead">Ποσοστό επί του συνόλου: {{ $criteria->weight }}%</p>
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h2 class="panel-title">Σκοπός - Στόχοι Ιστότοπου (από την αίτηση):</h2>
    </div>
    <div class="panel-body">
        @if(App\Site::find($evaluation->site_id)->purpose)
            <p style="font-size: 1.2em"><em>{!! nl2br(e(App\Site::find($evaluation->site_id)->purpose)) !!}</em></p>
        @else
            <p style="font-size: 1.2em"><em>Ο Υποψήφιος δεν έχει δηλώσει σκοπούς-στόχους στην αίτησή του. Παρακαλούμε δείτε εάν αναφέρονται μέσα στον ίδιο τον Ιστότοπο.</em></p>
    @endif
    </div>
</div>

<div class="panel panel-default">

    <div class="panel-body">

        <table class="table table-bordered">
            <thead>
                <tr class="bg-info">
                    <th colspan="2"></th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="font-size: 1.2em"><strong>Εκ1</strong></td>
                    <td><strong>{!! $criteria->ek1_title !!}</strong></td>
                    <td><strong>{!! $criteria->ek1_1_title !!}</strong></td>
                    <td><strong>{!! $criteria->ek1_2_title !!}</strong></td>
                    <td><strong>{!! $criteria->ek1_3_title !!}</strong></td>
                    <td><strong>{!! $criteria->ek1_4_title !!}</strong></td>
                    <td><strong>{!! $criteria->ek1_5_title !!}</strong></td>
                </tr>
            </tbody>
        </table>

        <div class="col-md-12 form-group{{ $errors->has('ek1') ? ' has-error' : '' }}">
            <label for="ek1" class="text-primary" style="font-size: 1.5em;">Εκ1 ({{ $criteria->ek1_weight }}%) *</label>
            {{ Form::select('ek1',[
                '' => 'Βαθμολογήστε (1 έως 5)',
                1 => '1',
                2 => '2',
                3 => '3',
                4 => '4',
                5 => '5',
            ], null, ['class' => 'form-control', 'id' => 'ek1', 'required']) }}

            @if ($errors->has('ek1'))
                <span class="help-block">
                    <strong>{{ $errors->first('ek1') }}</strong>
                </span>
            @endif                                            
        </div>

    </div>

    <div class="panel-footer clearfix">

        <div class="col-md-12 form-group{{ $errors->has('ek1_comment') ? ' has-error' : '' }}">
            {{ Form::label('ek1_comment', 'Σχόλια - Παρατηρήσεις - Προτάσεις για το Κριτήριο Εκ1:') }}

            {{ Form::textarea('ek1_comment', null, ['rows' => 3, 'cols' => '50','class' => 'form-control', 'id' => 'ek1_comment', 'placeholder' => 'Προαιρετικά σχόλια για το Κριτήριο.']) }}                                            

            @if ($errors->has('ek1_comment'))
                <span class="help-block">
                    <strong>{{ $errors->first('ek1_comment') }}</strong>
                </span>
            @endif                                            
        </div>
        
    </div>
                
</div>

<div class="panel panel-default">

    <div class="panel-body">

        <table class="table table-bordered">
            <thead>
                <tr class="bg-info">
                    <th colspan="2"></th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="font-size: 1.2em"><strong>Εκ2</strong></td>
                    <td><strong>{!! $criteria->ek2_title !!}</strong></td>
                    <td><strong>{!! $criteria->ek2_1_title !!}</strong></td>
                    <td><strong>{!! $criteria->ek2_2_title !!}</strong></td>
                    <td><strong>{!! $criteria->ek2_3_title !!}</strong></td>
                    <td><strong>{!! $criteria->ek2_4_title !!}</strong></td>
                    <td><strong>{!! $criteria->ek2_5_title !!}</strong></td>
                </tr>
            </tbody>
        </table>

        <div class="col-md-12 form-group{{ $errors->has('ek2') ? ' has-error' : '' }}">
            <label for="ek2" class="text-primary" style="font-size: 1.5em;">Εκ2 ({{ $criteria->ek2_weight }}%) *</label>
            {{ Form::select('ek2',[
                '' => 'Βαθμολογήστε (1 έως 5)',
                1 => '1',
                2 => '2',
                3 => '3',
                4 => '4',
                5 => '5',
            ], null, ['class' => 'form-control', 'id' => 'ek2', 'required']) }}

            @if ($errors->has('ek2'))
                <span class="help-block">
                    <strong>{{ $errors->first('ek2') }}</strong>
                </span>
            @endif                                            
        </div>

    </div>

    <div class="panel-footer clearfix">

        <div class="col-md-12 form-group{{ $errors->has('ek2_comment') ? ' has-error' : '' }}">
            {{ Form::label('ek2_comment', 'Σχόλια - Παρατηρήσεις - Προτάσεις για το Κριτήριο Εκ2:') }}

            {{ Form::textarea('ek2_comment', null, ['rows' => 3, 'cols' => '50','class' => 'form-control', 'id' => 'ek2_comment', 'placeholder' => 'Προαιρετικά σχόλια για το Κριτήριο.']) }}                                            

            @if ($errors->has('ek2_comment'))
                <span class="help-block">
                    <strong>{{ $errors->first('ek2_comment') }}</strong>
                </span>
            @endif                                            
        </div>
        
    </div>
                
</div>

<div class="panel panel-default">

    <div class="panel-body">

        <table class="table table-bordered">
            <thead>
                <tr class="bg-info">
                    <th colspan="2"></th>
                    <th>1</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>5</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="font-size: 1.2em"><strong>Εκ3</strong></td>
                    <td><strong>{!! $criteria->ek3_title !!}</strong></td>
                    <td><strong>{!! $criteria->ek3_1_title !!}</strong></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><strong>{!! $criteria->ek3_5_title !!}</strong></td>
                </tr>
            </tbody>
        </table>

        <p class="help-block">
            <strong>Επεξηγήσεις:</strong><br>
            {!! $criteria->ek3_1_explain !!}<br>
            {!! $criteria->ek3_2_explain !!}
        </p>        

        <div class="col-md-12 form-group{{ $errors->has('ek3') ? ' has-error' : '' }}">
            <label for="ek3" class="text-primary" style="font-size: 1.5em;">Εκ3 ({{ $criteria->ek3_weight }}%) *</label>
            {{ Form::select('ek3',[
                '' => 'Βαθμολογήστε (1 ή 5)',
                1 => '1',
                5 => '5',
            ], null, ['class' => 'form-control', 'id' => 'ek3', 'required']) }}

            @if ($errors->has('ek3'))
                <span class="help-block">
                    <strong>{{ $errors->first('ek3') }}</strong>
                </span>
            @endif                                            
        </div>

    </div>

    <div class="panel-footer clearfix">

        <div class="col-md-12 form-group{{ $errors->has('ek3_comment') ? ' has-error' : '' }}">
            {{ Form::label('ek3_comment', 'Σχόλια - Παρατηρήσεις - Προτάσεις για το Κριτήριο Εκ3:') }}

            {{ Form::textarea('ek3_comment', null, ['rows' => 3, 'cols' => '50','class' => 'form-control', 'id' => 'ek3_comment', 'placeholder' => 'Προαιρετικά σχόλια για το Κριτήριο.']) }}                                            

            @if ($errors->has('ek3_comment'))
                <span class="help-block">
                    <strong>{{ $errors->first('ek3_comment') }}</strong>
                </span>
            @endif                                            
        </div>
        
    </div>
                
</div>   

<div class="panel panel-default">

    <div class="panel-body">
        <div class="col-md-12 form-group{{ $errors->has('epsilon_comment') ? ' has-error' : '' }}">
            {{ Form::label('epsilon_comment', 'Σχόλια - Παρατηρήσεις - Προτάσεις για τον Ε Άξονα:') }}

            {{ Form::textarea('epsilon_comment', null, ['rows' => 3, 'cols' => '50','class' => 'form-control', 'id' => 'epsilon_comment', 'placeholder' => 'Προαιρετικά σχόλια για τον Άξονα.']) }}                                            

            @if ($errors->has('epsilon_comment'))
                <span class="help-block">
                    <strong>{{ $errors->first('epsilon_comment') }}</strong>
                </span>
            @endif                                            
        </div>
    </div>

</div>  
