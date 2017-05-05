@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Ο Ιστότοπός σας έχει φτάσει στη φάση <span class="label label-info">{{ $max_phase }}</span></h1>
        </div>
    </div>

    @if($phase['a'])
        <div class="row">
            <div class="col-md-11 col-md-offset-1">
                <p class="lead">
                    Βαθμός Φάσης Α: <span class="label label-success" style="font-size: 1.1em;">{{ $mo['a'] }}</span>
                </p>
                <h3>Σχόλια Αξιολογητών από τη Φάση Α:</h3>
                <?php $evaluations = App\Evaluation::where('site_id', $site_id)->get(); ?>
                @foreach($evaluations as $evaluation)
                    @include('evaluations.partials.comments')
                @endforeach
            </div>
        </div>
    @endif

    @if($phase['b'])
    <hr>
        <div class="row">
            <div class="col-md-11 col-md-offset-1">
                <p class="lead">
                    Βαθμός Φάσης Β: <span class="label label-primary" style="font-size: 1.1em;">{{ $mo['b'] }}</span>
                </p>
                <h3>Σχόλια Αξιολογητών από τη Φάση Β:</h3>
                <?php $evaluations = App\Evaluation_b::where('site_id', $site_id)->get(); ?>
                @foreach($evaluations as $evaluation)
                    @include('evaluations.partials.comments')
                @endforeach                
            </div>
        </div>
    @endif    

    @if($phase['c'])
    <hr>
        <div class="row">
            <div class="col-md-11 col-md-offset-1">
                <p class="lead">
                    Βαθμός Φάσης Γ: <span class="label label-warning" style="font-size: 1.1em;">{{ $mo['c'] }}</span>
                </p>
                <h3>Σχόλια Αξιολογητών από τη Φάση Γ:</h3>
                <?php $evaluations = App\Evaluation_c::where('site_id', $site_id)->get(); ?>
                @foreach($evaluations as $evaluation)
                    @include('evaluations.partials.comments')
                @endforeach                
            </div>
        </div>
    @endif 

</div>
@endsection
