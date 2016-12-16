@extends('layouts.statistics')

@section('content')
<div class="container">

    <script>
        var the_dates = [],
            the_site_counts = [];
    </script>

    <h1>Υποβολές Υποψηφιότητων</h1>
    <hr>

    <table id="submissions-stats-table" class="table table-striped stats-table submissions-stats-table">

        <thead>
            <tr>
                <th>Ημερομηνία</th>
                <th>Πλήθος Υποβολών</th>
            </tr>
        </thead>

        <tbody>
        
            @foreach($sites as $date => $site)
                <tr class="submissions-cats-row">
                    <td>{{ $date }}</td>
                    <td>{{ $site->count() }}</td>
                </tr>

                <script>
                    var the_date = "{{ $date }}",
                        the_site_count = {{ $site->count() }};

                    the_dates.push(the_date);
                    the_site_counts.push(the_site_count);
                </script>
            @endforeach
        
        </tbody>

    </table>

    <p class="lead stats-sum">Σύνολο: <strong>{{ App\Site::all()->count() }}</strong></p>

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
