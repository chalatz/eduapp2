<?php $criteria = App\DeltaCriterion::all()->first(); ?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h2 class="panel-title">Δ: {!! $criteria->main_title !!}</h2>
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
                    <td style="font-size: 1.2em"><strong>Δκ1</strong></td>
                    <td><strong>{!! $criteria->dk1_title !!}</strong></td>
                    <td><strong>{!! $criteria->dk1_1_title !!}</strong></td>
                    <td><strong>{!! $criteria->dk1_2_title !!}</strong></td>
                    <td><strong>{!! $criteria->dk1_3_title !!}</strong></td>
                    <td><strong>{!! $criteria->dk1_4_title !!}</strong></td>
                    <td><strong>{!! $criteria->dk1_5_title !!}</strong></td>
                </tr>
            </tbody>
        </table>

        <div class="col-md-12 form-group{{ $errors->has('dk1') ? ' has-error' : '' }}">
            <label for="dk1" class="text-primary" style="font-size: 1.5em;">Δκ1 ({{ $criteria->dk1_weight }}%) *</label>
            {{ Form::select('dk1',[
                '' => 'Βαθμολογήστε (1 έως 5)',
                1 => '1',
                2 => '2',
                3 => '3',
                4 => '4',
                5 => '5',
            ], null, ['class' => 'form-control', 'id' => 'dk1', 'required']) }}

            @if ($errors->has('dk1'))
                <span class="help-block">
                    <strong>{{ $errors->first('dk1') }}</strong>
                </span>
            @endif                                            
        </div>

    </div>

    <div class="panel-footer clearfix">

        <div class="col-md-12 form-group{{ $errors->has('dk1_comment') ? ' has-error' : '' }}">
            {{ Form::label('dk1_comment', 'Σχόλια - Παρατηρήσεις - Προτάσεις για το Κριτήριο Δκ1:') }}

            {{ Form::textarea('dk1_comment', null, ['rows' => 3, 'cols' => '50','class' => 'form-control', 'id' => 'dk1_comment', 'placeholder' => 'Προαιρετικά σχόλια για το Κριτήριο.']) }}                                            

            @if ($errors->has('dk1_comment'))
                <span class="help-block">
                    <strong>{{ $errors->first('dk1_comment') }}</strong>
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
                    <td style="font-size: 1.2em"><strong>Δκ2</strong></td>
                    <td><strong>{!! $criteria->dk2_title !!}</strong></td>
                    <td><strong>{!! $criteria->dk2_1_title !!}</strong></td>
                    <td><strong>{!! $criteria->dk2_2_title !!}</strong></td>
                    <td><strong>{!! $criteria->dk2_3_title !!}</strong></td>
                    <td><strong>{!! $criteria->dk2_4_title !!}</strong></td>
                    <td><strong>{!! $criteria->dk2_5_title !!}</strong></td>
                </tr>
            </tbody>
        </table>

        <div class="col-md-12 form-group{{ $errors->has('dk2') ? ' has-error' : '' }}">
            <label for="dk2" class="text-primary" style="font-size: 1.5em;">Δκ2 ({{ $criteria->dk2_weight }}%) *</label>
            {{ Form::select('dk2',[
                '' => 'Βαθμολογήστε (1 έως 5)',
                1 => '1',
                2 => '2',
                3 => '3',
                4 => '4',
                5 => '5',
            ], null, ['class' => 'form-control', 'id' => 'dk2', 'required']) }}

            @if ($errors->has('dk2'))
                <span class="help-block">
                    <strong>{{ $errors->first('dk2') }}</strong>
                </span>
            @endif                                            
        </div>

    </div>

    <div class="panel-footer clearfix">

        <div class="col-md-12 form-group{{ $errors->has('dk2_comment') ? ' has-error' : '' }}">
            {{ Form::label('dk2_comment', 'Σχόλια - Παρατηρήσεις - Προτάσεις για το Κριτήριο Δκ2:') }}

            {{ Form::textarea('dk2_comment', null, ['rows' => 3, 'cols' => '50','class' => 'form-control', 'id' => 'dk2_comment', 'placeholder' => 'Προαιρετικά σχόλια για το Κριτήριο.']) }}                                            

            @if ($errors->has('dk2_comment'))
                <span class="help-block">
                    <strong>{{ $errors->first('dk2_comment') }}</strong>
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
                    <td style="font-size: 1.2em"><strong>Δκ3</strong></td>
                    <td><strong>{!! $criteria->dk3_title !!}</strong></td>
                    <td><strong>{!! $criteria->dk3_1_title !!}</strong></td>
                    <td><strong>{!! $criteria->dk3_2_title !!}</strong></td>
                    <td><strong>{!! $criteria->dk3_3_title !!}</strong></td>
                    <td><strong>{!! $criteria->dk3_4_title !!}</strong></td>
                    <td><strong>{!! $criteria->dk3_5_title !!}</strong></td>
                </tr>
            </tbody>
        </table>

        <div class="col-md-12 form-group{{ $errors->has('dk3') ? ' has-error' : '' }}">
            <label for="dk3" class="text-primary" style="font-size: 1.5em;">Δκ3 ({{ $criteria->dk3_weight }}%) *</label>
            {{ Form::select('dk3',[
                '' => 'Βαθμολογήστε (1 έως 5)',
                1 => '1',
                2 => '2',
                3 => '3',
                4 => '4',
                5 => '5',
            ], null, ['class' => 'form-control', 'id' => 'dk3', 'required']) }}

            @if ($errors->has('dk3'))
                <span class="help-block">
                    <strong>{{ $errors->first('dk3') }}</strong>
                </span>
            @endif                                            
        </div>

    </div>

    <div class="panel-footer clearfix">

        <div class="col-md-12 form-group{{ $errors->has('dk3_comment') ? ' has-error' : '' }}">
            {{ Form::label('dk3_comment', 'Σχόλια - Παρατηρήσεις - Προτάσεις για το Κριτήριο Δκ3:') }}

            {{ Form::textarea('dk3_comment', null, ['rows' => 3, 'cols' => '50','class' => 'form-control', 'id' => 'dk3_comment', 'placeholder' => 'Προαιρετικά σχόλια για το Κριτήριο.']) }}                                            

            @if ($errors->has('dk3_comment'))
                <span class="help-block">
                    <strong>{{ $errors->first('dk3_comment') }}</strong>
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
                    <td style="font-size: 1.2em"><strong>Δκ4</strong></td>
                    <td><strong>{!! $criteria->dk4_title !!}</strong></td>
                    <td><strong>{!! $criteria->dk4_1_title !!}</strong></td>
                    <td><strong>{!! $criteria->dk4_2_title !!}</strong></td>
                    <td><strong>{!! $criteria->dk4_3_title !!}</strong></td>
                    <td><strong>{!! $criteria->dk4_4_title !!}</strong></td>
                    <td><strong>{!! $criteria->dk4_5_title !!}</strong></td>
                </tr>
            </tbody>
        </table>

        <div class="col-md-12 form-group{{ $errors->has('dk4') ? ' has-error' : '' }}">
            <label for="dk4" class="text-primary" style="font-size: 1.5em;">Δκ4 ({{ $criteria->dk4_weight }}%) *</label>
            {{ Form::select('dk4',[
                '' => 'Βαθμολογήστε (1 έως 5)',
                1 => '1',
                2 => '2',
                3 => '3',
                4 => '4',
                5 => '5',
            ], null, ['class' => 'form-control', 'id' => 'dk4', 'required']) }}

            @if ($errors->has('dk4'))
                <span class="help-block">
                    <strong>{{ $errors->first('dk4') }}</strong>
                </span>
            @endif                                            
        </div>

    </div>

    <div class="panel-footer clearfix">

        <div class="col-md-12 form-group{{ $errors->has('dk4_comment') ? ' has-error' : '' }}">
            {{ Form::label('dk4_comment', 'Σχόλια - Παρατηρήσεις - Προτάσεις για το Κριτήριο Δκ4:') }}

            {{ Form::textarea('dk4_comment', null, ['rows' => 3, 'cols' => '50','class' => 'form-control', 'id' => 'dk4_comment', 'placeholder' => 'Προαιρετικά σχόλια για το Κριτήριο.']) }}                                            

            @if ($errors->has('dk4_comment'))
                <span class="help-block">
                    <strong>{{ $errors->first('dk4_comment') }}</strong>
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
                    <td style="font-size: 1.2em"><strong>Δκ5</strong></td>
                    <td><strong>{!! $criteria->dk5_title !!}</strong></td>
                    <td><strong>{!! $criteria->dk5_1_title !!}</strong></td>
                    <td><strong>{!! $criteria->dk5_2_title !!}</strong></td>
                    <td><strong>{!! $criteria->dk5_3_title !!}</strong></td>
                    <td><strong>{!! $criteria->dk5_4_title !!}</strong></td>
                    <td><strong>{!! $criteria->dk5_5_title !!}</strong></td>
                </tr>
            </tbody>
        </table>

        <div class="col-md-12 form-group{{ $errors->has('dk5') ? ' has-error' : '' }}">
            <label for="dk5" class="text-primary" style="font-size: 1.5em;">Δκ5 ({{ $criteria->dk5_weight }}%) *</label>
            {{ Form::select('dk5',[
                '' => 'Βαθμολογήστε (1 έως 5)',
                1 => '1',
                2 => '2',
                3 => '3',
                4 => '4',
                5 => '5',
            ], null, ['class' => 'form-control', 'id' => 'dk5', 'required']) }}

            @if ($errors->has('dk5'))
                <span class="help-block">
                    <strong>{{ $errors->first('dk5') }}</strong>
                </span>
            @endif                                            
        </div>

    </div>

    <div class="panel-footer clearfix">

        <div class="col-md-12 form-group{{ $errors->has('dk5_comment') ? ' has-error' : '' }}">
            {{ Form::label('dk5_comment', 'Σχόλια - Παρατηρήσεις - Προτάσεις για το Κριτήριο Δκ5:') }}

            {{ Form::textarea('dk5_comment', null, ['rows' => 3, 'cols' => '50','class' => 'form-control', 'id' => 'dk5_comment', 'placeholder' => 'Προαιρετικά σχόλια για το Κριτήριο.']) }}                                            

            @if ($errors->has('dk5_comment'))
                <span class="help-block">
                    <strong>{{ $errors->first('dk5_comment') }}</strong>
                </span>
            @endif                                            
        </div>
        
    </div>
                
</div>   

<div class="panel panel-default">

    <div class="panel-body">
        <div class="col-md-12 form-group{{ $errors->has('delta_comment') ? ' has-error' : '' }}">
            {{ Form::label('delta_comment', 'Σχόλια - Παρατηρήσεις - Προτάσεις για τον Γ Άξονα:') }}

            {{ Form::textarea('delta_comment', null, ['rows' => 3, 'cols' => '50','class' => 'form-control', 'id' => 'delta_comment', 'placeholder' => 'Προαιρετικά σχόλια για τον Άξονα.']) }}                                            

            @if ($errors->has('delta_comment'))
                <span class="help-block">
                    <strong>{{ $errors->first('delta_comment') }}</strong>
                </span>
            @endif                                            
        </div>
    </div>

</div>  
