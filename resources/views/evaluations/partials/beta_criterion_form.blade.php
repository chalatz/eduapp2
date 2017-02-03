<?php $criteria = App\BetaCriterion::all()->first(); ?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h2 class="panel-title">Β: {!! $criteria->main_title !!}</h2>
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
                    <td style="font-size: 1.2em"><strong>Βκ1</strong></td>
                    <td><strong>{!! $criteria->bk1_title !!}</strong></td>
                    <td><strong>{!! $criteria->bk1_1_title !!}</strong></td>
                    <td><strong>{!! $criteria->bk1_2_title !!}</strong></td>
                    <td><strong>{!! $criteria->bk1_3_title !!}</strong></td>
                    <td><strong>{!! $criteria->bk1_4_title !!}</strong></td>
                    <td><strong>{!! $criteria->bk1_5_title !!}</strong></td>
                </tr>
            </tbody>
        </table>

        <div class="col-md-12 form-group{{ $errors->has('bk1') ? ' has-error' : '' }}">
            <label for="bk1" class="text-primary" style="font-size: 1.5em;">Βκ1 ({{ $criteria->bk1_weight }}%) *</label>
            {{ Form::select('bk1',[
                '' => 'Βαθμολογήστε (1 έως 5)',
                1 => '1',
                2 => '2',
                3 => '3',
                4 => '4',
                5 => '5',
            ], null, ['class' => 'form-control', 'id' => 'bk1', 'required']) }}

            @if ($errors->has('bk1'))
                <span class="help-block">
                    <strong>{{ $errors->first('bk1') }}</strong>
                </span>
            @endif                                            
        </div>

    </div>

    <div class="panel-footer clearfix">

        <div class="col-md-12 form-group{{ $errors->has('bk1_comment') ? ' has-error' : '' }}">
            {{ Form::label('bk1_comment', 'Σχόλια - Παρατηρήσεις - Προτάσεις για το Κριτήριο Βκ1:') }}

            {{ Form::textarea('bk1_comment', null, ['rows' => 3, 'cols' => '50','class' => 'form-control', 'id' => 'bk1_comment', 'placeholder' => 'Προαιρετικά σχόλια για το Κριτήριο.']) }}                                            

            @if ($errors->has('bk1_comment'))
                <span class="help-block">
                    <strong>{{ $errors->first('bk1_comment') }}</strong>
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
                    <td style="font-size: 1.2em"><strong>Βκ2</strong></td>
                    <td><strong>{!! $criteria->bk2_title !!}</strong></td>
                    <td><strong>{!! $criteria->bk2_1_title !!}</strong></td>
                    <td><strong>{!! $criteria->bk2_2_title !!}</strong></td>
                    <td><strong>{!! $criteria->bk2_3_title !!}</strong></td>
                    <td><strong>{!! $criteria->bk2_4_title !!}</strong></td>
                    <td><strong>{!! $criteria->bk2_5_title !!}</strong></td>
                </tr>
            </tbody>
        </table>

        <div class="col-md-12 form-group{{ $errors->has('bk2') ? ' has-error' : '' }}">
            <label for="bk2" class="text-primary" style="font-size: 1.5em;">Βκ2 ({{ $criteria->bk2_weight }}%) *</label>
            {{ Form::select('bk2',[
                '' => 'Βαθμολογήστε (1 έως 5)',
                1 => '1',
                2 => '2',
                3 => '3',
                4 => '4',
                5 => '5',
            ], null, ['class' => 'form-control', 'id' => 'bk2', 'required']) }}

            @if ($errors->has('bk2'))
                <span class="help-block">
                    <strong>{{ $errors->first('bk2') }}</strong>
                </span>
            @endif                                            
        </div>

    </div>

    <div class="panel-footer clearfix">

        <div class="col-md-12 form-group{{ $errors->has('bk2_comment') ? ' has-error' : '' }}">
            {{ Form::label('bk2_comment', 'Σχόλια - Παρατηρήσεις - Προτάσεις για το Κριτήριο Βκ2:') }}

            {{ Form::textarea('bk2_comment', null, ['rows' => 3, 'cols' => '50','class' => 'form-control', 'id' => 'bk2_comment', 'placeholder' => 'Προαιρετικά σχόλια για το Κριτήριο.']) }}                                            

            @if ($errors->has('bk2_comment'))
                <span class="help-block">
                    <strong>{{ $errors->first('bk2_comment') }}</strong>
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
                    <td style="font-size: 1.2em"><strong>Βκ3</strong></td>
                    <td><strong>{!! $criteria->bk3_title !!}</strong></td>
                    <td><strong>{!! $criteria->bk3_1_title !!}</strong></td>
                    <td><strong>{!! $criteria->bk3_2_title !!}</strong></td>
                    <td><strong>{!! $criteria->bk3_3_title !!}</strong></td>
                    <td><strong>{!! $criteria->bk3_4_title !!}</strong></td>
                    <td><strong>{!! $criteria->bk3_5_title !!}</strong></td>
                </tr>
            </tbody>
        </table>

        <div class="col-md-12 form-group{{ $errors->has('bk3') ? ' has-error' : '' }}">
            <label for="bk3" class="text-primary" style="font-size: 1.5em;">Βκ3 ({{ $criteria->bk3_weight }}%) *</label>
            {{ Form::select('bk3',[
                '' => 'Βαθμολογήστε (1 έως 5)',
                1 => '1',
                2 => '2',
                3 => '3',
                4 => '4',
                5 => '5',
            ], null, ['class' => 'form-control', 'id' => 'bk3', 'required']) }}

            @if ($errors->has('bk3'))
                <span class="help-block">
                    <strong>{{ $errors->first('bk3') }}</strong>
                </span>
            @endif                                            
        </div>

    </div>

    <div class="panel-footer clearfix">

        <div class="col-md-12 form-group{{ $errors->has('bk3_comment') ? ' has-error' : '' }}">
            {{ Form::label('bk3_comment', 'Σχόλια - Παρατηρήσεις - Προτάσεις για το Κριτήριο Βκ3:') }}

            {{ Form::textarea('bk3_comment', null, ['rows' => 3, 'cols' => '50','class' => 'form-control', 'id' => 'bk3_comment', 'placeholder' => 'Προαιρετικά σχόλια για το Κριτήριο.']) }}                                            

            @if ($errors->has('bk3_comment'))
                <span class="help-block">
                    <strong>{{ $errors->first('bk3_comment') }}</strong>
                </span>
            @endif                                            
        </div>
        
    </div>
                
</div>   

<div class="panel panel-default">

    <div class="panel-body">
        <div class="col-md-12 form-group{{ $errors->has('beta_comment') ? ' has-error' : '' }}">
            {{ Form::label('beta_comment', 'Σχόλια - Παρατηρήσεις - Προτάσεις για τον Β Άξονα:') }}

            {{ Form::textarea('beta_comment', null, ['rows' => 3, 'cols' => '50','class' => 'form-control', 'id' => 'beta_comment', 'placeholder' => 'Προαιρετικά σχόλια για τον Άξονα.']) }}                                            

            @if ($errors->has('beta_comment'))
                <span class="help-block">
                    <strong>{{ $errors->first('beta_comment') }}</strong>
                </span>
            @endif                                            
        </div>
    </div>

</div>  
