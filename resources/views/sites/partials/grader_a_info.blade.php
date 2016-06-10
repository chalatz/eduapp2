<div class="panel panel-success">
    <div class="panel-heading"><h4>Στοιχεία Αξιολογητή Α</h4></div>
    <div class="panel-body">

        @if(Auth::user()->suggestion->self_proposed == 'yes')
            Έχετε προτείνει τον εαυτό σας ως Αξιολογητή Α
        @endif

        @if(Auth::user()->suggestion->self_proposed == 'no')
            <div class="panel panel-default">
                <div class="panel-heading bold"><strong>Επώνυμο προτεινόμενου Αξιολογητή Α</strong></div>
                <div class="panel-body">
                    {{ Auth::user()->suggestedGrader()->last_name }}
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading bold"><strong>Όνομα προτεινόμενου Αξιολογητή Α</strong></div>
                <div class="panel-body">
                    {{ Auth::user()->suggestedGrader()->first_name }}
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading bold"><strong>E-mail Αξιολογητή Α</strong></div>
                <div class="panel-body">
                    {{ Auth::user()->suggestedGrader()->user->email }}
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading bold"><strong>Περιφέρεια Αξιολογητή Α</strong></div>
                <div class="panel-body">
                    {{ $districts::all()[Auth::user()->suggestedGrader()->district_id] }}
                </div>
            </div>                      
        @endif

    </div>
</div>
