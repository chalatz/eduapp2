<h2>Περιφέρειες</h2>

<table id="specs-stats-table" class="table table-striped stats-table specs-stats-table">
    <thead>
        <tr>
            <th>Περιφέρεια</th>
            <th>Πλήθος Αξ. {{ strtoupper($grader_type) }}.</th>
            <th>Πλήθος Αξ. {{ strtoupper($grader_type) }}. %</th>
        </tr>
    </thead>
    
    <tbody>
        @foreach($districts as $district_id => $district_name)
            @if($district_id != '')
                <?php $districts_count = $graders->where('district_id', $district_id)->count(); ?>
                <?php $districts_count_100 = ($districts_count / $graders_total) * 100; ?>    
            
                @if($districts_count > 0)
                    <tr class="stats-districts-row" id="stats-districts-row-{{$district_id}}">
                        <td>
                            <a href="{{ route('get_graders_stats', [$grader_type, 'districts', $district_id]) }}" data-remote="false" data-toggle="modal" data-target="#graders-modal" id="ajax-btn-districts">
                                {{ $district_name }}
                            </a>                            
                        </td>
                        <td>{{ $districts_count }} </td>
                        <td>{{ round($districts_count_100, 2) }}</td>
                    </tr>
                @endif
            
            @endif
        @endforeach
    </tbody>
</table>

<p class="lead stats-sum">Σύνολο: <strong>{{ $graders_total }}</strong></p>