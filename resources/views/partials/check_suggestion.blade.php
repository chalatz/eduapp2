@if(Auth::check() && Auth::user()->verified)

  @if(Auth::user()->hasSuggestionToRespondTo())

    <blockquote class="lead">
        Ο χρήστης {{ Auth::user()->hasSuggestionToRespondTo()->suggestor_name }} με το email {{ Auth::user()->hasSuggestionToRespondTo()->suggestor_email }}, σας έχει προτείνει ως Αξιολογητή Α.
    </blockquote>

  @endif

@endif
