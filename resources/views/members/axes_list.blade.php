@extends('layouts.admin')

@section('content')

<?php $cats = [0,1,2,3,4,6]; ?>

<?php $cat_color = [] ?>
<?php 
    $cat_color[0] = 'danger';
    $cat_color[1] = 'primary';
    $cat_color[2] = 'info';
    $cat_color[3] = 'success';
    $cat_color[4] = 'primary';
    $cat_color[5] = 'default';
    $cat_color[6] = 'info';
?>

<div class="btn-group btn-group-justified" role="group" aria-label="...">

    @foreach($cats as $cat)
        
        <div class="btn-group" role="group">
            <a href="{{ route('admin.axes_list', $cat) }}" type="button" class="btn btn-{{ $cat_color[$cat] }} btn-lg">
                @if($cat_id == 0)
                    Όλα
                @else
                    Κατηγορία {{ $cat }}
                @endif
            </a>
        </div>

    @endforeach

</div>

<h1 class="bg-{{ $cat_color[$cat_id] }}" style="padding: .5em 1em; margin-bottom: 1.5em">
    @if($cat_id == 0)
        Άξονες - Όλα
    @else
        Άξονες - Αποτελέσματα Κατηγορίας {{ $cat_id }}
    @endif
</h1>
<div class="container">
    <table id="axes-list-table" class="table table-striped admin-table">

    <thead>
        <tr>
            <th class="narrow-col">Κωδικός</th>
            <th class="narrow-col">Πέρασε στη Φάση</th>
            <th>Επωνυμία</th>
            <th>URL</th>
            <th class="narrow-col">Β Άξονας</th>
            <th class="narrow-col">Γ Άξονας</th>
            <th class="narrow-col">Δ Άξονας</th>
            <th class="narrow-col">Ε Άξονας</th>
            <th class="narrow-col">ΣΤ Άξονας</th>
        </tr>
    </thead>

    <tbody>
        @foreach($sites as $site)
            @if(!$site->disq() && $site->graded('a'))
                <tr>

                    <td>
                        i{{ sprintf("%03d", $site->id) }}
                    </td>

                    <td>
                        @if(in_array($site->id, $winners_b))
                            Γ
                        @elseif(in_array($site->id, $winners_a))
                            Β
                        @else
                            Α
                        @endif
                    </td>

                    <td>
                        {{ $site->title }}
                    </td>

                    <td>
                        <a href="{{ $site->url }}" target="_blank">{{ $site->url }}</a>
                    </td>

                    <td>{{ $site->axes()['beta'] }}</td>
                    <td>{{ $site->axes()['gama'] }}</td>
                    <td>{{ $site->axes()['delta'] }}</td>
                    <td>{{ $site->axes()['epsilon'] }}</td>
                    <td>{{ $site->axes()['st'] }}</td>                                                     

                </tr>
        
            @endif
        @endforeach
    </tbody>

    <tfoot>

        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>

    </tfoot>

    </table>

</div>

@endsection
