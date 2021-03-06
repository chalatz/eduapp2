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
                @foreach($graders as $grader)
                    @if($grader->user->hasRole('grader_'.$grader_type) && $grader->specialty_id == $spec_id )
                        <?php $spec_count++; ?>
                    @endif
                @endforeach
                
                <?php $spec_count_100 = ($spec_count / $graders_total) * 100; ?>    
            
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
            <?php $spec_count = 0; $spec_count_100 = 0; ?>
        @endforeach
    </tbody>
</table>

<p class="lead stats-sum">Σύνολο: <strong>{{ $graders_total }}</strong></p>