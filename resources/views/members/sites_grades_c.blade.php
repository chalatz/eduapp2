@extends('layouts.admin')

@section('content')

@inject('specialties', 'App\Http\Utilities\Specialty')
@inject('districts', 'App\Http\Utilities\District')
@inject('categories', 'App\Http\Utilities\Category')
@inject('countries', 'App\Http\Utilities\Country')
@inject('languages', 'App\Http\Utilities\Language')

<h1 class="bg-success" style="padding: .5em 1em; margin-bottom: 1.5em">Φάση Γ - Βαθμολογίες Υποψήφιων Ιστότοπων</h1>

<div style="padding: .5em 1em; margin-bottom: 1.5em">
    <div class="row">
        <div class="col-md-12" style="font-size: 1.5em">
            <span class="label label-default" style="background: green; color: #fff; margin-right: 2em">
                Διαφορά μικρότερη από 20%
            </span>
            <span class="label label-default" style="background: red; color: #fff; margin-right: 2em">
                Διαφορά μεγαλύτερη από 20%
            </span>
            <span class="label label-default" style="background: orange; color: #111; margin-right: 2em">
                Έχει βαθμολογήσει μόνο ο ένας
            </span>
            <span class="label label-default" style="background: black; color: #fff; margin-right: 2em">
                Δεν έχει βαθμολογήσει κανένας
            </span>
            <span class="label label-default" style="background: lightgray; color: #111; margin-right: 2em">
                Έχει βαθμολογήσει μόνο ο ένας, χωρίς ο άλλος να ασχοληθεί
            </span>                                           
        </div>
    </div>
</div>

<div style="padding: .5em 1em; margin-bottom: 1.5em; font-size: 1.5em; background: #eee;">
    <p class="lead">Βαθμός:</p>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <strong>-1</strong>: Δεν έχει αποδεχτεί, <strong>1</strong>: Έχει κρίνει τον ιστότοπο μη εκπαιδευτικό, <strong>2</strong>: Έχει αποδεχτεί αλλά δεν έχει προχωρήσει
</div>

<table id="sitesgrades-a-table" class="table table-striped admin-table">

  <thead>
    <tr>
        @if(Auth::user()->hasRole('admin'))
            <th class="narrow-col">
                Μεταμφίεση
            </th>
        @endif
        <th class="narrow-col">Κωδικός</th>
        <th>Επωνυμία</th>
        <th class="narrow-col">Κατηγορία</th>
        @for($i = 1; $i <= $max_evals; $i++)
            <th>Αξιολ. {{$i}}</th>
        @endfor
        @for($i = 1; $i <= $max_evals; $i++)
            <th class="narrow-col">Βαθμός {{$i}}</th>
        @endfor       
        <th class="narrow-col">Διαφορά</th>
        @for($i = 1; $i <= $max_evals; $i++)
            <th>Παρατηρήσεις {{$i}}</th>
        @endfor

        <th>Ανάθεση Γ</th>
               
    </tr>
  </thead>

  <tbody>
    @foreach($sites as $site)

      @if($site->user->hasRole('site') && in_array($site->id, $winners_b))

        <?php $evaluations = App\Evaluation_c::where('site_id', $site->id)->get(); ?>
        <?php $eval_count = $evaluations->count(); ?>

        <tr>

            @if(Auth::user()->hasRole('admin'))
                <td>
                    <a href="{{ route('admin.masquerade', $site->user->id) }}" target="_blank">Μεταμφίεση</a>
                </td>
            @endif

            <td>
                i{{ sprintf("%03d", $site->id) }}<br>
            </td>

            <td><a href="{{ $site->url }}" target="_blank">{{ $site->title }}</a></td>

            <td>{{ $site->cat_id }}</td>

            <?php $i = 0; ?>
            @foreach($evaluations as $evaluation)
                <?php $grader = App\Grader::find($evaluation->grader_id) ?>
                @if($grader)
                    <td>
                        {{ $grader->last_name }} {{ $grader->first_name }} ({{ $grader->code() }})
                        <br>
                        προθεσμία: <strong>{{ date('d/m/Y', strtotime($evaluation->assigned_until)) }}</strong>
                        @if(Auth::user()->hasRole('admin'))              
                            <br>
                            <a href="{{ route('admin.masquerade', $grader->user->id) }}" target="_blank">Μεταμφίεση</a>
                        @endif
                    </td>
                @else
                    <td>--</td>
                @endif
            @endforeach
            @if($max_evals > $eval_count)
                <?php $remaining = $max_evals - $eval_count; ?>                 
                <?php for($i = 0; $i < $remaining; $i++): ?>
                    <td></td>
                <?php endfor; ?>
            @endif

            <?php // tg stands for total grades ?>
            <?php 
                $tg = array(); $j = 0; $tg[0] = ''; $tg[1] = ''; 
            ?>
            @foreach($evaluations as $evaluation)
                <?php
                    $tg[$j] = $evaluation->total_grade;
                    $evs[$j] = $evaluation;
                    $j = $j + 1;
                ?>
            @endforeach

            <?php
                $tg_rsorted = $tg;
                rsort($tg_rsorted);
            ?>

            @foreach($evaluations as $evaluation)
                <td @if($evaluation->complete()) style="color: green; font-weight: bold" @endif>
                    @if($evaluation->complete() && !Auth::user()->hasRole('member'))
                        μην κοιτάς
                    @endif
                    @if(!$evaluation->complete() || Auth::user()->hasRole('member'))
                        {{ $evaluation->total_grade }}
                    @endif
                </td>
            @endforeach

            @if($max_evals > $eval_count)
                <?php $remaining = $max_evals - $eval_count; ?>                 
                <?php for($i = 0; $i < $remaining; $i++): ?>
                    <td></td>
                <?php endfor; ?>
            @endif

            <?php
                $bgc = '#eee';
                $dif = abs($tg_rsorted[0] - $tg_rsorted[1]);
                $status = '--';                                                                              
                
                if( $dif > 20 && ( abs($tg_rsorted[0]) >= 20 && abs($tg_rsorted[1]) >= 20 ) ) {
                    $bgc = '#dd514c';
                    $status = 'both_graded_gt_20pc';
                }

                if($dif <= 20 && (abs($tg_rsorted[0]) >= 20 && abs($tg_rsorted[1]) >= 20)) {
                    $bgc = '#5eb95e';
                    $status = 'both_graded';
                }
                
                if(abs($tg_rsorted[0]) == 0 && abs($tg_rsorted[1]) >= 20) {
                    $bgc = '#F37B1D';
                    $status = '--';
                }
                if(abs($tg_rsorted[0]) >= 20 && abs($tg_rsorted[1]) <= 1) {
                    $bgc = '#F37B1D';
                    $status = '--';
                }
                if(abs($tg_rsorted[0]) >= 20 && abs($tg_rsorted[1]) == 0) {
                    $bgc = '#b2beb5';
                    $status = '--';
                }
                if(abs($tg_rsorted[0]) >= 20 && abs($tg_rsorted[1]) == 2) {
                    $bgc = '#b2beb5';
                    $status = '--';
                }
                if(abs($tg_rsorted[0]) == 0 && abs($tg_rsorted[1]) == 0) {
                    $bgc = '#000';
                    $status = '--';
                }
            ?>

            <td data-status="{{ $status }}" style="background: {{ $bgc }}; color: #fff; padding: .5em; text-align: center; font-weight: bold;">
                 @if($status == 'both_graded')
                    {{ $dif }}<br>
                    ok
                @endif
                @if($status == 'both_graded_gt_20pc')                    
                    {{ $dif }}<br>
                    &gt; 20%
                @endif
                @if($status == '--')
                    --
                @endif
            </td>

            @foreach($evaluations as $evaluation)
                <td>
                    {{ $evaluation->grades_c() }}
                    @if($evaluation->can_evaluate == 'no')
                        <p>
                            
                            <p class="toggle-me">
                                <br>------------------<br>
                                {!! $evaluation->why_cannot_evaluate !!}
                            </p>
                            <button type="button" class="btn btn-info btn-block toggle-it">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Περισσότερα...
                            </button>
                        </p>
                        
                    @endif
                    @if($evaluation->is_educational == 'no')
                        <p>
                            <p class="toggle-me">
                                <br>------------------<br>
                                {!! $evaluation->why_not_educational !!}
                            </p>
                            <button type="button" class="btn btn-info btn-block toggle-it">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Περισσότερα...
                            </button>
                        </p>
                    @endif                    
                </td>
            @endforeach

            @if($max_evals > $eval_count)
                <?php $remaining = $max_evals - $eval_count; ?>                 
                <?php for($i = 0; $i < $remaining; $i++): ?>
                    <td></td>
                <?php endfor; ?>
            @endif

            <td>
                <a class="btn btn-primary" href="{{ route('assign_evaluation_site_c_grader_b', [$site->id, 'sites_grades_c']) }}" role="button">Ανάθεση σε Αξ. Β</a>
            </td>                        

        </tr>

      @endif

    @endforeach
  </tbody>

  <tfoot>

    <tr>
        @if(Auth::user()->hasRole('admin'))
            <th></th>
        @endif
        <th></th>
        <th></th>
        <th></th>
        @for($i = 1; $i <= $max_evals; $i++)
            <th></th>
        @endfor
        @for($i = 1; $i <= $max_evals; $i++)
            <th></th>
        @endfor
        <th></th>
        @for($i = 1; $i <= $max_evals; $i++)
            <th></th>
        @endfor
        <th></th>       
    </tr>

  </tfoot>

</table>

@endsection
