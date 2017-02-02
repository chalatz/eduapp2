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
                        <a href="#" type="button" class="btn btn-default btn-lg">
                            @if($evaluation->can_evaluate == 'yes')
                                <div><strong>{{$i}}η ανάθεση</strong></div>
                                <div>Ημερομηνία Ανάθεσης: <strong>{{ date('d/m/y', strtotime($evaluation->assigned_at)) }}</strong></div>
                                <div>Αξιολόγηση μέχρι: <strong>{{ date('d/m/y', strtotime($evaluation->assigned_until)) }}</strong></div>
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


            
        </div>
    </div>
</div>

@endsection
