@if(Auth::check() && Auth::user()->verified)

  @if(Auth::user()->hasSuggestionToRespondTo())

    <div class="row">
      <blockquote class="lead">
          Ο χρήστης {{ Auth::user()->hasSuggestionToRespondTo()->suggestor_name }} με το email {{ Auth::user()->hasSuggestionToRespondTo()->suggestor_email }}, σας έχει προτείνει ως Αξιολογητή Α.
      </blockquote>
    </div>

    <div class="row">
        <a href="{{ route('user.suggest', Auth::user()-> hasSuggestionToRespondTo()->unique_string) }}" type="button" class="btn btn-primary btn-lg btn-block">
            Αποδοχή ή όχι της πρόσκλησης
        </a>
    </div>


  @endif

@endif
