@inject('districts', 'App\Http\Utilities\District')
@inject('counties', 'App\Http\Utilities\County')
@inject('categories', 'App\Http\Utilities\Category')

@if($type == 'categories')
    <h3>{{ $categories::all()[$id] }}</h3>
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
                <th>Τίτλος</th>
                <th>
                    @if($type == 'categories') Περ. -- @endif
                    Περ. Ενότητα
                </th>
            </tr>
        </thead>
        @foreach($sites as $site)
            <tr>
                <td>
                    {{ $c }}
                </td>
                <td>
                    <a href="{{ $site->url }}" target="_blank">
                        {{ $site->title }}
                    </a>
                </td>
                <td>
                    @if($type == 'categories') {{ $districts::all()[$site->district_id] }} -- @endif
                    {{ $counties::flat_counties()[$site->county_id] }}
                </td>
            </tr>
            <?php $c++; ?>
        @endforeach
    </tbody>

</table>