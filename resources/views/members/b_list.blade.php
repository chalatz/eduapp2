@extends('layouts.admin')

@section('content')

<?php $cats = [1,2,3,4,6]; ?>

<?php $cat_color = [] ?>
<?php 
    $cat_color[0] = 'default';
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
            <a href="{{ route('admin.b_list', $cat) }}" type="button" class="btn btn-{{ $cat_color[$cat] }} btn-lg">
                Κατηγορία {{ $cat }}
            </a>
        </div>

    @endforeach

</div>

<h1 class="bg-{{ $cat_color[$cat_id] }}" style="padding: .5em 1em; margin-bottom: 1.5em">Φάση Β - Αποτελέσματα Κατηγορίας {{ $cat_id }}</h1>
<div class="container">
    <table id="b-list-table" class="table table-striped admin-table">

    <thead>
        <tr>
            <th>Κωδικός</th>
            <th>Επωνυμία</th>
            <th>URL</th>
            <th>Βαθμός 1</th>
            <th>Βαθμός 2</th>
            <th>Μ.Ο</th>
        </tr>
    </thead>

    <tbody>
        @foreach($sites as $site)
            @if(in_array($site->id, $winners_a))
                <tr>

                    <td>
                        i{{ sprintf("%03d", $site->id) }}
                        @if(!$site->graded('b'))
                            <p>Δεν βαθμολογήθηκε</p>
                        @endif
                    </td>

                    <td>
                        {{ $site->title }}
                    </td>

                    <td>
                        <a href="{{ $site->url }}" target="_blank">{{ $site->url }}</a>
                    </td>

                    <?php $total_grades = $site->total_grades('b') ?>

                    <td>
                        {{ $total_grades[0] }}
                    </td>

                    <td>
                        {{ $total_grades[1] }}
                    </td>

                    <td class="td-mo @if(abs($total_grades[0] - $total_grades[1]) > 20) bg-danger @endif ">
                        <?php $mo = ($total_grades[0] + $total_grades[1]) / 2; ?>
                        {{ $mo }}
                    </td>                

                </tr>
        
            @endif
        @endforeach
    </tbody>

    <tfoot>

        <tr>

        </tr>

    </tfoot>

    </table>

</div>

@endsection
