<?php $criteria = App\StCriterion::all()->first(); ?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h2 class="panel-title">ΣΤ: {!! $criteria->main_title !!}</h2>
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
                    <td style="font-size: 1.2em"><strong>ΣΤκ1</strong></td>
                    <td><strong>{!! $criteria->stk1_title !!}</strong></td>
                    <td><strong>{!! $criteria->stk1_1_title !!}</strong></td>
                    <td><strong>{!! $criteria->stk1_2_title !!}</strong></td>
                    <td><strong>{!! $criteria->stk1_3_title !!}</strong></td>
                    <td><strong>{!! $criteria->stk1_4_title !!}</strong></td>
                    <td><strong>{!! $criteria->stk1_5_title !!}</strong></td>
                </tr>
            </tbody>
        </table>

        <div class="col-md-12 form-group{{ $errors->has('stk1') ? ' has-error' : '' }}">
            <label for="stk1" class="text-primary" style="font-size: 1.5em;">ΣΤκ1 ({{ $criteria->stk1_weight }}%) *</label>
            {{ Form::select('stk1',[
                '' => 'Βαθμολογήστε (1 έως 5)',
                1 => '1',
                2 => '2',
                3 => '3',
                4 => '4',
                5 => '5',
            ], null, ['class' => 'form-control', 'id' => 'stk1', 'required']) }}

            @if ($errors->has('stk1'))
                <span class="help-block">
                    <strong>{{ $errors->first('stk1') }}</strong>
                </span>
            @endif                                            
        </div>

    </div>

    <div class="panel-footer clearfix">

        <div class="col-md-12 form-group{{ $errors->has('stk1_comment') ? ' has-error' : '' }}">
            {{ Form::label('stk1_comment', 'Σχόλια - Παρατηρήσεις - Προτάσεις για το Κριτήριο ΣΤκ1:') }}

            {{ Form::textarea('stk1_comment', null, ['rows' => 3, 'cols' => '50','class' => 'form-control', 'id' => 'stk1_comment', 'placeholder' => 'Προαιρετικά σχόλια για το Κριτήριο.']) }}                                            

            @if ($errors->has('stk1_comment'))
                <span class="help-block">
                    <strong>{{ $errors->first('stk1_comment') }}</strong>
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
                    <td style="font-size: 1.2em"><strong>ΣΤκ2</strong></td>
                    <td><strong>{!! $criteria->stk2_title !!}</strong></td>
                    <td><strong>{!! $criteria->stk2_1_title !!}</strong></td>
                    <td><strong>{!! $criteria->stk2_2_title !!}</strong></td>
                    <td><strong>{!! $criteria->stk2_3_title !!}</strong></td>
                    <td><strong>{!! $criteria->stk2_4_title !!}</strong></td>
                    <td><strong>{!! $criteria->stk2_5_title !!}</strong></td>
                </tr>
            </tbody>
        </table>

        <div class="col-md-12 form-group{{ $errors->has('stk2') ? ' has-error' : '' }}">
            <label for="stk2" class="text-primary" style="font-size: 1.5em;">ΣΤκ2 ({{ $criteria->stk2_weight }}%) *</label>
            {{ Form::select('stk2',[
                '' => 'Βαθμολογήστε (1 έως 5)',
                1 => '1',
                2 => '2',
                3 => '3',
                4 => '4',
                5 => '5',
            ], null, ['class' => 'form-control', 'id' => 'stk2', 'required']) }}

            @if ($errors->has('stk2'))
                <span class="help-block">
                    <strong>{{ $errors->first('stk2') }}</strong>
                </span>
            @endif                                            
        </div>

    </div>

    <div class="panel-footer clearfix">

        <div class="col-md-12 form-group{{ $errors->has('stk2_comment') ? ' has-error' : '' }}">
            {{ Form::label('stk2_comment', 'Σχόλια - Παρατηρήσεις - Προτάσεις για το Κριτήριο ΣΤκ2:') }}

            {{ Form::textarea('stk2_comment', null, ['rows' => 3, 'cols' => '50','class' => 'form-control', 'id' => 'stk2_comment', 'placeholder' => 'Προαιρετικά σχόλια για το Κριτήριο.']) }}                                            

            @if ($errors->has('stk2_comment'))
                <span class="help-block">
                    <strong>{{ $errors->first('stk2_comment') }}</strong>
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
                    <td style="font-size: 1.2em"><strong>ΣΤκ3</strong></td>
                    <td><strong>{!! $criteria->stk3_title !!}</strong></td>
                    <td><strong>{!! $criteria->stk3_1_title !!}</strong></td>
                    <td><strong>{!! $criteria->stk3_2_title !!}</strong></td>
                    <td><strong>{!! $criteria->stk3_3_title !!}</strong></td>
                    <td><strong>{!! $criteria->stk3_4_title !!}</strong></td>
                    <td><strong>{!! $criteria->stk3_5_title !!}</strong></td>
                </tr>
            </tbody>
        </table>

        <div class="col-md-12 form-group{{ $errors->has('stk3') ? ' has-error' : '' }}">
            <label for="stk3" class="text-primary" style="font-size: 1.5em;">ΣΤκ3 ({{ $criteria->stk3_weight }}%) *</label>
            {{ Form::select('stk3',[
                '' => 'Βαθμολογήστε (1 έως 5)',
                1 => '1',
                2 => '2',
                3 => '3',
                4 => '4',
                5 => '5',
            ], null, ['class' => 'form-control', 'id' => 'stk3', 'required']) }}

            @if ($errors->has('stk3'))
                <span class="help-block">
                    <strong>{{ $errors->first('stk3') }}</strong>
                </span>
            @endif                                            
        </div>

    </div>

    <div class="panel-footer clearfix">

        <div class="col-md-12 form-group{{ $errors->has('stk3_comment') ? ' has-error' : '' }}">
            {{ Form::label('stk3_comment', 'Σχόλια - Παρατηρήσεις - Προτάσεις για το Κριτήριο ΣΤκ3:') }}

            {{ Form::textarea('stk3_comment', null, ['rows' => 3, 'cols' => '50','class' => 'form-control', 'id' => 'stk3_comment', 'placeholder' => 'Προαιρετικά σχόλια για το Κριτήριο.']) }}                                            

            @if ($errors->has('stk3_comment'))
                <span class="help-block">
                    <strong>{{ $errors->first('stk3_comment') }}</strong>
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
                    <td style="font-size: 1.2em"><strong>ΣΤκ4</strong></td>
                    <td><strong>{!! $criteria->stk4_title !!}</strong></td>
                    <td><strong>{!! $criteria->stk4_1_title !!}</strong></td>
                    <td><strong>{!! $criteria->stk4_2_title !!}</strong></td>
                    <td><strong>{!! $criteria->stk4_3_title !!}</strong></td>
                    <td><strong>{!! $criteria->stk4_4_title !!}</strong></td>
                    <td><strong>{!! $criteria->stk4_5_title !!}</strong></td>
                </tr>
            </tbody>
        </table>

        <div class="col-md-12 form-group{{ $errors->has('stk4') ? ' has-error' : '' }}">
            <label for="stk4" class="text-primary" style="font-size: 1.5em;">ΣΤκ4 ({{ $criteria->stk4_weight }}%) *</label>
            {{ Form::select('stk4',[
                '' => 'Βαθμολογήστε (1 έως 5)',
                1 => '1',
                2 => '2',
                3 => '3',
                4 => '4',
                5 => '5',
            ], null, ['class' => 'form-control', 'id' => 'stk4', 'required']) }}

            @if ($errors->has('stk4'))
                <span class="help-block">
                    <strong>{{ $errors->first('stk4') }}</strong>
                </span>
            @endif                                            
        </div>

    </div>

    <div class="panel-footer clearfix">

        <div class="col-md-12 form-group{{ $errors->has('stk4_comment') ? ' has-error' : '' }}">
            {{ Form::label('stk4_comment', 'Σχόλια - Παρατηρήσεις - Προτάσεις για το Κριτήριο ΣΤκ4:') }}

            {{ Form::textarea('stk4_comment', null, ['rows' => 3, 'cols' => '50','class' => 'form-control', 'id' => 'stk4_comment', 'placeholder' => 'Προαιρετικά σχόλια για το Κριτήριο.']) }}                                            

            @if ($errors->has('stk4_comment'))
                <span class="help-block">
                    <strong>{{ $errors->first('stk4_comment') }}</strong>
                </span>
            @endif                                            
        </div>
        
    </div>
                
</div>   

<div class="panel panel-default">

    <div class="panel-body">
        <div class="col-md-12 form-group{{ $errors->has('st_comment') ? ' has-error' : '' }}">
            {{ Form::label('st_comment', 'Σχόλια - Παρατηρήσεις - Προτάσεις για τον ΣΤ Άξονα:') }}

            {{ Form::textarea('st_comment', null, ['rows' => 3, 'cols' => '50','class' => 'form-control', 'id' => 'st_comment', 'placeholder' => 'Προαιρετικά σχόλια για τον Άξονα.']) }}                                            

            @if ($errors->has('st_comment'))
                <span class="help-block">
                    <strong>{{ $errors->first('st_comment') }}</strong>
                </span>
            @endif                                            
        </div>
    </div>

</div>  
