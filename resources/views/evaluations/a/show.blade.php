@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">

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
                    
                    <div class="btn-group" role="group">
                        @if($evaluation->can_evaluate != 'no')
                            <a href="#" type="button" class="btn btn-default btn-lg">
                                <div><strong>{{$i}}η ανάθεση</strong></div>
                                <div>Ημερομηνία Ανάθεσης: <strong>{{ date('d/m/y', strtotime($evaluation->assigned_at)) }}</strong></div>
                                <div>Αξιολόγηση μέχρι: <strong>{{ date('d/m/y', strtotime($evaluation->assigned_until)) }}</strong></div>                            
                            </a>
                        @endif
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

                 <div class="panel panel-default">

                    <div class="panel-heading">
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
                                        <span class="site-total-grade-label">Βαθμολογία Ιστότοπου:</span>
                                        <span class="site-total-grade">{{ $evaluation->total_grade }}</span>
                                    @else
                                        <p class="lead">Πρέπει να βαθμολογήσετε όλους τους άξονες για να δείτε τη Βαθμολογία.</p>
                                    @endif
                                </div>

                                @if($evaluation->finalized != 'yes')

                                    <div class="panel panel-default" style="margin: 1em 0">
                                        <div class="panel-body">
                                            <p class="lead">Βαθμολογήσατε {{ $meter }} από 5 άξονες</p>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $percent }}%;">
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
                                                    <div class="info-block green white-font" style="width:{{ $evaluation->beta_grade }}%">Ο Βαθμός σας: <strong>{{ $evaluation->beta_grade }}%</strong></div>
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
                                                @if($evaluation->beta_grade > 0)
                                                    <div class="info-block green white-font" style="width:{{ $evaluation->gama_grade }}%">Ο Βαθμός σας: <strong>{{ $evaluation->gama_grade }}%</strong></div>
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
                                                @if($evaluation->beta_grade > 0)
                                                    <div class="info-block green white-font" style="width:{{ $evaluation->delta_grade }}%">Ο Βαθμός σας: <strong>{{ $evaluation->delta_grade }}%</strong></div>
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
                                                @if($evaluation->beta_grade > 0)
                                                    <div class="info-block green white-font" style="width:{{ $evaluation->epsilon_grade }}%">Ο Βαθμός σας: <strong>{{ $evaluation->epsilon_grade }}%</strong></div>
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
                                                @if($evaluation->beta_grade > 0)
                                                    <div class="info-block green white-font" style="width:{{ $evaluation->st_grade }}%">Ο Βαθμός σας: <strong>{{ $evaluation->st_grade }}%</strong></div>
                                                @else
                                                    <p class="lead text-danger">Δεν έχετε καταχωρήσει ακόμη Βαθμολογία</p>
                                                @endif
                                            </div>
                                            
                                        </div>
                                    </div>                                                                                                                                                                                    

                                @else
                                    <p>Έχετε υποβάλλει οριστική βαθμολογία για αυτόν τον Ιστότοπο.</p>
                                @endif

                                @if($evaluation->beta_grade > 0 && $evaluation->gama_grade > 0 && $evaluation->delta_grade > 0 && $evaluation->epsilon_grade > 0 && $evaluation->st_grade > 0)
                                    <div class="row">                                                   
                                        <p>Οριστική Υποβολή Βαθμολογίας</p>
                                        <div>Μόνον εφόσον είστε <strong>απολύτως σίγουρος</strong> πατήστε την Οριστική Υποβολή Βαθμολογίας.</div>                        
                                    </div>                                   
                                @endif                                

                            @else
                                @include('evaluations.is_educational_form')
                            @endif

                        @endif
                        @if($evaluation->can_evaluate == 'no')
                            <div class="flash-message flash-error">
                                Δεν έχετε αποδεχτεί να αξιολογήσετε αυτόν τον Ιστότοπο. Θα σας ανατεθεί άλλος Ιστότοπος.
                            </div>
                        @endif

                    </div>

                    @if($evaluation->can_evaluate == 'yes' && $evaluation->finalized != 'yes')
                        <div class="panel-footer">
                            @include('evaluations.site_comment_form')
                        </div>
                    @endif                    

                </div>

            @endforeach

            
        </div>
    </div>
</div>

@endsection
