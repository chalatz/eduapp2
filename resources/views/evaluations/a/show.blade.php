@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">

            @if($evaluations->count() > 0)

                <?php $site_index = 0; $i =0; $evaluations_count = $evaluations->count(); $sites_meter = 0; ?>

                <h1>Οι Αναθέσεις μου</h1>

                <h3>{{ $evaluations_count }} Αναθέσεις</h3>

                <div class="btn-group btn-group-justified" role="group" aria-label="...">
                    @foreach($evaluations as $evaluation)
                        <?php
                            $i++;
                            if($evaluation->beta_grade > 0 && $evaluation->gama_grade > 0 && $evaluation->delta_grade > 0 && $evaluation->epsilon_grade > 0 && $evaluation->st_grade > 0){
                                $sites_meter++;
                            }
                        ?>
                        <?php $color_btn = $colors[$i - 1] ?>
                        <div class="btn-group" role="group">                
                            <a href="#evaluation-{{ $i }}" type="button" class="btn btn-{{ $color_btn }} btn-lg">
                                <div><strong>{{$i}}η ανάθεση</strong></div>
                                @if($evaluation->assigned_at)
                                    <div>Ημερομηνία Ανάθεσης: <strong>{{ date('d/m/y', strtotime($evaluation->assigned_at)) }}</strong></div>
                                    <div>Αξιολόγηση μέχρι: <strong>{{ date('d/m/y', strtotime($evaluation->assigned_until)) }}</strong></div>
                                @else
                                    <div><strong>-</strong></div>
                                    <div><strong>-</strong></div>
                                @endif
                            </a>
                        </div>                            
                    @endforeach
                </div>

                <?php $sites_percent = $sites_meter * 100 / $evaluations_count; ?>
                
                <div class="panel panel-default" style="margin: 1em 0">
                    <div class="panel-body">
                        <p class="lead">Βαθμολογήσατε {{ $sites_meter }} από {{ $evaluations_count }} Ιστότοπους</p>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{ $sites_percent }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $sites_percent }}%;">
                                {{ $sites_percent }}%
                            </div>
                        </div>
                    </div>
                </div>

                @foreach($evaluations as $evaluation)

                    <?php
                        $meter = 0;
                        if($evaluation->beta_grade > 0){ $meter++; }
                        if($evaluation->gama_grade > 0){ $meter++; }
                        if($evaluation->delta_grade > 0){ $meter++; }
                        if($evaluation->epsilon_grade > 0){ $meter++; }
                        if($evaluation->st_grade > 0){ $meter++; }
                        $percent = $meter * 100 / 5;                        
                    ?>

                    <?php $site_index++ ?>

                    <?php $color_panel = $colors[$site_index - 1] ?>
                    <div class="panel panel-{{ $color_panel }}">

                        <div class="panel-heading" id="evaluation-{{ $site_index }}">
                            <div style="font-size: 1.7em;" class="panel-title">
                                <span class="label label-default">{{ $site_index }}η</span> Ανάθεση
                            </div>
                        </div>

                        <div class="panel-body">

                            <strong>Ιστότοπος:</strong><br>
                            <a href="{{ App\Site::find($evaluation->site_id)->url }}" target="_blank" style="font-weight: bold; font-size: 1.3em; margin-bottom: 2em; display: block;">
                                {{ App\Site::find($evaluation->site_id)->title }} <i class="fa fa-external-link" aria-hidden="true"></i>
                            </a>
                        
                            @if(App\Site::find($evaluation->site_id)->restricted_access == 'yes')
                                <div class="bg-info" style="padding: 0 .5em">
                                    <hr>
                                    <h4 style="text-decoration: underline">Ο Ιστότοπος έχει δηλώσει ότι έχει περιορισμένη πρόσβαση και ως πληροφορίες εισόδου έχει δώσει τα εξής:</h4>
                                    <p><em>{!! nl2br(e(App\Site::find($evaluation->site_id)->restricted_access_details)) !!}</em></p>
                                    <hr>
                                </div>
                            @endif

                            @if($evaluation->can_evaluate == 'na')
                                @include('evaluations.can_evaluate_form')
                            @endif

                            @if($evaluation->can_evaluate == 'yes')
                                @if($evaluation->is_educational == 'yes')
                                    
                                    <div class="site-total-grade-wrapper">
                                        @if($evaluation->beta_grade > 0 && $evaluation->gama_grade > 0 && $evaluation->delta_grade > 0 && $evaluation->epsilon_grade > 0 && $evaluation->st_grade > 0)
                                            <blockquote>
                                                <p style="font-size: 1.4em;">Βαθμολογία Ιστότοπου: <span class="label label-success">{{ $evaluation->total_grade }}%</span></p>
                                            </blockquote>
                                        @else
                                            <p class="lead">Πρέπει να βαθμολογήσετε όλους τους άξονες για να δείτε τη Βαθμολογία.</p>
                                        @endif
                                    </div>

                                    @if($evaluation->finalized != 'yes')

                                        <div class="panel panel-default" style="margin: 1em 0">
                                            <div class="panel-body">
                                                <p class="lead">Βαθμολογήσατε {{ $meter }} από 5 άξονες</p>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $percent }}%;">
                                                        {{ $percent }}%
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel panel-default" style="margin: 1em 0">
                                            <div class="panel-body">

                                                <a href="{{ route('evaluate_a_edit', [Auth::user()->id, 'beta', $grader->id, $evaluation->site_id]) }}" type="button" class="btn btn-info btn-block btn-lg">
                                                    Β Άξονας (Ταυτότητα - Ενημέρωση)
                                                </a>
                                                <div class="criteron-check">
                                                    @if($evaluation->beta_grade > 0)
                                                        <div>Ο Βαθμός σας: <strong>{{ $evaluation->beta_grade }}%</strong></div>
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="{{ $evaluation->beta_grade }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $evaluation->beta_grade }}%;">
                                                                {{ $evaluation->beta_grade }}%
                                                            </div>
                                                        </div>
                                                    @else
                                                        <p class="lead text-danger">Δεν έχετε καταχωρήσει ακόμη Βαθμολογία</p>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>

                                        <div class="panel panel-default" style="margin: 1em 0">
                                            <div class="panel-body">
                                                <a href="{{ route('evaluate_a_edit', [Auth::user()->id, 'gama', $grader->id, $evaluation->site_id]) }}" type="button" class="btn btn-info btn-block btn-lg">
                                                    Γ Άξονας (Περιεχόμενο)
                                                </a>
                                                <div class="criteron-check">
                                                    @if($evaluation->gama_grade > 0)
                                                        <div>Ο Βαθμός σας: <strong>{{ $evaluation->gama_grade }}%</strong></div>
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="{{ $evaluation->gama_grade }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $evaluation->gama_grade }}%;">
                                                                {{ $evaluation->gama_grade }}%
                                                            </div>
                                                        </div>
                                                    @else
                                                        <p class="lead text-danger">Δεν έχετε καταχωρήσει ακόμη Βαθμολογία</p>
                                                    @endif
                                                </div>
                                                
                                            </div>
                                        </div>

                                        <div class="panel panel-default" style="margin: 1em 0">
                                            <div class="panel-body">

                                                <a href="{{ route('evaluate_a_edit', [Auth::user()->id, 'delta', $grader->id, $evaluation->site_id]) }}" type="button" class="btn btn-info btn-block btn-lg">
                                                    Δ Άξονας (Διεπαφή - Αισθητική)
                                                </a>
                                                <div class="criteron-check">
                                                    @if($evaluation->delta_grade > 0)
                                                        <div>Ο Βαθμός σας: <strong>{{ $evaluation->delta_grade }}%</strong></div>
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="{{ $evaluation->delta_grade }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $evaluation->delta_grade }}%;">
                                                                {{ $evaluation->delta_grade }}%
                                                            </div>
                                                        </div>
                                                    @else
                                                        <p class="lead text-danger">Δεν έχετε καταχωρήσει ακόμη Βαθμολογία</p>
                                                    @endif
                                                </div>
                                                
                                            </div>
                                        </div>

                                        <div class="panel panel-default" style="margin: 1em 0">
                                            <div class="panel-body">

                                                <a href="{{ route('evaluate_a_edit', [Auth::user()->id, 'epsilon', $grader->id, $evaluation->site_id]) }}" type="button" class="btn btn-info btn-block btn-lg">
                                                    Ε Άξονας (Προσωπικά Δεδομένα)
                                                </a>                                            
                                                <div class="criteron-check">
                                                    @if($evaluation->epsilon_grade > 0)
                                                        <div>Ο Βαθμός σας: <strong>{{ $evaluation->epsilon_grade }}%</strong></div>
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="{{ $evaluation->epsilon_grade }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $evaluation->epsilon_grade }}%;">
                                                                {{ $evaluation->epsilon_grade }}%
                                                            </div>
                                                        </div>
                                                    @else
                                                        <p class="lead text-danger">Δεν έχετε καταχωρήσει ακόμη Βαθμολογία</p>
                                                    @endif
                                                </div>
                                                
                                            </div>
                                        </div>

                                        <div class="panel panel-default" style="margin: 1em 0">
                                            <div class="panel-body">
                                                <a href="{{ route('evaluate_a_edit', [Auth::user()->id, 'st', $grader->id, $evaluation->site_id]) }}" type="button" class="btn btn-info btn-block btn-lg">
                                                    ΣΤ Άξονας (Αλληλεπίδραση)
                                                </a> 
                                                <div class="criteron-check">
                                                    @if($evaluation->st_grade > 0)
                                                        <div>Ο Βαθμός σας: <strong>{{ $evaluation->st_grade }}%</strong></div>
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="{{ $evaluation->st_grade }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $evaluation->st_grade }}%;">
                                                                {{ $evaluation->st_grade }}%
                                                            </div>
                                                        </div>
                                                    @else
                                                        <p class="lead text-danger">Δεν έχετε καταχωρήσει ακόμη Βαθμολογία</p>
                                                    @endif
                                                </div>
                                                
                                            </div>
                                        </div>

                                        @if($evaluation->beta_grade > 0 && $evaluation->gama_grade > 0 && $evaluation->delta_grade > 0 && $evaluation->epsilon_grade > 0 && $evaluation->st_grade > 0)
                                            <a href="{{ route('evaluation_a.finalize', $evaluation->id) }}" type="button" class="btn btn-success btn-block btn-lg" onclick="return confirm('Εϊστε σίγουρος;');">
                                                <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Οριστική Υποβολή Βαθμολογίας
                                            </a>
                                            <p class="help-block">
                                                Μόνον εφόσον είστε <strong>απολύτως σίγουρος</strong> πατήστε την Οριστική Υποβολή Βαθμολογίας.
                                            </p>                                 
                                        @endif                                                                                                                                                                                    

                                    @else
                                        <p class="lead bg-success" style="padding: 1em;">Έχετε υποβάλλει οριστική βαθμολογία για αυτόν τον Ιστότοπο, στις <span style="text-decoration: underline">{{ date('d/m/y', strtotime($evaluation->finalized_at)) }}</span> </p>
                                    @endif
                                                                    

                                @else
                                    @include('evaluations.is_educational_form')
                                @endif

                            @endif

                        </div>

                        @if($evaluation->can_evaluate == 'yes' && $evaluation->finalized != 'yes')
                            <div class="panel-footer">
                                @include('evaluations.site_comment_form')
                            </div>
                        @endif                    

                    </div>

                @endforeach

            @else
                <div class="alert alert-danger" role="alert">
                    <p class="lead">Αυτή τη στιγμή δεν έχετε Αναθέσεις.</p>
                    <p class="lead">Θα σας ανατεθούν σύντομα νέοι Ιστότοποι.</p>
                </div>
            @endif

            
        </div>
    </div>
</div>

@endsection
