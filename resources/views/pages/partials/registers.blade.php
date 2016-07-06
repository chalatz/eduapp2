@if(Auth::check() && Auth::user()->verified)

    @if(Auth::user()->canCreateSite())
        <div class="row">
            <a href="{{ route('sites.create') }}" type="button" class="btn btn-success btn-lg btn-block">
                <i class="fa fa-plus-square"></i> Υποβολή Υποψηφιότητας Ιστότοπου
            </a>
        </div>
    @else

        @if(!Auth::user()->suggestion)
            <div class="row">
                <blockquote class="lead">
                    Προκειμένου να δηλώσετε την υποψηφιότητά σας, θα πρέπει πρώτα να προτείνετε Αξιολογητή Α.
                </blockquote>
            </div>
            <div class="row">
                <a href="{{ route('choose_grader_type') }}" type="button" class="btn btn-primary btn-lg btn-block">
                    <i class="fa fa-plus"></i> Προτείνετε Αξιολογητή Α
                </a>
            </div>
        @endif

        @if(Auth::user()->suggestion && Auth::user()->suggestion->accepted == 'na')
            <div class="row">
                <blockquote class="lead">
                    Ο Αξιολογητής Α ({{ Auth::user()->suggestion->grader_email }}) δεν έχει αποδεχθεί ακόμη.
                </blockquote>
            </div>
            <div class="row">
                <a href="{{ route('send_reminder_to_grader_a_from_site') }}" type="button" class="btn btn-primary btn-lg btn-block">
                    <i class="fa fa-envelope"></i> Αποστολή email υπενθύμισης (σας έχουν απομείνει {{ Auth::user()->suggestion->reminders_count }} αποστολές)
                </a>
            </div>
            <div class="row">
                <a href="{{ route('delete_suggestion') }}" type="button" class="btn btn-danger btn-lg btn-block" onclick="return confirm('Εϊστε σίγουρος ότι επιθυμείτε τη διαγραφή της πρότασης;');">
                    <i class="fa fa-exclamation-triangle"></i> Διαγραφή Πρότασης <span style="text-decoration: underline">(Η ενέργεια δε θα μπορεί να αναιρεθεί)</span>
                </a>
            </div>

        @endif

    @endif

    @if(!Auth::user()->hasRole('grader_b'))

        <div class="row">
            <blockquote class="lead">
                Μπορείτε να δηλώσετε συμμετοχή και ως Αξιολογητής Β.
            </blockquote>
        </div>
        <div class="row">
            <a href="{{ route('graders.create_b') }}" type="button" class="btn btn-info btn-lg btn-block">
                <i class="fa fa-user"></i> Υποβολή Συμμετοχής ως Αξιολογητής Β
            </a>
        </div>

    @endif

@endif
