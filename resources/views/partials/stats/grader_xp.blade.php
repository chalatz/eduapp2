<h2>Εμπειρία</h2>

<table id="specs-stats-table" class="table table-striped stats-table specs-stats-table">
    <thead>
        <tr>
            <th>Δομή</th>
            <th>Πλήθος Αξ. {{ strtoupper($grader_type) }}.</th>
            <th>Πλήθος Αξ. {{ strtoupper($grader_type) }}. %</th>
        </tr>
    </thead>
    
    <tbody>
        @foreach($xp as $xp_id => $xp_name)
            @if($xp_id != '')
                @foreach($graders as $grader)
                    @if($grader->user->hasRole('grader_'.$grader_type) && str_contains($grader->teaching_xp, $xp_id))
                        <?php $xp_count++; ?>
                    @endif
                @endforeach
                
                <?php $xp_count_100 = ($xp_count / $graders_total) * 100; ?>    
            
                @if($xp_count > 0)
                    <tr class="stats-specs-row" id="stats-specs-row-{{$xp_id}}">
                        <td>
                            <a href="{{ route('get_graders_stats', [$grader_type, 'xp', $xp_id]) }}" data-remote="false" data-toggle="modal" data-target="#graders-modal" id="ajax-btn-xp">
                                {{ $xp_name }}
                            </a>                            
                        </td>
                        <td>{{ $xp_count }} </td>
                        <td>{{ round($xp_count_100, 2) }}</td>
                    </tr>
                @endif
            
            @endif
            <?php $xp_count = 0; $xp_count_100 = 0; ?>
        @endforeach
    </tbody>
</table>