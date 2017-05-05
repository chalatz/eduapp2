@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Αξιολογήσεις των Ιστότοπων που αξιολόγησα</h1>

    <div style="background-color: #eee; padding: .5em; margin-bottom: 3em;">
        <p class="lead">Οι Βαθμοί μου:</p>
        <table class="table">
            <thead>
                <tr>
                    <th>Ιστότοπος</th>
                    <th>Βαθμός</th>
                </tr>
            </thead>
            <tbody>
            @foreach($evaluations as $my_evaluation)
                <tr>
                    <td>
                        <a href="{{ App\Site::find($my_evaluation->site_id)->url }}" target="_blank">{{ App\Site::find($my_evaluation->site_id)->title }}</a>
                    </td>
                    <td>
                        <span class="label label-success" style="font-size: 1.1em;">{{ $my_evaluation->total_grade }}</span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    @foreach($evs as $evaluation)
        <div style="background-color: #eee; padding: .5em; margin-bottom: 2em;">
            <div class="row">
                <div class="col-md-12">
                    <h3>Ιστότοπος: <a href="{{ App\Site::find($evaluation->site_id)->url }}" target="_blank">{{ App\Site::find($evaluation->site_id)->title }}</a></h3>
                </div>          
            </div>

            <div class="row">
                <div class="col-md-11 col-md-offset-1">
                    <p class="lead">Βαθμός: <span class="label label-warning" style="font-size: 1.1em;">{{ $evaluation->total_grade }}</span></p>
                    <h3>Σχόλια:</h3>
                    @include('evaluations.partials.comments')
                </div>
            </div>
        </div>

    @endforeach
    
</div>
@endsection
