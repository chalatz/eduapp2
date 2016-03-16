@if(Auth::check() && Auth::user()->verified)

    <a href="{{ route('choose_grader_type') }}" type="button" class="btn btn-success btn-lg btn-block">
        Υποψηφιότητα
    </a>

@endif
