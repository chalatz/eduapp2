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

                    </div>


                    <div class="panel-footer">Panel footer</div>

                </div>

            @endforeach

            
        </div>
    </div>
</div>

@endsection
