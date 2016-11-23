@inject('districts', 'App\Http\Utilities\District')
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
            </tr>
            <?php $c++; ?>
        @endforeach
    </tbody>

</table>