@extends('layouts.statistics')

@section('content')
<div class="container">
    
    <?php
        $spec_count = 0; // spec: specialty
        $districts_count = 0;
    ?>

    <h1><i class="fa fa-bar-chart" aria-hidden="true"></i> Αξιολογητές {{ strtoupper($grader_type) }}</h1>
    <hr>

    @include('partials.stats.grader_specialties')

    @include('partials.stats.grader_districts')
   
    @include('partials.graders_modal')

</div>
@endsection
