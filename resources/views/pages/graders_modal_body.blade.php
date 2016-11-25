@inject('districts', 'App\Http\Utilities\District')
@inject('counties', 'App\Http\Utilities\County')
@inject('categories', 'App\Http\Utilities\Category')
@inject('specialties', 'App\Http\Utilities\Specialty')

@if($type == 'specialties')
    <h3>{{ $specialties::all()[$id] }}</h3>
@endif

@if($type == 'districts')
    <h3>{{ $districts::all()[$id] }}</h3>
@endif

<?php $c = 1; ?>

<table class="table table-striped">

    <tbody>
        <thead>
            <tr>
                <th>α/α</th>
                <th>Ονοματεπώνυμο</th>
                <th>
                    @if($type == 'specialties') Περ. -- @endif
                    Περ. Ενότητα
                </th>
            </tr>
        </thead>
        @foreach($graders as $grader)
            @if($grader->user->hasRole('grader_a'))
                <tr>
                    <td>
                        {{ $c }}
                    </td>
                    <td>
                        {{ $grader->last_name }} {{ $grader->first_name }}                    
                    </td>
                    <td>
                        @if($type == 'specialties') {{ $districts::all()[$grader->district_id] }} -- @endif
                        {{ $counties::flat_counties()[$grader->county_id] }}
                    </td>
                </tr>
                <?php $c++; ?>
            @endif
        @endforeach
    </tbody>

</table>