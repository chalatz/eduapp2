<?php $criteria = App\GamaCriterion::all()->first(); ?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h2 class="panel-title">Γ: {!! $criteria->main_title !!}</h2>
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
                    <td style="font-size: 1.2em"><strong>Γκ1</strong></td>
                    <td><strong>{!! $criteria->gk1_title !!}</strong></td>
                    <td><strong>{!! $criteria->gk1_1_title !!}</strong></td>
                    <td><strong>{!! $criteria->gk1_2_title !!}</strong></td>
                    <td><strong>{!! $criteria->gk1_3_title !!}</strong></td>
                    <td><strong>{!! $criteria->gk1_4_title !!}</strong></td>
                    <td><strong>{!! $criteria->gk1_5_title !!}</strong></td>
                </tr>
            </tbody>
        </table>

        <div class="col-md-12 form-group{{ $errors->has('gk1') ? ' has-error' : '' }}">
            <label for="gk1" class="text-primary" style="font-size: 1.5em;">Γκ1 ({{ $criteria->gk1_weight }}%) *</label>
            {{ Form::select('gk1',[
                '' => 'Βαθμολογήστε (1 έως 5)',
                1 => '1',
                2 => '2',
                3 => '3',
                4 => '4',
                5 => '5',
            ], null, ['class' => 'form-control', 'id' => 'gk1', 'required']) }}

            @if ($errors->has('gk1'))
                <span class="help-block">
                    <strong>{{ $errors->first('gk1') }}</strong>
                </span>
            @endif                                            
        </div>

    </div>

    <div class="panel-footer clearfix">

        <div class="col-md-12 form-group{{ $errors->has('gk1_comment') ? ' has-error' : '' }}">
            {{ Form::label('gk1_comment', 'Σχόλια - Παρατηρήσεις - Προτάσεις για το Κριτήριο Γκ1:') }}

            {{ Form::textarea('gk1_comment', null, ['rows' => 3, 'cols' => '50','class' => 'form-control', 'id' => 'gk1_comment', 'placeholder' => 'Προαιρετικά σχόλια για το Κριτήριο.']) }}                                            

            @if ($errors->has('gk1_comment'))
                <span class="help-block">
                    <strong>{{ $errors->first('gk1_comment') }}</strong>
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
                    <td style="font-size: 1.2em"><strong>Γκ2</strong></td>
                    <td><strong>{!! $criteria->gk2_title !!}</strong></td>
                    <td><strong>{!! $criteria->gk2_1_title !!}</strong></td>
                    <td><strong>{!! $criteria->gk2_2_title !!}</strong></td>
                    <td><strong>{!! $criteria->gk2_3_title !!}</strong></td>
                    <td><strong>{!! $criteria->gk2_4_title !!}</strong></td>
                    <td><strong>{!! $criteria->gk2_5_title !!}</strong></td>
                </tr>
            </tbody>
        </table>

        <div class="col-md-12 form-group{{ $errors->has('gk2') ? ' has-error' : '' }}">
            <label for="gk2" class="text-primary" style="font-size: 1.5em;">Γκ2 ({{ $criteria->gk2_weight }}%) *</label>
            {{ Form::select('gk2',[
                '' => 'Βαθμολογήστε (1 έως 5)',
                1 => '1',
                2 => '2',
                3 => '3',
                4 => '4',
                5 => '5',
            ], null, ['class' => 'form-control', 'id' => 'gk2', 'required']) }}

            @if ($errors->has('gk2'))
                <span class="help-block">
                    <strong>{{ $errors->first('gk2') }}</strong>
                </span>
            @endif                                            
        </div>

    </div>

    <div class="panel-footer clearfix">

        <div class="col-md-12 form-group{{ $errors->has('gk2_comment') ? ' has-error' : '' }}">
            {{ Form::label('gk2_comment', 'Σχόλια - Παρατηρήσεις - Προτάσεις για το Κριτήριο Γκ2:') }}

            {{ Form::textarea('gk2_comment', null, ['rows' => 3, 'cols' => '50','class' => 'form-control', 'id' => 'gk2_comment', 'placeholder' => 'Προαιρετικά σχόλια για το Κριτήριο.']) }}                                            

            @if ($errors->has('gk2_comment'))
                <span class="help-block">
                    <strong>{{ $errors->first('gk2_comment') }}</strong>
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
                    <td style="font-size: 1.2em"><strong>Γκ3</strong></td>
                    <td><strong>{!! $criteria->gk3_title !!}</strong></td>
                    <td><strong>{!! $criteria->gk3_1_title !!}</strong></td>
                    <td><strong>{!! $criteria->gk3_2_title !!}</strong></td>
                    <td><strong>{!! $criteria->gk3_3_title !!}</strong></td>
                    <td><strong>{!! $criteria->gk3_4_title !!}</strong></td>
                    <td><strong>{!! $criteria->gk3_5_title !!}</strong></td>
                </tr>
            </tbody>
        </table>

        <div class="col-md-12 form-group{{ $errors->has('gk3') ? ' has-error' : '' }}">
            <label for="gk3" class="text-primary" style="font-size: 1.5em;">Γκ3 ({{ $criteria->gk3_weight }}%) *</label>
            {{ Form::select('gk3',[
                '' => 'Βαθμολογήστε (1 έως 5)',
                1 => '1',
                2 => '2',
                3 => '3',
                4 => '4',
                5 => '5',
            ], null, ['class' => 'form-control', 'id' => 'gk3', 'required']) }}

            @if ($errors->has('gk3'))
                <span class="help-block">
                    <strong>{{ $errors->first('gk3') }}</strong>
                </span>
            @endif                                            
        </div>

    </div>

    <div class="panel-footer clearfix">

        <div class="col-md-12 form-group{{ $errors->has('gk3_comment') ? ' has-error' : '' }}">
            {{ Form::label('gk3_comment', 'Σχόλια - Παρατηρήσεις - Προτάσεις για το Κριτήριο Γκ3:') }}

            {{ Form::textarea('gk3_comment', null, ['rows' => 3, 'cols' => '50','class' => 'form-control', 'id' => 'gk3_comment', 'placeholder' => 'Προαιρετικά σχόλια για το Κριτήριο.']) }}                                            

            @if ($errors->has('gk3_comment'))
                <span class="help-block">
                    <strong>{{ $errors->first('gk3_comment') }}</strong>
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
                    <td style="font-size: 1.2em"><strong>Γκ4</strong></td>
                    <td><strong>{!! $criteria->gk4_title !!}</strong></td>
                    <td><strong>{!! $criteria->gk4_1_title !!}</strong></td>
                    <td><strong>{!! $criteria->gk4_2_title !!}</strong></td>
                    <td><strong>{!! $criteria->gk4_3_title !!}</strong></td>
                    <td><strong>{!! $criteria->gk4_4_title !!}</strong></td>
                    <td><strong>{!! $criteria->gk4_5_title !!}</strong></td>
                </tr>
            </tbody>
        </table>

        <div class="col-md-12 form-group{{ $errors->has('gk4') ? ' has-error' : '' }}">
            <label for="gk4" class="text-primary" style="font-size: 1.5em;">Γκ4 ({{ $criteria->gk4_weight }}%) *</label>
            {{ Form::select('gk4',[
                '' => 'Βαθμολογήστε (1 έως 5)',
                1 => '1',
                2 => '2',
                3 => '3',
                4 => '4',
                5 => '5',
            ], null, ['class' => 'form-control', 'id' => 'gk4', 'required']) }}

            @if ($errors->has('gk4'))
                <span class="help-block">
                    <strong>{{ $errors->first('gk4') }}</strong>
                </span>
            @endif                                            
        </div>

    </div>

    <div class="panel-footer clearfix">

        <div class="col-md-12 form-group{{ $errors->has('gk4_comment') ? ' has-error' : '' }}">
            {{ Form::label('gk4_comment', 'Σχόλια - Παρατηρήσεις - Προτάσεις για το Κριτήριο Γκ4:') }}

            {{ Form::textarea('gk4_comment', null, ['rows' => 3, 'cols' => '50','class' => 'form-control', 'id' => 'gk4_comment', 'placeholder' => 'Προαιρετικά σχόλια για το Κριτήριο.']) }}                                            

            @if ($errors->has('gk4_comment'))
                <span class="help-block">
                    <strong>{{ $errors->first('gk4_comment') }}</strong>
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
                    <td style="font-size: 1.2em"><strong>Γκ5</strong></td>
                    <td><strong>{!! $criteria->gk5_title !!}</strong></td>
                    <td><strong>{!! $criteria->gk5_1_title !!}</strong></td>
                    <td><strong>{!! $criteria->gk5_2_title !!}</strong></td>
                    <td><strong>{!! $criteria->gk5_3_title !!}</strong></td>
                    <td><strong>{!! $criteria->gk5_4_title !!}</strong></td>
                    <td><strong>{!! $criteria->gk5_5_title !!}</strong></td>
                </tr>
            </tbody>
        </table>

        <div class="col-md-12 form-group{{ $errors->has('gk5') ? ' has-error' : '' }}">
            <label for="gk5" class="text-primary" style="font-size: 1.5em;">Γκ5 ({{ $criteria->gk5_weight }}%) *</label>
            {{ Form::select('gk5',[
                '' => 'Βαθμολογήστε (1 έως 5)',
                1 => '1',
                2 => '2',
                3 => '3',
                4 => '4',
                5 => '5',
            ], null, ['class' => 'form-control', 'id' => 'gk5', 'required']) }}

            @if ($errors->has('gk5'))
                <span class="help-block">
                    <strong>{{ $errors->first('gk5') }}</strong>
                </span>
            @endif                                            
        </div>

    </div>

    <div class="panel-footer clearfix">

        <div class="col-md-12 form-group{{ $errors->has('gk5_comment') ? ' has-error' : '' }}">
            {{ Form::label('gk5_comment', 'Σχόλια - Παρατηρήσεις - Προτάσεις για το Κριτήριο Γκ5:') }}

            {{ Form::textarea('gk5_comment', null, ['rows' => 3, 'cols' => '50','class' => 'form-control', 'id' => 'gk5_comment', 'placeholder' => 'Προαιρετικά σχόλια για το Κριτήριο.']) }}                                            

            @if ($errors->has('gk5_comment'))
                <span class="help-block">
                    <strong>{{ $errors->first('gk5_comment') }}</strong>
                </span>
            @endif                                            
        </div>
        
    </div>
                
</div>   

<div class="panel panel-default">

    <div class="panel-body">
        <div class="col-md-12 form-group{{ $errors->has('gama_comment') ? ' has-error' : '' }}">
            {{ Form::label('gama_comment', 'Σχόλια - Παρατηρήσεις - Προτάσεις για τον Γ Άξονα:') }}

            {{ Form::textarea('gama_comment', null, ['rows' => 3, 'cols' => '50','class' => 'form-control', 'id' => 'gama_comment', 'placeholder' => 'Προαιρετικά σχόλια για τον Άξονα.']) }}                                            

            @if ($errors->has('gama_comment'))
                <span class="help-block">
                    <strong>{{ $errors->first('gama_comment') }}</strong>
                </span>
            @endif                                            
        </div>
    </div>

</div>  
