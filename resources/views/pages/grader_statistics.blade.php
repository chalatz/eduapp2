@extends('layouts.statistics')

@section('content')
<div class="container">
    
    <?php
        $spec_count = 0; // spec: specialty
        $districts_count = 0;
    ?>

    <h1><i class="fa fa-bar-chart" aria-hidden="true"></i> Αξιολογητές {{ strtoupper($grader_type) }}</h1>
    <hr>

    <h2>Ειδικότητες</h2>

<table id="specs-stats-table" class="table table-striped stats-table specs-stats-table">
    <thead>
        <tr>
            <th>Ειδικότητα</th>
            <th>Πλήθος Αξ. {{ strtoupper($grader_type) }}.</th>
            <th>Πλήθος Αξ. {{ strtoupper($grader_type) }}. %</th>
        </tr>
    </thead>
    
    <tbody>
        @foreach($specs as $spec_id => $spec_name)
            @if($spec_id != '')

                <?php $spec_count = $graders->where('specialty_id', $spec_id)->count(); ?>
                <?php $spec_count_100 = ($spec_count / $graders_total) * 100; ?>    
            
                {{ $spec_id }}

                @if($spec_count > 0)
                    <tr class="stats-specs-row" id="stats-specs-row-{{$spec_id}}">
                        <td>
                            <a href="{{ route('get_graders_stats', [$grader_type, 'specialties', $spec_id]) }}" data-remote="false" data-toggle="modal" data-target="#graders-modal" id="ajax-btn-specialties">
                                {{ $spec_name }}
                            </a>                            
                        </td>
                        <td>{{ $spec_count }} </td>
                        <td>{{ round($spec_count_100, 2) }}</td>
                    </tr>
                @endif
            
            @endif
        @endforeach
    </tbody>
</table>

<p class="lead stats-sum">Σύνολο: <strong>{{ $graders_total }}</strong></p>

    @include('partials.stats.grader_districts')
   
    @include('partials.graders_modal')

</div>
@endsection
