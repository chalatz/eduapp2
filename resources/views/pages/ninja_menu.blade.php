@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            @if(Auth::check() && Auth::user()->hasRole('ninja'))
            
                <a class="btn btn-info btn-lg btn-block" href="{{ route('send_to_late_graders_a') }}" role="button" onclick="return confirm('Εϊστε σίγουρος;');">
                    Αποστολή email στους Αξ. Α που δεν έχουν αποδεχτεί ακόμη
                </a>

                <a class="btn btn-warning btn-lg btn-block" href="{{ route('send_to_graders_a_who_did_not_finish') }}" role="button" onclick="return confirm('Εϊστε σίγουρος;');">
                    Αποστολή email στους Αξ. Α που δεν έχουν βαθμολογήσει αν και έχουν κάνει αποδοχή
                </a>

                <a class="btn btn-default btn-lg btn-block" href="{{ route('send_to_sites_about_late_graders_a') }}" role="button" onclick="return confirm('Εϊστε σίγουρος;');">
                    Αποστολή email στους υπεύθυνους των ιστότοπων, των οποίων οι Αξιολογητές που πρότειναν δεν έχουν αποδεχθεί
                </a>                                 

            @endif

        </div>
    </div>
</div>

@endsection