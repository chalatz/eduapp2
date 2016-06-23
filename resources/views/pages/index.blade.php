@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            @include('partials.check_suggestion')

            @if(Auth::check())

                @include('pages.partials.info')

                @include('pages.partials.registers')

            @else

                <p class="lead">
                    Καλώς ορίσατε στο Πληροφοριακό Σύστημα του 8ου Διαγωνισμού Ελληνόφωνων Εκπαιδευτικών Ιστότοπων!
                </p>

                <p>
                    <a class="btn btn-link btn-lg" href="{{ url('/login') }}"><i class="fa fa-btn fa-sign-in"></i> Συνδεθείτε</a> ή <a class="btn btn-link btn-lg" href="{{ url('/register') }}"><i class="fa fa-btn fa-user-plus"></i> Εγγραφείτε</a>
                </p>

                <p>
                    <a class="btn btn-link btn-lg" href="{{ url('/password/reset') }}"><i class="fa fa-btn fa-unlock-alt"></i> Ξέχασα τον Κωδικό Πρόσβασής μου</a>
                </p>
                <p>
                    <a href="{{ url('/register') }}" type="button" class="btn btn-success btn-lg btn-block">
                        <i class="fa fa-user-plus"></i>&nbsp;&nbsp;Εγγραφή Χρήστη στο Πληροφοριακό Σύστημα του 8ου ΔΕΕΙ
                    </a>
                </p>

                <blockquote>
                    <p class="text-muted lead" style="font-style: oblique">
                        Για να χρησιμοποιήσετε το Πληροφοριακό Σύστημα του 8ου ΔΕΕΙ και να υποβάλετε υποψηφιότητα στο διαγωνισμό ή να γίνετε αξιολογητής, θα πρέπει πρώτα να συνδεθείτε. Για να συνδεθείτε, θα πρέπει πρώτα να έχετε εγγραφεί και να επιβεβαιώσετε το email σας στο αυτοματοποιημένο email που θα σας έλθει, πατώντας στον σύνδεσμο που περιέχει.
                    </p>
                </blockquote>

            @endif

        </div>
    </div>
</div>
@endsection
