@extends('layouts.statistics')

@section('content')
<div class="container">

    <script>
        var the_dates = [],
            the_site_counts = [];
    </script>

    <h1>Υποβολές Υποψηφιότητων</h1>
    <hr>

    <table id="submissions-stats-table" class="table table-striped submissions-stats-table">

        <thead>
            <tr>
                <th>Ημερομηνία</th>
                <th>Πλήθος Υποβολών</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
        
            <?php $sites_total = 0; ?>

            @foreach($sites as $date => $site)
                <tr class="submissions-cats-row">
                    <td>{{ $date }}</td>
                    <td>{{ $site->count() }}</td>
                    <?php $date_arr = explode('-', $date); ?>
                    <td>{{ $date_arr[2] }}{{ $date_arr[1] }}{{ $date_arr[0] }}</td>
                </tr>

                <?php $sites_total += $site->count(); ?>

                <script>
                    var the_date = "{{ $date }}",
                        the_site_count = {{ $site->count() }};

                    the_dates.push(the_date);
                    the_site_counts.push(the_site_count);
                </script>
            @endforeach
        
        </tbody>

    </table>

    <p class="lead stats-sum">Σύνολο: <strong>{{ $sites_total }}</strong></p>

    <div class="chart">
    <div class="ct-chart ct-golden-section"></div>
    </div>

    <script>

        new Chartist.Line('.ct-chart', {
            labels: the_dates,
            series: [
                the_site_counts
            ]
        }, {
        fullWidth: true,
        });

    </script>
        
    </div>
@endsection
