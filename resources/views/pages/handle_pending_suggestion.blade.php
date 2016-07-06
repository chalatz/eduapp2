@extends('layouts.app')

@section('content')
    
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <p class="lead">
                @if($suggestion->count() > 1)
                    Υπάρχουν εκκρεμείς προτάσεις από {{ $suggestion->count() }} υποψήφιους ιστοτόπους.
                @else
                    Υπάρχει εκρεμμής πρόταση από άλλον υποψήφιο ιστότοπο.
                @endif
            </p>
            <p class="lead">
                Παρακαλούμε <a href="{{ route('home') }}">απαντήστε πρώτα @if($suggestion->count() > 1) στις προτάσεις @else στην πρόταση @endif</a> και συνεχίστε μετά.
            </p>
        </div>
    </div>
</div>

@endsection
