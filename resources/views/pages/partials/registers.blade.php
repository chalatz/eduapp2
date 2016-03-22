@if(Auth::check() && Auth::user()->verified)

    @if(Auth::user()->grader)
        <p>Υποβολή Υποψηφιότητας</p>
    @else

        @if(!Auth::user()->hasSuggested())
            <div class="row">
                <blockquote class="lead">
                    Προκειμένου να δηλώσετε την υποψηφιότητά σας, θα πρέπει πρώτα να προτείνετε Αξιολογητή Α.
                </blockquote>
            </div>
            <div class="row">
                <a href="{{ route('choose_grader_type') }}" type="button" class="btn btn-primary btn-lg btn-block">
                    Προτείνετε Αξιολογητή Α
                </a>
            </div>
        @endif

        @if(Auth::user()->hasNotAcceptedYet())
            <div class="row">
                <blockquote class="lead">
                    Ο Αξιολογητής Α δεν έχει αποδεχθεί ακόμη.
                </blockquote>
            </div>
            <div class="row">
                <a href="#" type="button" class="btn btn-primary btn-lg btn-block">
                    Αποστολή email υπενθύμισης
                </a>
            </div>
            <div class="row">
                <a href="#" type="button" class="btn btn-primary btn-lg btn-block">
                    Επιλογή νέου Αξιολογητή
                </a>
            </div>

        @endif

    @endif

@endif
