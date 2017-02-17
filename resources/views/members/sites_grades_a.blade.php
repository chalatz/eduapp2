@extends('layouts.admin')

@section('content')

@inject('specialties', 'App\Http\Utilities\Specialty')
@inject('districts', 'App\Http\Utilities\District')
@inject('categories', 'App\Http\Utilities\Category')
@inject('countries', 'App\Http\Utilities\Country')
@inject('languages', 'App\Http\Utilities\Language')

<h1 class="bg-success" style="padding: .5em 1em; margin-bottom: 1.5em">Φάση Α - Βαθμολογίες Υποψήφιων Ιστότοπων</h1>

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
            <span class="label label-default" style="background: #b2beb5; color: #111; margin-right: 2em">
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
        <th>Κωδικός</th>
        <th>Επωνυμία</th>
        <th>Κατηγορία</th>
        @for($i = 1; $i <= $max_evals; $i++)
            <th>Αξιολ. {{$i}}</th>
        @endfor
        @for($i = 1; $i <= $max_evals; $i++)
            <th>Βαθμός {{$i}}</th>
        @endfor
        <th>Διαφορά</th>
        <th>Ανάθεση Α</th>
        <th>Ανάθεση Β</th>
    </tr>
  </thead>

  <tbody>
    @foreach($sites as $site)

      @if($site->user->hasRole('site'))

        <?php $evaluations = APp\Evaluation::where('site_id', $site->id)->get(); ?>
        <?php $eval_count = $evaluations->count(); ?>

        <tr>

            <td>i{{ sprintf("%03d", $site->id) }}</td>
            <td><a href="{{ $site->urk }}" target="_blank">{{ $site->title }}</a></td>
            <td>{{ $site->cat_id }}</td>
            <?php $i = 0; ?>
            @foreach($evaluations as $evaluation)
                <?php $grader = App\Grader::find($evaluation->grader_id) ?>
                @if($grader)
                    <td>{{ $grader->last_name }} {{ $grader->first_name }} ({{ $grader->code() }})</td>
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
            <?php $tg = array(); $j = 0; $tg[0] = ''; $tg[1] = ''; ?>                        
            @foreach($evaluations as $evaluation)
                <?php
                    $tg[$j] = $evaluation->total_grade;
                    $j = $j + 1;
                ?>
            @endforeach

            <?php $tg_rsorted = $tg; rsort($tg_rsorted); ?>

            @foreach($evaluations as $evaluation)
                <td @if($evaluation->beta_grade > 0 && $evaluation->gama_grade > 0 && $evaluation->delta_grade > 0 && $evaluation->epsilon_grade > 0 && $evaluation->st_grade > 0) style="color: green; font-weight: bold" @endif>
                    {{ $evaluation->total_grade }}
                </td>
            @endforeach

            @if($max_evals > $eval_count)
                <?php $remaining = $max_evals - $eval_count; ?>                 
                <?php for($i = 0; $i < $remaining; $i++): ?>
                    <td></td>
                <?php endfor; ?>
            @endif

            <?php
                //$bgc = '#fff';
                $dif = abs($tg_rsorted[0] - $tg_rsorted[1]);
                if( $dif > 20 && ( abs($tg_rsorted[0]) >= 20 || abs($tg_rsorted[1]) >= 20 ) ) {
                    $bgc = '#dd514c';
                }
                if($dif <= 20 && (abs($tg_rsorted[0]) >= 20 || abs($tg_rsorted[1]) >= 20)) {
                    $bgc = '#5eb95e';
                }
                if(abs($tg_rsorted[0]) == 0 && abs($tg_rsorted[1]) >= 20) {
                    $bgc = '#F37B1D';
                }
                if(abs($tg_rsorted[0]) >= 20 && abs($tg_rsorted[1]) <= 1) {
                    $bgc = '#F37B1D';
                }
                if(abs($tg_rsorted[0]) >= 20 && abs($tg_rsorted[1]) == 0) {
                    $bgc = '#b2beb5';
                }
                if(abs($tg_rsorted[0]) == 0 && abs($tg_rsorted[1]) == 0) {
                    $bgc = '#000';
                }
            ?>

            <td style="background: {{ $bgc }}; color: #fff; padding: .5em; text-align: center; font-weight: bold;">{{ $dif }}</td>

            <td>
                <a class="btn btn-primary" href="{{ route('assign_evaluation_site_a', [$site->id, 'sites_grades_a']) }}" role="button">Ανάθεση σε Αξ. Α</a>
            </td>

            <td>
                <a class="btn btn-primary" href="{{ route('assign_evaluation_site_a_grader_b_with_site', [$site->id, 'sites_grades_a']) }}" role="button">Ανάθεση σε Αξ. Β με Ιστότοπο</a>
            </td>

        </tr>

      @endif

    @endforeach
  </tbody>

  <tfoot>

    <tr>
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
        <th></th>
        <th></th>
    </tr>

  </tfoot>

</table>

@endsection
