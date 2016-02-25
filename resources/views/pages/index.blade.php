@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            @if(Auth::check())



            @else

                <p class="lead">
                    Καλώς ορίσατε στο Πληροφοριακό Σύστημα του 8ου Διαγωνισμού Ελληνόφωνων Εκπαιδευτικών Ιστότοπων!
                </p>

                <p>
                    <a class="btn btn-link" href="{{ url('/login') }}">Συνδεθείτε</a> ή <a class="btn btn-link" href="{{ url('/register') }}">Εγγραφείτε</a>
                </p>

                <p>
                    <a class="btn btn-link" href="{{ url('/password/reset') }}">Ξέχασα τον Κωδικό Πρόσβασής μου</a>
                </p>
                <p>
                    <a href="{{ url('/register') }}" type="button" class="btn btn-success btn-lg btn-block">
                        Εγγραφή Χρήστη στο Πληροφοριακό Σύστημα του 8ου ΔΕΕΙ
                    </a>
                </p>

                <blockquote>
                    <p class="text-muted lead" style="font-style: oblique">
                        Για να χρησιμοποιήσετε το Πληροφοριακό Σύστημα του 8ου ΔΕΕΙ και να υποβάλετε υποψηφιότητα στο διαγωνισμό ή να γίνετε αξιολογητής, θα πρέπει πρώτα να συνδεθείτε. Για να συνδεθείτε, θα πρέπει πρώτα να έχετε εγγραφεί και να επιβεβαιώσετε το email σας στο αυτοματοποιημένο mail που θα σας έλθει, πατώντας στον σύνδεσμο που περιέχει.
                    </p>
                </blockquote>

            @endif

        </div>
    </div>
</div>
@endsection
