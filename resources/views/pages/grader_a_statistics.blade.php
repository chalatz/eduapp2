@extends('layouts.statistics')

@section('content')
<div class="container">
    
    <?php
        $spec_count = 0; // spec: specialty
        
    ?>

    <h1><i class="fa fa-bar-chart" aria-hidden="true"></i> Αξιολογητές Α</h1>
    <hr>

    <h2>Ειδικότητες</h2>
    <table id="specs-stats-table" class="table table-striped stats-table specs-stats-table">
        <thead>
            <tr>
                <th>Ειδικότητα</th>
                <th>Πλήθος Αξ. Α.</th>
                <th>Πλήθος Αξ. Α. %</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach($specs as $spec_id => $spec_name)
                @if($spec_id != '')
                    <?php $spec_count = $graders->where('specialty_id', $spec_id)->count(); ?>
                    <?php $spec_count_100 = ($spec_count / $graders_total) * 100; ?>    
                
                    @if($spec_count > 0)
                        <tr class="stats-cats-row" id="stats-specs-row-{{$spec_id}}">
                            <td>
                                {{ $spec_name }}                            
                            </td>
                            <td>{{ $spec_count }} </td>
                            <td>{{ round($spec_count_100, 2) }}</td>
                        </tr>
                    @endif
                
                @endif
            @endforeach
        </tbody>
    </table>
   

</div>
@endsection
