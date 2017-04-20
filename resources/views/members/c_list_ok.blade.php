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
            <a href="{{ route('admin.c_list_ok', $cat) }}" type="button" class="btn btn-{{ $cat_color[$cat] }} btn-lg">
                Κατηγορία {{ $cat }}
            </a>
        </div>

    @endforeach

</div>

<h1 class="bg-{{ $cat_color[$cat_id] }}" style="padding: .5em 1em; margin-bottom: 1.5em">
    Φάση Γ - Αποτελέσματα Κατηγορίας {{ $cat_id }}
</h1>
<div class="container">
    <table id="c-list-ok-table" class="table table-striped admin-table">

    <thead>
        <tr>
            <th>Κωδικός</th>
            <th>Επωνυμία</th>
            <th>URL</th>
            <th>Φ.Α: Βαθμός 1</th>
            <th>Φ.Α: Βαθμός 2</th>
            <th>Φ.Β: Βαθμός 1</th>
            <th>Φ.Β: Βαθμός 2</th>
            <th>Φ.Γ: Βαθμός 1</th>
            <th>Φ.Γ: Βαθμός 2</th>            
            <th>Βαθμός</th>
        </tr>
    </thead>

    <tbody>
        @foreach($sites as $site)
            @if(in_array($site->id, $winners_b))

                <?php $total_grades_a = $site->total_grades('a') ?>
                <?php $total_grades_b = $site->total_grades('b') ?>
                <?php $total_grades_c = $site->total_grades('c') ?>

                <?php $the_grades = $site->final_grades() ?>

                <tr>

                    <td>
                        i{{ sprintf("%03d", $site->id) }}
                        <br><strong>max: {{ $the_grades[0] }}</strong>
                        <br><strong>min:{{ $the_grades[5] }}</strong>
                    </td>

                    <td>
                        {{ $site->title }}
                    </td>

                    <td>
                        <a href="{{ $site->url }}" target="_blank">{{ $site->url }}</a>
                    </td>

                    <td @if($total_grades_a[0] != $the_grades[0] && $total_grades_a[0] != $the_grades[5]) style="color: green; font-weight: bold; text-decoration: underline;" @endif>
                        {{ $total_grades_a[0] }}
                    </td>
                    <td @if($total_grades_a[1] != $the_grades[0] && $total_grades_a[0] != $the_grades[5]) style="color: green; font-weight: bold; text-decoration: underline;" @endif>
                        {{ $total_grades_a[1] }}
                    </td>

                    <td @if($total_grades_b[0] != $the_grades[0] && $total_grades_b[0] != $the_grades[5]) style="color: green; font-weight: bold; text-decoration: underline;" @endif>
                        {{ $total_grades_b[0] }}
                    </td>
                    <td @if($total_grades_b[1] != $the_grades[0] && $total_grades_b[1] != $the_grades[5]) style="color: green; font-weight: bold; text-decoration: underline;" @endif>
                        {{ $total_grades_b[1] }}
                    </td>

                    <td @if($total_grades_c[0] != $the_grades[0] && $total_grades_c[0] != $the_grades[5]) style="color: green; font-weight: bold; text-decoration: underline;" @endif>
                        {{ $total_grades_c[0] }}
                    </td>
                    <td @if($total_grades_c[1] != $the_grades[0] && $total_grades_c[1] != $the_grades[5]) style="color: green; font-weight: bold; text-decoration: underline;" @endif>
                        {{ $total_grades_c[1] }}
                    </td>                                        

                    <td>
                        <?php $the_grade = ($the_grades[1] + $the_grades[2] + $the_grades[3] + $the_grades[4]) / 4; ?>
                        {{ $the_grade }}
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
