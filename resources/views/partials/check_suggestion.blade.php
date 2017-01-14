@if(App\Config::first()->site_submissions)

  @if(Auth::check() && Auth::user()->verified)

    @if(Auth::user()->hasSuggestionToRespondTo()->count() > 0)

      @foreach(Auth::user()->hasSuggestionToRespondTo() as $suggestion)

        <div class="panel panel-info">
          <div class="panel-heading">
            <h3><i class="fa fa-bell" aria-hidden="true"></i> Εκκρεμής Πρόταση</h3>
          </div>
          <div class="panel-body">

            <p class="lead">
                Ο χρήστης {{ $suggestion->suggestor_name }} με το email {{ $suggestion->suggestor_email }}, σας έχει προτείνει ως Αξιολογητή Α.
            </p>
            <a href="{{ route('user.suggest', $suggestion->unique_string) }}" type="button" class="btn btn-primary btn-lg btn-block">
                Αποδοχή ή όχι της πρόσκλησης
            </a>
          </div>

        </div>

      @endforeach

    @endif

  @endif

@endif
