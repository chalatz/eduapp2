@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <p class="lead">
                Υπάρχει εκρεμμής πρόταση από άλλον υποψήφιο ιστότοπο.
            </p>
            <p class="lead">
                Παρακαλούμε <a href="{{ route('user.suggest', $suggestion->unique_string) }}">απαντήστε πρώτα στην πρόταση</a> και συνεχίστε μετά.
            </p>
        </div>
    </div>
</div>

@endsection
